<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tank_auth
 *
 * Authentication library for Code Igniter.
 *
 * @package		Tank_auth
 * @author		Ilya Konyukhov (http://konyukhov.com/soft/)
 * @version		1.0.9
 * @based on	DX Auth by Dexcell (http://dexcell.shinsengumiteam.com/dx_auth)
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */
class Haloc
{
	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();

		//$this->ci->load->config('haloc', TRUE);
		//$this->ci->load->library('session');
		//$this->ci->load->database();
		//$this->ci->load->model('tank_auth/users');
	}

	function hashtag_url_generator($posts) {
                if (empty($posts) || is_null($posts)) {
                        return array();
                } else {
                        $new_posts = array();
                        $i = 0;
                        foreach($posts AS $post) {
                                $post['post_content'] = preg_replace( "/#([^\s]+)/", "<a href=\"".$this->ci->config->item('base_url')."index.php/home/view_hashtag_profile/%23$1\">#$1</a>", $post['post_content'] );
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
                        $post['post_content'] = preg_replace( "/#([^\s]+)/", "<a href=\"".$this->ci->config->item('base_url')."index.php/home/view_hashtag_profile/%23$1\">#$1</a>", $post['post_content'] );
                        return $post;
                }
        }
        
        /*
         * Clean the hashtags, outputs an error otherwise
         * 
         */
        function clean_hashtags($hashtags) {
                // remove hashtag sign
                $hashtags_removed = $this->remove_many_hashtags($hashtags);

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
        
        function remove_hashtag($name) {
            return preg_replace('/^\#/', '', $name);
        }
        
        function remove_many_hashtags($array) {
            $new_array = array();
            foreach($array AS $key => $value) {
                $new_array[$key] = preg_replace('/^\#/', '', $value);
            }
            
            return $new_array;
        }
        
        function clean_sort_by($type_page) {
                $options_order = array(
                                    'default' => 'DESC',
                                    'DESC' => 'DESC',
                                    'ASC' => 'ASC');
                
                $options_posts = array(
                                    'default' => 'Posts.created',
                                    'created' => 'Posts.created',
                                    'username' => 'users.username',
                                    'likes' => 'Posts.post_likes',
                                    'replies' => 'Posts.post_replies');
                $options_hashtags = array(
                                    'default' => 'Hashtags.created',
                                    'created' => 'Hashtags.created',
                                    'hashtag' => 'Hashtags.hashtag');
                
                
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                        // clean them for protection
                        $order_by = xss_clean(trim($_GET['order_by']));
                        $order = xss_clean(trim($_GET['order']));
                        
                        // We want to protect the db... acertain which is which
                        if ($type_page == 'followed' || $type_page == 'yourposts' || $type_page == 'see_replies') {
                                if (array_key_exists($order_by, $options_posts)) {
                                        $data['order_by'] = $options_posts[$order_by];
                                } else {
                                        $data['order_by'] = $options_posts['default'];
                                }
                                
                                if (array_key_exists($order, $options_order)) {
                                        $data['order'] = $options_order[$order];
                                } else {
                                        $data['order'] = $options_order['default'];
                                }
                                
                                return $data;
                        }
                        
                }
                
                return null;
        }
}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */