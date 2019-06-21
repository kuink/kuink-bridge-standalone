<?php

// for all dates, set utc timezone.
date_default_timezone_set('UTC');

session_start();
// ################################ KUINK START #######################################
global $KUINK_INCLUDE_PATH;
global $KUINK_BRIDGE_CFG;
$KUINK_INCLUDE_PATH = realpath('') . '/kuink-core/';


include('./bridge_config.php');

if (isset($_SESSION['kuink.logged']) && ($_SESSION['kuink.logged'] == 0))
	$KUINK_BRIDGE_CFG->application = 'framework.login';
else {
	//Inject the user from framework.login application through session object
	$user = isset($_SESSION['kuink.logged.user']) ? $_SESSION['kuink.logged.user'] : null; //Comes from login application
	$KUINK_BRIDGE_CFG->auth->user->id = $user['id'];
	$KUINK_BRIDGE_CFG->auth->user->firstName = $user['firstName'];
	$KUINK_BRIDGE_CFG->auth->user->lastName = $user['lastName'];
	$KUINK_BRIDGE_CFG->auth->user->lang = $user['lang'];
	$KUINK_BRIDGE_CFG->auth->sessionKey = null;
}

// var_dump($_SESSION['kuink.logged']);
// var_dump($KUINK_BRIDGE_CFG->application);

include($KUINK_INCLUDE_PATH . '/bootstrap/autoload.php');
// ################################ KUINK END #######################################

?>
