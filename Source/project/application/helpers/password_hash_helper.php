<?php
/*
 * Returns the hashed version of the password given, with a SALT
 * @param string $password
 * @return string
*/
function hashPassword($password) {
        return hash('sha256', $GLOBALS['pwSalt'].$password);
}
?>
