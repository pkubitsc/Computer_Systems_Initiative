<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Hashtags extends CI_Model
{
	private $table_name			= 'Hashtags';			// user accounts
        private $post_hashtags_table_name	= 'Post_Hashtags';	// user profiles
        private $following_table_name	= 'Following';	// Following
        private $ci;

	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();
                $this->ci->load->library('haloc');
                
		$this->table_name			= $this->ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->post_hashtags_table_name	= $this->ci->config->item('db_table_prefix', 'tank_auth').$this->post_hashtags_table_name;
	}
        
	/**
	 * Get hashtag record by Id
	 *
	 * @param	int
	 * @return	object
	 */
	function get_hashtag_id($name)
	{
                // remove the pound sign if there is one
                $name = $this->ci->haloc->remove_hashtag($name);
                
                $this->db->select('hashtag_id');
		$this->db->where('hashtag', $name);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) {
                    return $query->row_array();
                }
		return NULL;
	}
        
        function get_hashtag_name($hashtag_id)
	{
		$this->db->where('hashtag_id', $hashtag_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row_array();
		return NULL;
	}
        
        function get_hashtags_by_name($names)
	{
                $str = "SELECT * FROM Hashtags WHERE hashtag IN ('".implode('\',\'', $names)."')";
		$query = $this->db->query($str);
                return $query->result_array();
	}
        
        function add_hashtag($name) {
                $this->db->set('hashtag', $this->ci->haloc->remove_hashtag($name));
                $this->db->set('created', date('Y-m-d H:i:s'));
                if ($this->db->insert($this->table_name)) {
                    $hashtag_id = $this->db->insert_id();
                    return array('hashtag_id' => $hashtag_id);
                }
                return NULL;
        }
        
        function add_hashtag_post_relation($hashtag_id, $post_id) {
                $this->db->set('hashtag_id', $hashtag_id);
                $this->db->set('post_id', $post_id);
                if ($this->db->insert($this->post_hashtags_table_name)) {
                    return true;
                }
                return NULL;
        }
        
        function get_all_hashtags($page = 1, $order_by = 'hashtag', $order = 'DESC') {
                $str = "SELECT * FROM Hashtags
                        ORDER BY ".$order_by." ".$order."
                        LIMIT ".(($page-1)*10).",10";
		$query = $this->db->query($str);
                return $query->result_array();
        }
        
        function get_number_all_hashtags($id = 0) {
                $stmt = "SELECT COUNT(*) AS num_results FROM Hashtags";
                $query = $this->db->query($stmt);
		$results = $query->row_array();
                return $results['num_results'];
        }
        
        public function search_hashtags($str1 = null, $page = 1, $order_by = 'Hashtags.hashtag', $order = 'DESC') {
                // for each argument passed...
                // 1 argument = just un, or just fn, or just ln
                // 2 arguments = fn/ln, ln/fn, un/fn, fn/un, un/ln, ln/un
                // 3 arguments = all combinations of possible fn, ln, un
                // if a developer inputs the second string and not the first, etc... be very angry
                
                /*$stmt = "SELECT Posts.*, Hashtags.*, users.username, user_profiles.profile_image,
                            (SELECT COUNT(*) FROM PostLikes WHERE PostLikes.user_id=Posts.user_id AND PostLikes.post_id=Posts.post_id) AS is_liked
                            FROM Hashtags
                            JOIN Post_Hashtags ON Hashtags.hashtag_id=Post_Hashtags.hashtag_id
                            JOIN Posts ON Post_Hashtags.post_id=Posts.post_id
                            JOIN users ON Posts.user_id = users.id
                            JOIN user_profiles ON Posts.user_id = user_profiles.user_id
                            WHERE soundex(Hashtags.hashtag) = soundex('".$str1."')";*/
                $stmt = "SELECT Hashtags.* FROM Hashtags WHERE soundex(Hashtags.hashtag) = soundex('".$str1."')
                        ORDER BY ".$order_by." ".$order."
                        LIMIT ".(($page-1)*10).",10";
                $query = $this->db->query($stmt);
		$results = $query->result_array();
                return $results;
        }
        
        public function get_number_search_hashtags($str1 = null) {
                // for each argument passed...
                // 1 argument = just un, or just fn, or just ln
                // 2 arguments = fn/ln, ln/fn, un/fn, fn/un, un/ln, ln/un
                // 3 arguments = all combinations of possible fn, ln, un
                // if a developer inputs the second string and not the first, etc... be very angry
                
                $stmt = "SELECT COUNT(*) AS num_results FROM Hashtags WHERE soundex(hashtag) = soundex('".$str1."')";
                $query = $this->db->query($stmt);
		$results = $query->row_array();
                return $results['num_results'];
        }
        
        function follow_hashtag($follower_id, $hashtag_id) {
                $this->db->set('user_id', $follower_id);
                $this->db->set('hashtag_id', $hashtag_id);
                if ($this->db->insert($this->following_table_name)) {
                        return true;
                }
                return false;	
       }
       
       function unfollow_hashtag($follower_id, $hashtag_id) {
                $this->db->where('user_id', $follower_id);
                $this->db->where('hashtag_id', $hashtag_id);
                if ($this->db->delete($this->following_table_name)) {
                        return true;
                }
                return false;	
        }
        
        function is_followed($follower_id, $hashtag_id) {
       
                $this->db->where('user_id', $follower_id);
                $this->db->where('hashtag_id', $hashtag_id);
                $query = $this->db->get($this->following_table_name);
                
                if ($query->num_rows() > 0) {
                        return TRUE;
                }
                return FALSE;	
       }
       
       function get_followed_hashtags($follower_id, $page) {
                $stmt = "SELECT Hashtags.hashtag, Hashtags.hashtag_id, Hashtags.created
                        FROM Following
                        JOIN Hashtags ON Following.hashtag_id = Hashtags.hashtag_id
                        WHERE Following.user_id=".$follower_id."
                        ORDER BY Hashtags.hashtag_id DESC
                        LIMIT ".(($page-1)*10).",10";
                $query = $this->db->query($stmt);
		$results = $query->result_array();
                return $results;
       }
       
       public function get_followed_hashtags_count($user_id) {
                // for each argument passed...
                // 1 argument = just un, or just fn, or just ln
                // 2 arguments = fn/ln, ln/fn, un/fn, fn/un, un/ln, ln/un
                // 3 arguments = all combinations of possible fn, ln, un
                // if a developer inputs the second string and not the first, etc... be very angry
                
                $stmt = "SELECT COUNT(*) AS num_results FROM Following WHERE user_id=".$user_id." AND hashtag_id > 0";
                $query = $this->db->query($stmt);
		$results = $query->row_array();
                return $results['num_results'];
        }
        
        function get_number_posts_by_hashtag_id($hashtag_id) {
                $query = "SELECT COUNT(*) AS num_posts FROM Posts 
                            JOIN Post_Hashtags ON Posts.post_id = Post_Hashtags.post_id
                            JOIN Hashtags ON Hashtags.hashtag_id = Post_Hashtags.hashtag_id
                            WHERE Hashtags.hashtag_id=".$hashtag_id;
                $get = $this->db->query($query);
                $result = $get->row_array();
                return $result['num_posts'];
        }
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */