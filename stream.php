<?php
global $CFG;
require_once(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))).'/config.php');
require_once($CFG->libdir.'/ddllib.php');
require_once('lib.php');
require_once('locallib.php');
require_once($CFG->libdir.'/weblib.php');
require_once($CFG->libdir.'/filelib.php');

//################################ KUINK START #######################################
global $KUINK_INCLUDE_PATH, $KUINK_BRIDGE_CFG;

include ('./bridge_config.php');

include ('./kuink-core/stream.php');
//################################ KUINK END #######################################