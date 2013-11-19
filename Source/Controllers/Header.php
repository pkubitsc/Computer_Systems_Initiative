<?php
/*
 * Header "controller" which basically connects to the database,
 * starts the session module, and tells us which models, controllers
 * and views we will be using.
 * 
 * @author Corey Geesey
 */

// Include the session module (most of the time it will be used as a singleton,
// but on th login and registration pages it will be used as a model
include_once(MOD_DIR.'UserSessionModel.php');


// Connect to the database
try {
    $db = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo DB_CONNECT_ERROR;
    echo $e;
    exit();
}

//print_r($pageData);
// here we start a new session object to use later
$session = new UserSessionModel($db);

/**
 * Page variable contains the current page that we will use (located in the URL index.php?page=****
 * to navigate.
 */
$page = $_GET['page'];

/**
 * Check if page variable is empty, or the user put in a variable that does not exist in our navigation array
 * Also check if a session exists, if not, the
 */
if (empty($page) || !array_key_exists($page, $pageData) || !isset($page)) {
    // use default index (login page)
    $page = 'index';
}

/**
 * If a session doesn't exist & the user is trying to go to a page other than login or register
 * then redirect them to the login page.
 * 
 * If a session does exist & the user tries to go to the login page, redirect them to the homepage
 */
$checkSession = $session->checkSession();
if (!$checkSession && (strcasecmp($page, 'index') != 0 && strcasecmp($page, 'register') != 0)) {
    $page = 'index';
} elseif ($checkSession && $_GET['action'] != "logout") {
    // a session exists, make sure page is home
    $page = 'home';
}

// get the values out of the array and set them to be used in index.php
// Check if it is the login page, if so, model is already loaded as UserSession, so set it as such
$m = $pageData[$page]['model'];
$v = $pageData[$page]['view'];
$c = $pageData[$page]['controller'];
?>
