<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller
{
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
        
	function index(){
	

	}
	//Need check for no search included and what it will return
	
	//can be either a username, or name combination
	function search(){
		switch (func_num_args()) {
                    //no arguments passed, fetch all posts of people user is following
                    case 0:
                    $following = $this->db->prepare("SELECT following_id FROM Following JOIN Users ON Following.user_id = users.id
                                                                                        WHERE users.id = ?");
                    $fresult = $following->execute(array($userID));

                                $stmt = $this->db->prepare("SELECT Posts.* FROM Posts JOIN users ON 
                                                                                        users.id = Posts.user_id JOIN Following ON user.id = Folowing.user_id WHERE
                                                                                        Following.following_id = ?");
                                $result = $stmt->execute(array($fresult));							
                    break;

                    //if 1 argument, either username, firstname, lastname, email, or hashtag
                                case 1:
                                //case of an email
                   /* if(strpos($string, '@')){
                                                        //if it contatains the symbol '@' then its an email, so search by emails
                                        $stmt = $this->db->prepare("SELECT Posts.* FROM Posts
                                     JOIN Users ON Users.user_id=Posts.user_id 
                                     WHERE dm(email)=dm(?)");
                        $stmt->execute(array($string));
                        $result = $stmt->fetchAll();
                                break;
                                }
                                */
                        if($string[0] == '#'){			//then its a hashtag and we will search hashtags
                                $str = substr($string, 1);
                        $stmt = $this->db->prepare("SELECT Posts.* FROM Posts 
                                     JOIN Post_Hashtags ON Post_Hashtags.post_id = Posts.post_id 
                                     JOIN Hashtags ON Hashtags.hashtag_id=Post_Hashtags.hashtag_id 
                                     WHERE dm(Post_Hashtags.hashtag)=dm(?)");

                        $stmt->execute(array($string));
                        $result = $stmt->fetchAll();
                        }else{
                                                //otherwise it is either  username, firstName, or lastName
                        $stmt = $this->db->prepare("SELECT Users.username, User.user_id, Users.first_name, Users.last_name FROM Users
                                     WHERE dm(username)=dm(:str1) OR dm(first_name)=dm(:str1) OR dm(last_name)=dm(:str1)
                                     LIMIT 0,10");
                        $stmt->execute(array($string));
                        $result = $stmt->fetchAll();
                        break;
                        }

                    case 2:

                        $stmt = $this->db->prepare("SELECT username, user_id, first_name, last_name FROM Users 
                                     WHERE dm(username) IN (dm(:str1), dm(:str2)) 
                                     OR dm(first_name) IN (dm(:str1), dm(:str2)) 
                                     OR dm(last_name) IN (dm(:str1), dm(:str2)) 
                                     LIMIT 0,10");
                        $stmt->execute(array($string));
                        $result = $stmt->fetchAll();
                    break;

                    case 3:
                        $stmt = $this->db->prepare("SELECT username, user_id, first_name, last_name FROM Users 
                                     WHERE dm(username) IN (dm(:str1), dm(:str2), dm(:str3)) 
                                     OR dm(first_name) IN (dm(:str1), dm(:str2), dm(:str3)) 
                                     OR dm(last_name) IN (dm(:str1), dm(:str2), dm(:str3)) 
                                     LIMIT 0,10");
                        $stmt->execute(array($string));
                        $result = $stmt->fetchAll();
                    break;
                    default:
                        return false;
                    break;
        }
		    
        }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */