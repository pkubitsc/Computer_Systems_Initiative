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
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_hashtag_id($name)
	{
                // remove the pound sign if there
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
                $hashtags = implode(",", $names);
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
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */