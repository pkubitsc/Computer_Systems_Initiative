<?php
/*
 * Config file contains all of the configuration information pertaining
 * to the HALOC hoot system.
 * 
 * @author Corey Geesey
 */

// db connection info
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "mysql";
$dbName = "haloc";

// password salt for the hash
$pwSalt = "CSI_361_Best";

// Maximum login attempts
$maxLoginAttempts = 4;
$loginLockoutTime = 5; // amount of time (in minutes) of how long a user will be locked out from attempting to login.

// image variables
$imageWidth = 50; // in pixels
$imageHeight = 50;
$imageQuality = 100; // 100 best quality, 0 worst

// pageData is the list of all combinations of pages that we need to use for navigating
$pageData = array(
    'index' => array('model' => 'UserSessionModel', 'view' => 'LoginView', 'controller' => 'IndexController'),
    'register' => array('model' => 'UserSessionModel', 'view' => 'RegisterView', 'controller' => 'IndexController'),
    'home' => array('model' => 'HomeModel', 'view' => 'HomeView', 'controller' => 'HomeController'),
    'search' => array('model' => 'SearchModel', 'view' => 'SearchView', 'controller' => 'SearchController'),
    'profile' => array('model' => 'ProfileModel', 'view' => 'ProfileView', 'controller' => 'ProfileController'),
);

// Directories
define("MOD_DIR", "Modules/");
define("CTRL_DIR", "Controllers/");
define("VIEW_DIR", "Views/");
define("TEMPLATE_DIR", "Templates/");
define("IMAGES_DIR", "UserImages/");
define("IMAGES_TEMPDIR", "UserImages/Temp/");
define ('SITE_ROOT', realpath(dirname(__FILE__))."/");

// Templates
define("LOGIN_TEMPLATE", "LoginTemplate.php");
define("HOME_TEMPLATE", "HomeTemplate.php");
define("REGISTER_TEMPLATE", "RegisterTemplate.php");

define("SUCCESS", 1);

// Error messages configuration. Any errors that pop up will need to be defined for use throughout
// the system.
define("ERROR_DB_CONNECT", "Database Connection failed. Please check your inputs and try again.");
define("ERROR_LOGIN", "Username and/or password is incorrect. Please try again.");
define("ERROR_LOGIN_ATTEMPTS", "You have attempted to login too many times. Please try again later.");
define("ERROR_REGISTRATION", "There was a problem with your registration. Please try again later.");
define("ERROR_INCORRECT_IMAGETYPE", "The image uploaded is not a jpeg, bmp, gif or png file.");
define("ERROR_IMAGESIZE", "Your image was too large to upload.");
define("ERROR_IMAGEUPLOAD", "There seems to be a problem uploading your image.");
define("ERROR_ACCTCREATED_IMAGEFAIL", "Your account was created. However, we could not upload your image for some reason.");
?>
