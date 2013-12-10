<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jquery_Scripts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
                
		$this->load->helper(array('form', 'url', 'security'));
	}

	function index()
	{

	}
        
        function check_username() {
                // just a simple check username
                $this->load->model('users');
                
                if (isset($_POST['username'])) {
                    $username = xss_clean(trim($_POST['username']));
                        if (empty($username)) {
                                // do nothing
                        } else {
                                $db_username = $this->users->is_username_available($username);
                                if ($db_username != false) {
                                        echo '0';
                                } else {
                                        echo '1';
                                }
                        }
                }
        }
        
        function check_email() {
                // just a simple check username
                $this->load->model('users');
                
                if (isset($_POST['email'])) {
                    $email = xss_clean(trim($_POST['email']));
                        if (empty($email)) {
                                // do nothing
                        } else {
                                $db_email = $this->users->is_email_available($email);
                                if ($db_email != false) {
                                        echo '0';
                                } else {
                                        echo '1';
                                }
                        }
                }
        }
        
        function get_posts() {
                $this->load->model('home/posts');
                $this->load->model('home/hashtags');
                $this->load->library('haloc');
                
               
                // Get function passed, that will be called from the library
                $function = "get_".xss_clean(trim($this->uri->segment(3)));
                $id = intval(xss_clean(trim($this->uri->segment(4))));
                $page = intval(xss_clean(trim($this->uri->segment(5))));
                $type_page = xss_clean(trim($this->uri->segment(6)));
                if (isset($_GET['sort']) || !empty($_GET['sort'])) {
                        $sort_data = $this->haloc->clean_sort_by($type_page);
                        $data['posts'] = $this->haloc->hashtag_url_generator($this->posts->$function($id, $page, $sort_data['order_by'], $sort_data['order']));
                } else {
                        $data['posts'] = $this->haloc->hashtag_url_generator($this->posts->$function($id, $page));
                }
                
                $data['function'] = $function;

                $data['base_url'] = $this->config->item('base_url');
                $this->load->view('jquery/posts', $data);
        }
        
        // for each function we will have a library for it
        
        function get_pages() {
                $this->load->model('home/posts');
                $this->load->model('home/hashtags');
                $this->load->model('home/users');
                $this->load->library('haloc');
                
                $function = "get_number_".xss_clean(trim($this->uri->segment(3)));
                $data['id'] = intval(xss_clean(trim($this->uri->segment(4))));
                $data['current_page'] = intval(xss_clean(trim($this->uri->segment(5))));
                $data['type_page'] = xss_clean(trim($this->uri->segment(6)));
                $data['order_option'] = xss_clean(trim($this->uri->segment(7)));
                
                if ($data['order_option'] == 'hashtags') {
                        $num_total_posts = $this->hashtags->$function($data['id']);
                } elseif ($data['order_option'] == 'users') {
                        $num_total_posts = $this->users->$function($data['id']);
                } else {
                        $num_total_posts = $this->posts->$function($data['id']);
                }
                
                $data['num_pages'] = ceil(intval($num_total_posts)/10);
                $data['base_url'] = $this->config->item('base_url');
                
                $this->load->view('jquery/pages', $data);
        }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */