<?php
/**
 * Index page
 *  - Basically acts as a "holder" and brings everything together that is needed.
 * 
 * @author Corey Geesey
 */


/**
 * Session_start() must be at the top of the page, which is why it is placed here
 */
session_start();

// include config file.
include_once('Config.php');

// call header file. Header file will handle all of the session, db & routing
include_once(CTRL_DIR.'Header.php');

/* 
 * Checks if the $page value is at index, if so, use the already initialized $session module
 * Also include the file if not
 */
if (strcasecmp($page, 'index') == 0) {
    $model = $session;
} else {
    include_once(MOD_DIR.$m.".php");
    $model = new $m($db, $session);
}

// Include the necessary model, control, and view files
include_once(CTRL_DIR.$c.".php");
include_once(VIEW_DIR.$v.".php");

// Instantiate the other necessary classes
$view = new $v($model);
$controller = new $c($model, $view);

// Invoke the controller
$controller->invoke();
?>
