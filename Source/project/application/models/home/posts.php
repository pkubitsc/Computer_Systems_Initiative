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
class Posts extends CI_Model
{
	private $table_name			= 'Posts';			// posts table
	private $likes_table_name	= 'PostLIkes';	// post likes table
        private $post_hashtags_table_name	= 'Post_Hashtags';	// post hashtags table
        private $hashtags_table_name	= 'Hashtags';	// hashtags table
        private $users_table_name       = 'users';
        private $post_likes_table_name       = 'PostLikes';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
	}

        
        /**
         * Adds the post to the database
         * 
         * @param int $user_id
         * @param string $content
         * @param int $parent_id
         */
        function add_post($user_id, $content, $parent_id = 0) {
                $this->db->set('post_content', $content);
		$this->db->set('user_id', $user_id);
                $this->db->set('parent_id', $parent_id);
                $this->db->set('created', date('Y-m-d H:i:s'));
                
                if ($this->db->insert($this->table_name)) {
                    $post_id = $this->db->insert_id();
                    return array('post_id' => $post_id);
                }
		return NULL;
        }
        
        function get_number_posts_by_user_id($user_id) {
                $query = "SELECT COUNT(*) AS num_posts FROM Posts WHERE user_id=".$user_id;
                $get = $this->db->query($query);
                $result = $get->row_array();
                return $result['num_posts'];
        }
        
        function get_posts_by_user_id($user_id, $page = 1) {
                
                $query = "SELECT Posts.*, users.username, user_profiles.profile_image,
                            (SELECT COUNT(*) FROM PostLikes WHERE PostLikes.user_id=Posts.user_id AND PostLikes.post_id=Posts.post_id) AS is_liked
                            FROM Posts
                            JOIN users ON Posts.user_id = users.id
                            JOIN user_profiles ON Posts.user_id = user_profiles.user_id
                            WHERE Posts.user_id=".$user_id."
                            ORDER BY Posts.created DESC
                            LIMIT ".(($page-1)*10).",10";
                
                //$this->db->select('Posts.*, users.username, user_profiles.profile_image', FALSE);
                //$this->db->join($this->users_table_name, 'Posts.user_id = users.id');
                //$this->db->join('user_profiles', 'Posts.user_id = user_profiles.user_id');
                //$this->db->join('PostLikes', 'Posts.user_id = PostLikes.user_id AND Posts.post_id = PostLikes.post_id');
                //$this->db->where('Posts.user_id', $user_id);
                //$this->db->limit(10, $page*10);
                
                //$query = $this->db->get($this->table_name);
                
                $get = $this->db->query($query);
                
                //$query = $this->db->query("SELECT * FROM ".$this->table_name." WHERE user_id=".$user_id);
		return $get->result_array();
                    
        }
        
        function like_post($user_id, $post_id, $num_likes) {
                // insert int PostLikeTable
                $this->db->set('post_id', $post_id);
		$this->db->set('user_id', $user_id);
                $this->db->set('datetime', date('Y-m-d H:i:s'));

                if ($this->db->insert($this->post_likes_table_name)) {
                        // update likes number in put
                        ++$num_likes;
                        $this->db->set('post_likes', $num_likes);
                        $this->db->where('post_id', $post_id);
                        
                        $this->db->update($this->table_name);
                }
		return NULL;
        }
        
        function dislike_post($user_id, $post_id) {
                // insert int PostLikeTable
                $this->db->where('post_id', $post_id);
		$this->db->where('user_id', $user_id);
                
                if ($this->db->delete($this->post_likes_table_name)) {
                        // update likes number in put
                        --$num_likes;
                        $this->db->set('post_likes', $num_likes);
                        $this->db->where('post_id', $post_id);
                        
                        $this->db->update($this->table_name);
                }
		return NULL;
        }
        
        function is_liked($user_id, $post_id) {
                $this->db->where('user_id', $user_id);
                $this->db->where('post_id', $post_id);
                $query = $this->db->get($this->post_likes_table_name);
                if ($query->num_rows() > 0) {
                        return TRUE;
                }
                        return FALSE;
        }
        
        function is_post($post_id) {
                $this->db->where('post_id', $post_id);
                $query = $this->db->get($this->table_name);
                if ($query->num_rows() > 0) {
                        return TRUE;
                }
                        return FALSE;
        }
        
	/**
	 * Get post record by Id
         *  - Must include hashtag data
         *  - Must include like data
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_post_by_id($post_id)
	{
		$this->db->where('post_id', $post_id);
                $this->db->query("SELECT");

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
        
        function get_post_likes_by_id($post_id)
	{
		$this->db->where('post_id', $post_id);
                $this->db->query("SELECT");

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
        }
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */