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

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->post_hashtags_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->post_hashtags_table_name;
	}

        function remove_hashtag($name) {
            return preg_replace('/^\#/', '', $name);
        }
        
        function remove_many_hashtags($array) {
            foreach($array AS $key => $value) {
                $new_array[$key] = preg_replace('/^\#/', '', $value);
            }
            
            return $new_array;
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
                $name = $this->remove_hashtag($name);
                
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
                $str = "SELECT hashtag, hashtag_id FROM Hashtags WHERE hashtag IN ('".implode('\',\'', $names)."')";
		$query = $this->db->query($str);
                return $query->result_array();
	}
        
        function add_hashtag($name) {
                $this->db->set('hashtag', $this->remove_hashtag($name));
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
        
        public function search_hashtags($str1 = null, $page = 1) {
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
<<<<<<< HEAD
                $stmt = "SELECT Hashtags.* FROM Hashtags WHERE soundex(Hashtags.hashtag) = soundex('".$str1."')
                        ORDER BY hashtag DESC
                        LIMIT ".(($page-1)*10).",10";
=======
                $stmt = "SELECT Hashtags.* FROM Hashtags WHERE soundex(Hashtags.hashtag) = soundex('".$str1."')";;
>>>>>>> ab745b3c1c860e02e056d5f846dcfebc2ae3b9d2
                $query = $this->db->query($stmt);
		$results = $query->result_array();
                return $results;
        }
        
        public function search_hashtags_count($str1 = null) {
                // for each argument passed...
                // 1 argument = just un, or just fn, or just ln
                // 2 arguments = fn/ln, ln/fn, un/fn, fn/un, un/ln, ln/un
                // 3 arguments = all combinations of possible fn, ln, un
                // if a developer inputs the second string and not the first, etc... be very angry
                
<<<<<<< HEAD
                $stmt = "SELECT COUNT(*) AS num_results FROM Hashtags WHERE soundex(hashtag) = soundex('".$str1."')";
                $query = $this->db->query($stmt);
		$results = $query->row_array();
                return $results['num_results'];
=======
                $stmt = "SELECT COUNT(Hashtags.*) AS num_results FROM Hashtags WHERE soundex(Hashtags.hashtag) = soundex('".$str1."')";
                $query = $this->db->query($stmt);
		$results = $query->row_array();
                return $results;
>>>>>>> ab745b3c1c860e02e056d5f846dcfebc2ae3b9d2
        }
        
        function follow_hashtag($follower_id, $hashtag_id) {
                $this->db->set('user_id', $follower_id);
                $this->db->set('hashtag_id', $hashtag_id);
                if ($this->db->insert($this->following_table_name)) {
                        return true;
                }
                return false;	
       }
<<<<<<< HEAD
       
       function unfollow_hashtag($follower_id, $hashtag_id) {
                $this->db->where('user_id', $follower_id);
                $this->db->where('hashtag_id', $hashtag_id);
                if ($this->db->delete($this->following_table_name)) {
                        return true;
                }
                return false;	
        }
=======
>>>>>>> ab745b3c1c860e02e056d5f846dcfebc2ae3b9d2
        
        function is_followed($follower_id, $hashtag_id) {
       
                $this->db->where('user_id', $follower_id);
                $this->db->where('hashtag_id', $hashtag_id);
                $query = $this->db->get($this->following_table_name);
                
                if ($query->num_rows() > 0) {
                        return TRUE;
                }
                return FALSE;	
       }
<<<<<<< HEAD
       
       function get_followed_hashtags($follower_id, $page) {
                $stmt = "SELECT Hashtags.hashtag, Hashtags.hashtag_id
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
=======
>>>>>>> ab745b3c1c860e02e056d5f846dcfebc2ae3b9d2
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */