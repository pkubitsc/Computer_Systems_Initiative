<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
        public $data = array();
        
	function __construct()
	{
		parent::__construct();
                $data['errors'] = array();
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
                $page = intval($this->uri->segment(3));
                if (empty($page) || !is_int($page)) {
                        // means a page was sent
                        $page = 1;
                }
                
                $data['posts'] = $this->posts->get_posts_by_user_id($user_id, $page);
                $num_total_posts = $this->posts->get_number_posts_by_user_id($user_id);
                $data['num_pages'] = ceil(intval($this->posts->get_number_posts_by_user_id($user_id))/10);
                $data['current_page'] = $page;
                $data['base_url'] = $this->config->item('base_url');
                $this->session->set_flashdata('redirect_url', '/home/yourposts/');
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
                    if (!ctype_alnum($value)) {
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
                        
                        // In here we must separate the hashtags
                        preg_match_all("/#\w+/", $post, $hashtags);
                        $new_hashtags = $this->clean_hashtags($hashtags[0]);
                        
                        if (is_null($new_hashtags)) {
                                $data['errors'] = array('Hashtag Error' => "Hashtags must begin with an alphanumeric character");
                        } else {
                                $post = $this->posts->add_post($user_id, $post);
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
                                                        $data['errors'] = array('Hashtag Error' => "There was an error adding your hashtag");
                                                        break;
                                                    }
                                                } else {
                                                    // get hashtag id
                                                    $hashtag = $this->hashtags->get_hashtag_id($hashtag_word);
                                                    if (is_null($hashtag)) {
                                                        $data['errors'] = array('Hashtag Error' => "There was an error adding your hashtag");
                                                        break;
                                                    }
                                                }

                                                // add hashtag-post relation
                                                if (is_null($this->hashtags->add_hashtag_post_relation($hashtag['hashtag_id'], $post['post_id']))) {
                                                    $data['errors'] = array('Hashtag Error' => "There was a problem adding our hashtags to your post.");
                                                    break;
                                                }
                                        }
                                }
                        }
                }
                if (empty($data['errors'])) {
                    $this->yourposts();
                } else {
                    $this->yourposts($data);
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
                        // ../../../css/home/style.css
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

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */