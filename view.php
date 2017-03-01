<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Prints a particular instance of kuink
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package   mod_kuink
 * @copyright 2010 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


//for all dates, set utc timezone. 
date_default_timezone_set('UTC');

session_start();

//################################ KUINK START #######################################
global $KUINK_INCLUDE_PATH;
$KUINK_INCLUDE_PATH = realpath('').'/kuink-core/';

global $KUINK_BRIDGE_CFG;

include ('./bridge_config.php');

if ($_SESSION['kuink.logged']==0)
	$KUINK_BRIDGE_CFG->application = 'framework.login';

//var_dump($_SESSION['kuink.logged']);
//var_dump($KUINK_BRIDGE_CFG->application);

include ('./kuink-core/view.php');
//################################ KUINK END #######################################

?>
