<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jquery_Scripts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
                
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library('form_validation');
                $this->load->library('tank_auth');
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
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */