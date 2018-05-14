<?php
// ################################ KUINK START #######################################
global $KUINK_INCLUDE_PATH;
$KUINK_INCLUDE_PATH = '/opt/kuink-dev/kuink-core/';

global $KUINK_BRIDGE_CFG;
global $CFG;
$KUINK_BRIDGE_CFG->loginhttps = false;
$KUINK_BRIDGE_CFG->wwwroot = 'http://localhost';
$KUINK_BRIDGE_CFG->dirroot = '/var/www/html/kuink';
$KUINK_BRIDGE_CFG->dataroot = '/opt/kuinkdata/';
$KUINK_BRIDGE_CFG->kuinkroot = '';
$KUINK_BRIDGE_CFG->theme = 'adminLTE2';

// ######## Authentication stuff ########
$roles = array ();
$currentRole = 'Teacher';
$roles [] = $currentRole;
// $roles[] = 'framework.admin';

$KUINK_BRIDGE_CFG->application = 'framework.dashboard'; // Default application
$KUINK_BRIDGE_CFG->configuration = '<Configuration/>';

$KUINK_BRIDGE_CFG->auth->roles = $roles;
$KUINK_BRIDGE_CFG->auth->isAdmin = false;
$KUINK_BRIDGE_CFG->auth->currentRole = $currentRole;

$KUINK_BRIDGE_CFG->auth->user->id = 1;
$KUINK_BRIDGE_CFG->auth->user->firstName = 'Demo';
$KUINK_BRIDGE_CFG->auth->user->lastName = 'User';
$KUINK_BRIDGE_CFG->auth->user->lang = 'en';
$KUINK_BRIDGE_CFG->auth->sessionKey = null;

// ################################ KUINK END #######################################
?>