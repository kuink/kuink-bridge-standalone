<?php
// ################################ KUINK START #######################################
global $KUINK_INCLUDE_PATH;
$KUINK_INCLUDE_PATH = realpath ( '' ) . '/kuink-core/';

global $KUINK_BRIDGE_CFG;
global $CFG;
$KUINK_BRIDGE_CFG = new stdClass;
$KUINK_BRIDGE_CFG->loginhttps = false;
$KUINK_BRIDGE_CFG->wwwroot = 'http://localhost/kuink/';
$KUINK_BRIDGE_CFG->dirroot = '/var/www/html/kuink';
$KUINK_BRIDGE_CFG->dataroot = '/opt/kuinkdata/';
$KUINK_BRIDGE_CFG->kuinkroot = '';
$KUINK_BRIDGE_CFG->theme = 'adminLTE2';

// ######## Authentication stuff ########
$roles = array ();
$currentRole = 'Teacher';
$roles [] = $currentRole;
// $roles[] = 'framework.admin';

$KUINK_BRIDGE_CFG->application = 'framework.page'; // Default application
$KUINK_BRIDGE_CFG->configuration = '<Configuration/>';

$KUINK_BRIDGE_CFG->auth = new stdClass;
$KUINK_BRIDGE_CFG->auth->user = new stdClass;
$KUINK_BRIDGE_CFG->auth->roles = $roles;
$KUINK_BRIDGE_CFG->auth->isAdmin = false;
$KUINK_BRIDGE_CFG->auth->currentRole = $currentRole;

$KUINK_BRIDGE_CFG->auth->user->id = 0;
$KUINK_BRIDGE_CFG->auth->user->firstName = 'Guest';
$KUINK_BRIDGE_CFG->auth->user->lastName = 'User';
$KUINK_BRIDGE_CFG->auth->user->lang = 'pt';
$KUINK_BRIDGE_CFG->auth->sessionKey = null;

$KUINK_BRIDGE_CFG->trigger = new stdClass; //The url to set in breadcrumb after home. On other bridges this is the external point where kuink was triggered. Allow get back to that url
$KUINK_BRIDGE_CFG->trigger->url = null;
$KUINK_BRIDGE_CFG->trigger->label = null;
// ################################ KUINK END #######################################
?>
