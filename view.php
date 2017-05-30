<?php

// for all dates, set utc timezone.
date_default_timezone_set ( 'UTC' );

session_start ();
// ################################ KUINK START #######################################
global $KUINK_INCLUDE_PATH;
$KUINK_INCLUDE_PATH = realpath ( '' ) . '/kuink-core/';

global $KUINK_BRIDGE_CFG;

include ('./bridge_config.php');

if ($_SESSION ['kuink.logged'] == 0)
	$KUINK_BRIDGE_CFG->application = 'framework.login';
	
	// var_dump($_SESSION['kuink.logged']);
	// var_dump($KUINK_BRIDGE_CFG->application);

include ('./kuink-core/view.php');
// ################################ KUINK END #######################################

?>
