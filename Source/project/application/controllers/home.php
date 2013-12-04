<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
        public $data = array();
        
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('security');
		$this->load->library('tank_auth');
                $this->load->model('home/posts');
                $this->load->model('home/hashtags');
		$this->lang->load('tank_auth');
        }
        
	function index()
	{

	}

        private function check_login() {
            if (!$this->tank_auth->is_logged_in()) {
                    $this->tank_auth->logout();
                    redirect('/auth/login/');
            }
        }
        
        /**
         * View all of your posts
         *  - Grab the data, load the view
         */
	function yourposts($data = null) {
                $this->check_login();
                
                // we want to grab the last 10 posts made by you
                $user_id = $this->tank_auth->get_user_id();

                // check for paging
                if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                
                if (isset($data['errors'])) {
                        $errors = $data['errors'];
                        $data = array();
                        $data['errors'] = $errors;
                } else {
                        $data = array();
                }

                $data['posts'] = $this->hashtag_url_generator($this->posts->get_posts_by_user_id($user_id, $page));
                $num_total_posts = $this->posts->get_number_posts_by_user_id($user_id);
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $data['type_page'] = 'yourposts';
                $this->session->set_flashdata('redirect_url', '/home/yourposts?page='.$page);
                $this->load->view('home/postsview', $data);
        }
        
        /*
         * Clean the hashtags, outputs an error otherwise
         * 
         */
        function clean_hashtags($hashtags) {
                // remove hashtag sign
                $hashtags_removed = $this->hashtags->remove_many_hashtags($hashtags);

                // check if first character is alphanumeric
                $type_error = FALSE;
                foreach ($hashtags_removed AS $key => $value) {
                    if (!ctype_alnum($value[0])) {
                        $type_error = TRUE;
                        break;
                    }
                }
                
                if ($type_error) {
                        return null;
                }
                
                return $hashtags_removed;
        }
        
        function in_array_r($needle, $haystack, $strict = false) {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }

            return false;
        }
        
        /*
         * adds a post
         */
        function addpost() {
                $this->check_login();
                $this->load->library('form_validation');
                // the multiple variables
                $user_id = $this->tank_auth->get_user_id();
                $this->form_validation->set_rules('post', 'Post', 'trim|required|xss_clean|min_length[3]|max_length[200]|required');
                $this->form_validation->set_message('post', 'The post must be between 3 and 200 characters long.');


                if ($this->form_validation->run()) {
                        $post = $this->form_validation->set_value('post');
                        
                        $parent_id = intval($this->uri->segment(3));
                        if (empty($parent_id)) {
                                $parent_id = 0;
                                $number_replies = 0;
                        } else {
                                // grab the number of replies
                                $number_replies = $this->posts->get_number_replies_by_post_id($parent_id);
                        }
                        
                        // In here we must separate the hashtags
                        preg_match_all("/#\w+/", $post, $hashtags);
                        if (!empty($hashtags[0])) {
                                $new_hashtags = $this->clean_hashtags($hashtags[0]);
                        } else {
                                $new_hashtags = false;
                        }
                        
                        if (is_null($new_hashtags)) {
                                $data['errors'] = array('hashtag_error' => "Hashtags must begin with an alphanumeric character");
                        } else {
                                if (!$new_hashtags) {
                                        // no hashtags
                                        $post = $this->posts->add_post($user_id, $post, $parent_id, $number_replies);
                                } else {
                                        $post = $this->posts->add_post($user_id, $post, $parent_id, $number_replies);
                                        // check if the hashtag(s) already exist in the database
                                        // if they do, add that id to the post hashtag relationship
                                        // otherwise, add the hashtag, then the relationship
                                        if (!is_null($post) && !is_null($new_hashtags)) {
                                            
                                                // add hashtags to db
                                                $hashtags_in_db = $this->hashtags->get_hashtags_by_name($new_hashtags);

                                                foreach ($new_hashtags AS $hashtag_word) {
                                                    //print_r($hashtag);
                                                        if (!$this->in_array_r($hashtag_word, $hashtags_in_db)) {
                                                            // add the new hashtag to the db
                                                            $hashtag = $this->hashtags->add_hashtag($hashtag_word);
                                                            if (is_null($hashtag)) {
                                                                $data['errors'] = array('hashtag_error' => "There was an error adding your hashtag");
                                                                break;
                                                            }
                                                        } else {
                                                            // get hashtag id
                                                            $hashtag = $this->hashtags->get_hashtag_id($hashtag_word);
                                                            if (is_null($hashtag)) {
                                                                $data['errors'] = array('hashtag_error' => "There was an error adding your hashtag");
                                                                break;
                                                            }
                                                        }

                                                        // add hashtag-post relation
                                                        if (is_null($this->hashtags->add_hashtag_post_relation($hashtag['hashtag_id'], $post['post_id']))) {
                                                            $data['errors'] = array('hashtag_error' => "There was a problem adding our hashtags to your post.");
                                                            break;
                                                        }
                                                }
                                        }
                                }
                        }
                }
                if (empty($data['errors'])) {
                        $this->session->set_flashdata('redirect_url');
                        redirect($this->session->flashdata('redirect_url'));
                } else {
                        if ($parent_id != 0) {
                            $this->see_replies($parent_id, $data);
                        } else {
                            // your posts
                            $this->yourposts($data);
                        }
                }

                
        }
        
        function likepost() {
                $this->check_login();

                $post_id = intval($this->uri->segment(3));
                $user_id = $this->tank_auth->get_user_id();
                $redirect_url = $this->session->flashdata('redirect_url');
                $is_post = $this->posts->is_post($post_id);
                //exit($post_id.$user_id.$redirect_url.$is_post);
                // Check for empty or if it's not an integer
                if (empty($post_id) || !is_int($post_id) || empty($redirect_url) || !$is_post) {
                        // Send an error to the prior view
                        $this->session->set_flashdata('redirect_url', $redirect_url);
                        $this->session->set_flashdata('error', 'There was a problem liking the post.');
                        if (empty($redirect_url)) {
                                redirect('/home/yourposts/');
                        } else {
                                redirect($redirect_url);
                        }
                } else {
                        // If the post is already liked, dislike it
                        if ($this->posts->is_liked($user_id, $post_id)) {
                                $this->posts->dislike_post($user_id, $post_id);
                        } else {
                                $this->posts->like_post($user_id, $post_id);
                        }
                        redirect($redirect_url);
                }
        }
        
        function see_replies($parent_id = 0, $data = null) {
                $this->check_login();
                
                if ($parent_id == 0) {
                    $post_id = intval($this->uri->segment(3));
                } else {
                    $post_id = intval($parent_id);
                }
                
                $user_id = $this->tank_auth->get_user_id();
                $is_post = $this->posts->is_post($post_id);

                // Check for empty or if it's not an integer
                if (empty($post_id) || !is_int($post_id) || !$is_post) {
                        // Show an error
                        $data['errors'] = array('post_id_error', 'The supplied ID is not correct.');
                } else {
                        // grab the data for the replies
                        // check for paging
                        if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        
                        echo $page;
                        
                        $data['parent_post'] = $this->hashtag_url_generator_single($this->posts->get_parent_post($post_id));
                        $data['posts'] = $this->hashtag_url_generator($this->posts->get_replies_by_post_id($post_id, $page));
                        $num_total_posts = $this->posts->get_number_replies_by_post_id($post_id);
                        $data['num_pages'] = ceil(intval($num_total_posts)/10);
                        $data['current_page'] = $page;
                        $data['base_url'] = $this->config->item('base_url');
                        $data['type_page'] = 'see_replies/'.$parent_id;
                        $this->session->set_flashdata('redirect_url', '/home/see_replies/'.$post_id);
                }
                
                $this->load->view('home/postsview', $data);
        }
        
        function search() {
                $this->check_login();
                $this->load->helper('security');
                $data['hashtag_results'] = array();
                $data['user_results'] = array();
                $data['base_url'] = $this->config->item('base_url');
                $data['num_pages'] = 0;
                $data['current_page'] = 1;
                $data['search_terms'] = "";
                $data['page'] = "";
                $this->session->set_flashdata('redirect_url', '/home/search/');
                $user_id = $this->tank_auth->get_user_id();
                
                // check for paging
                if (!isset($_GET['page']) || empty($_GET['page'])) {
                        // means a page was sent
                        $page = 1;
                } else {
                        $page = intval($_GET['page']);
                }
                
                // check if the flashdata is set, use that instead
                $flashdata_errors = $this->session->flashdata('errors');
                if (!empty($flashdata_errors)) {
                        $data['errors'] = $flashdata_errors;
                }
                
                // are we going to be searching users or hashtags? I dunno!!!
                $this->load->library('form_validation');
                // the multiple variables
                
                if (isset($_GET['submit'])) {
                        $search_terms = xss_clean(trim($_GET['search']));
                        if (strlen($search_terms) > 200) {
                                $data['errors'] = array('search_error', 'The length of the search term is too long.');
                        } else {
                                $terms[0] = "";
                                $terms[1] = "";
                                $terms[2] = "";
                                $terms = explode(" ", $search_terms);

                                // check for hashtag in the first one
                                preg_match_all("/#\w+/", $terms[0], $hashtag);
                                if (!empty($hashtag[0])) {
                                        // hashtag search
                                        $clean_hashtag = $this->clean_hashtags($hashtag[0]);

                                        $data['hashtag_results'] = $this->hashtags->search_hashtags($clean_hashtag[0], $page);
                                        $num_results = $this->hashtags->search_hashtags_count($clean_hashtag[0]);
                                        $data['num_pages'] = ceil(intval($num_results)/10);
                                        $data['current_page'] = $page;
                                } else {
                                        // user search
                                        if (empty($terms[0])) {
                                                // no users selected, but submit button selected, list all users
                                                $data['user_results'] = $this->users->get_all_users($page);
                                                $num_results = $this->users->get_all_users_count();
                                        } elseif (!isset($terms[1])) {
                                                $data['user_results'] = $this->users->search_users($terms[0], $page);
                                                $num_results = $this->users->search_users_count($terms[0]);
                                        } elseif (!isset($terms[2])) {
                                                $data['user_results'] = $this->users->search_users($terms[0], $terms[1]);
                                                $num_results = $this->users->search_users_count($terms[0], $terms[1]);
                                        } else {
                                                $data['user_results'] = $this->users->search_users($terms[0], $terms[1], $terms[2]);
                                                $num_results = $this->users->search_users_count($terms[0], $terms[1], $terms[2]);
                                        }

                                        $data['num_pages'] = ceil(intval($num_results)/10);
                                        $data['current_page'] = $page;
                                }

                                $data['search_terms'] = urlencode($search_terms);

                                $this->session->set_flashdata('redirect_url', '/home/search?search='.urlencode($search_terms).'&submit=Submit&page='.$page);
                                //$num_total_posts = $this->posts->search_hashtags_count($hashtag[0]);
                                // $data['num_pages'] = ceil(intval($num_total_posts)/10);
                                //$data['current_page'] = $page;
                                $data['logged_in_user_id'] = $user_id;
                        }
                }
                
                $this->load->view('home/search_view', $data);
        }
        
        function follow_user() {
                $this->check_login();

                $follower_id = $this->tank_auth->get_user_id();
                $followed_id = intval($this->uri->segment(3));

                if (empty($followed_id) || !is_int($followed_id)) {
                        // error
                        $data['errors'] = array('follow_error', 'We could not follow this user. Please try again.');
                } else {
                        $is_user = $this->users->get_user_by_id($followed_id, 1);
                        if (is_null($is_user)) {
                                // error
                                $data['errors'] = array('follow_error', 'We could not follow this user. Please try again.');
                        } else {
                                // add the relationship if not already there
                                if ($this->users->is_followed($follower_id, $followed_id)) {
                                        $data['errors'] = array('follow_error', 'You are already following this person.');
                                } else {
                                        if (!$this->users->follow_user($follower_id, $followed_id)) {
                                                // error
                                                $data['errors'] = array('follow_error', 'We could not follow this user. Please try again.');
                                        }
                                }
                        }
                }
                
                // redirect irregardless if there is an error or not
                $redirect_url = $this->session->flashdata('redirect_url');
                $this->session->set_flashdata('errors', $data['errors']);
                if (!empty($redirect_url)) {
                        redirect($redirect_url);
                } else {
                        redirect('home/yourposts');
                }
        }
        
        function follow_hashtag() {
                $this->check_login();

                $follower_id = $this->tank_auth->get_user_id();
                $hashtag_id = intval($this->uri->segment(3));

                if (empty($hashtag_id) || !is_int($hashtag_id)) {
                        // error
                        $data['errors'] = array('follow_error', 'We could not follow this user. Please try again.');
                } else {
                        $is_hashtag = $this->hashtags->get_hashtag_name($hashtag_id);
                        if (is_null($is_hashtag)) {
                                // error
                                $data['errors'] = array('follow_error', 'We could not follow this hashtag. Please try again.');
                        } else {
                                // add the relationship if not already there
                                if ($this->hashtags->is_followed($follower_id, $hashtag_id)) {
                                        $data['errors'] = array('follow_error', 'You are already following this hashtag.');
                                } else {
                                        if (!$this->hashtags->follow_hashtag($follower_id, $hashtag_id)) {
                                                // error
                                                $data['errors'] = array('follow_error', 'We could not follow this hashtag. Please try again.');
                                        }
                                }
                        }
                }
                
                // redirect irregardless if there is an error or not
                $redirect_url = $this->session->flashdata('redirect_url');
                $this->session->set_flashdata('errors', $data['errors']);
                if (!empty($redirect_url)) {
                        redirect($redirect_url);
                } else {
                        redirect('home/yourposts');
                }
        }
        
        function unfollow_hashtag() {
                $this->check_login();

                $follower_id = $this->tank_auth->get_user_id();
                $hashtag_id = intval($this->uri->segment(3));

                if (empty($hashtag_id) || !is_int($hashtag_id)) {
                        // error
                        $data['errors'] = array('unfollow_error', 'Bad ID supplied');
                } else {
                        $is_hashtag = $this->hashtags->get_hashtag_name($hashtag_id);
                        if (is_null($is_hashtag)) {
                                // error
                                $data['errors'] = array('unfollow_error', 'Bad ID supplied');
                        } else {
                                // add the relationship if not already there
                                if ($this->hashtags->is_followed($follower_id, $hashtag_id)) {
                                        if (!$this->hashtags->unfollow_hashtag($follower_id, $hashtag_id)) {
                                                // error
                                                $data['errors'] = array('unfollow_error', 'We could not unfollow this hashtag. Please try again.');
                                        }
                                } else {
                                        $data['errors'] = array('unfollow_error', 'You are not following this hashtag.');
                                        
                                }
                        }
                }
                
                // redirect irregardless if there is an error or not
                $redirect_url = $this->session->flashdata('redirect_url');
                $this->session->set_flashdata('errors', $data['errors']);
                if (!empty($redirect_url)) {
                        redirect($redirect_url);
                } else {
                        redirect('home/yourposts');
                }
        }
        
        function view_other_profile() {
                $this->check_login();

                // we want to grab the last 10 posts made by the other user
                $your_id = $this->tank_auth->get_user_id();
                
                // check for ID
                $user_id = intval($this->uri->segment(3));

                if (empty($user_id) || is_null($user_id)) {
                        $user_id = 1;
                }

                // check for paging
                if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                
                $data = array();
                
                $errors = $this->session->flashdata('errors');
                if (!empty($errors)) {
                        $data['errors'] = $errors;
                }
                
                // get user information
                $data['user'] = (array)$this->users->get_user_by_id($user_id, 1);
                
                $posts_temp = $this->hashtag_url_generator($this->posts->get_posts_by_user_id($user_id, $page));
                $data['posts'] = array();
                $i = 0;
                foreach ($posts_temp AS $post) {
                    if ($this->posts->is_liked($your_id, $post['post_id']) == true) {
                        $post['is_liked'] = 1;
                    } else {
                        $post['is_liked'] = 0;
                    }
                    $data['posts'][$i] = $post;
                    ++$i;
                }
                
                $num_total_posts = $this->posts->get_number_posts_by_user_id($user_id);
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $this->session->set_flashdata('redirect_url', '/home/view_other_profile/'.$user_id.'?page='.$page);
                $this->load->view('home/other_profile_view', $data);
        }
        
        function view_hashtag_profile() {
                $this->check_login();

                // we want to grab the last 10 posts made by the other user
                $user_id = $this->tank_auth->get_user_id();
                
                // check for ID
                $element = $this->uri->segment(3);

                if (empty($element) || is_null($element)) {
                        $hashtag_id = 1;
                }
                
                // want to check if it is an id or a hashtag
                preg_match_all("/#\w+/", urldecode($element), $hashtag);
                if (!empty($hashtag[0])) {
                        // it's a hashtag, get its ID
                        $clean_hashtag = $this->clean_hashtags($hashtag[0]);
                        $db_hashtag = $this->hashtags->get_hashtag_id($clean_hashtag[0]);
                        $hashtag_id = $db_hashtag['hashtag_id'];
                        
                } else {
                        $hashtag_id = intval($element);
                }

                // check for paging
                if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                
                $data = array();
                
                $errors = $this->session->flashdata('errors');
                if (!empty($errors)) {
                        $data['errors'] = $errors;
                }
                
                // get user information
                $data['hashtag'] = $this->hashtags->get_hashtag_name($hashtag_id);
                
                $posts_temp = $this->hashtag_url_generator($this->posts->get_posts_by_hashtag_id($hashtag_id, $page));
                $data['posts'] = array();
                $i = 0;
                foreach ($posts_temp AS $post) {
                    if ($this->posts->is_liked($user_id, $post['post_id']) == true) {
                        $post['is_liked'] = 1;
                    } else {
                        $post['is_liked'] = 0;
                    }
                    $data['posts'][$i] = $post;
                    ++$i;
                }
                
                $num_total_posts = $this->posts->get_number_posts_by_hashtag_id($user_id);
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $this->session->set_flashdata('redirect_url', '/home/view_hashtag_profile/'.$hashtag_id.'?page='.$page);
                $this->load->view('home/other_profile_view', $data);
        }
        
        function hashtag_url_generator($posts) {
                if (empty($posts) || is_null($posts)) {
                        return array();
                } else {
                        $new_posts = array();
                        $i = 0;
                        foreach($posts AS $post) {
                                $post['post_content'] = preg_replace( "/#([^\s]+)/", "<a href=\"".$this->config->item('base_url')."index.php/home/view_hashtag_profile/%23$1\">#$1</a>", $post['post_content'] );
                                $new_posts[$i] = $post;
                                ++$i;
                        }
                        
                        return $new_posts;
                }
        }
        
        function hashtag_url_generator_single($post) {
                if (empty($post) || is_null($post)) {
                        return array();
                } else {
                        $post['post_content'] = preg_replace( "/#([^\s]+)/", "<a href=\"".$this->config->item('base_url')."index.php/home/view_hashtag_profile/%23$1\">#$1</a>", $post['post_content'] );
                        return $post;
                }
        }
        
        function followed() {
                $this->check_login();
                
                // we want to grab the last 10 posts that you are following
                $user_id = $this->tank_auth->get_user_id();

                // check for paging
                if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                
                if (isset($data['errors'])) {
                        $errors = $data['errors'];
                        $data = array();
                        $data['errors'] = $errors;
                } else {
                        $data = array();
                }

                $posts_temp = $this->hashtag_url_generator($this->posts->get_followed_posts($user_id, $page));
                $data['posts'] = array();
                $i = 0;
                foreach ($posts_temp AS $post) {
                    if ($this->posts->is_liked($user_id, $post['post_id']) == true) {
                        $post['is_liked'] = 1;
                    } else {
                        $post['is_liked'] = 0;
                    }
                    $data['posts'][$i] = $post;
                    ++$i;
                }
                $num_total_posts = $this->posts->get_followed_posts_count($user_id);
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $data['type_page'] = 'followed';
                $this->session->set_flashdata('redirect_url', '/home/followed?page='.$page);
                $this->load->view('home/postsview', $data);
        }
        
        function followed_users() {
                $this->check_login();
                
                // we want to grab the last 10 posts that you are following
                $user_id = $this->tank_auth->get_user_id();

                // check for paging
                if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                
                if (isset($data['errors'])) {
                        $errors = $data['errors'];
                        $data = array();
                        $data['errors'] = $errors;
                } else {
                        $data = array();
                }

                $data['users'] = $this->users->get_followed_users($user_id, $page);
                $num_total_posts = $this->users->get_followed_users_count($user_id);
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $this->session->set_flashdata('redirect_url', '/home/followed_users?page='.$page);
                $this->load->view('home/followed_list_view', $data);
        }
        
        function unfollow_user() {
                $this->check_login();

                $follower_id = $this->tank_auth->get_user_id();
                $followed_id = intval($this->uri->segment(3));

                if (empty($followed_id) || !is_int($followed_id)) {
                        // error
                        $data['errors'] = array('unfollow_error', 'Bad ID supplied');
                } else {
                        $is_user = $this->users->get_user_by_id($followed_id, 1);
                        if (is_null($is_user)) {
                                // error
                                $data['errors'] = array('unfollow_error', 'Bad ID supplied');
                        } else {
                                // add the relationship if not already there
                                if ($this->users->is_followed($follower_id, $followed_id)) {
                                        // user is followed, remove user
                                        if (!$this->users->unfollow_user($follower_id, $followed_id)) {
                                                $data['errors'] = array('unfollow_error', 'We could not unfollow this person at this time.');
                                        }
                                } else {
                                        $data['errors'] = array('unfollow_error', 'You are not following this person.');
                                }
                        }
                }
                
                // redirect irregardless if there is an error or not
                $redirect_url = $this->session->flashdata('redirect_url');
                $this->session->set_flashdata('errors', $data['errors']);
                if (!empty($redirect_url)) {
                        redirect($redirect_url);
                } else {
                        redirect('home/yourposts');
                }
        }
        
        function followed_hashtags() {
                $this->check_login();
                
                // we want to grab the last 10 posts that you are following
                $user_id = $this->tank_auth->get_user_id();

                // check for paging
                if (isset($_GET['page']) && !empty($_GET['page']) && is_int(intval($_GET['page']))) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                
                if (isset($data['errors'])) {
                        $errors = $data['errors'];
                        $data = array();
                        $data['errors'] = $errors;
                } else {
                        $data = array();
                }

                $data['hashtags'] = $this->hashtags->get_followed_hashtags($user_id, $page);
                $num_total_posts = $this->hashtags->get_followed_hashtags_count($user_id);
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $this->session->set_flashdata('redirect_url', '/home/followed_hashtags?page='.$page);
                $this->load->view('home/followed_list_view', $data);
        }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */