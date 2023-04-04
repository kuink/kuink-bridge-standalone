<?php
global $KUINK_INCLUDE_PATH;
$KUINK_INCLUDE_PATH = realpath ( '' ) . '/kuink-core/';

global $KUINK_BRIDGE_CFG;

include ('./bridge_config.php');

include ('./kuink-core/stream.php');
//################################ KUINK END #######################################