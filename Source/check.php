<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jquery_Scripts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
                
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library('form_validation');
                $this->load->library('tank_auth');
                $this->load->helper('security');
	}

	function index()
	{

	}
        
        function check_username() {
                // just a simple check username
                $this->load->model('users');
                $username = xss_clean($this->uri->segment(3));
                if (empty($username)) {
                        // do nothing
                } else {
                        $db_username = $this->users->get_user_by_username($username);
                        if (is_null($db_username)) {
                                echo "Username is not in use";
                        } else {
                                echo "Username already in use";
                        }
                }
        }
        
        function check_email() {
                // just a simple check username
                $this->load->model('users');
                $email = xss_clean($this->uri->segment(3));
                if (empty($email)) {
                        // do nothing
                } else {
                        $db_email = $this->users->get_user_by_email($email);
                        if (is_null($db_email)) {
                                echo "Email is not in use";
                        } else {
                                echo "Email already in use";
                        }
                }
        }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */