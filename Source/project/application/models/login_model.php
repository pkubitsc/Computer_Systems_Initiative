<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author Corey Geesey
 */
class Login_model extends CI_Model {  
    private $inst;
    function Login_model()  
    {  
        // Call the Model constructor  
        parent::__construct();
        
        // load required helpers
        $inst = get_instance();
        $inst->load->helper('password_hash');
    }  
      
    /*
     * Verifies the given username and password against the database
     * If they are correct, the user is logged in.
     * If not, returns false.
     */
    public function login($username, $password) {
        // Checks if either variable is empty
        if (empty($username) || empty($password)) {
            return ERROR_LOGIN;
        }

        // Check login attempts
        if ($this->session->getSessionAttempts() >= $GLOBALS['maxLoginAttempts']) {
            if ($this->session->getSessionTimestamp()+$GLOBALS['loginLockoutTime']*60 < time()) {
                $this->session->resetSessionAttempts();
            } else {
                return ERROR_LOGIN_ATTEMPTS;
            }
        }

        // prepare the password by hashing it
        $password = $this->hashPassword($password);
        $stmt = $this->db->prepare("SELECT user_id, username FROM Users WHERE username = ? AND password = ?");
        $stmt->execute(array($username, $password));
        $results = $stmt->fetchAll();
        
        if (count($results) != 1) {
            $this->session->incrementSessionAttempts();
            return ERROR_LOGIN;
        } else {
            $this->session->beginSession($results[0]['username'], $results[0]['user_id']);
            return SUCCESS;
        }
    } 
  
}  

?>
