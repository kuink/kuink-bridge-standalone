<?php

require_once '../vendor/autoload.php';

use Kuink\Bridge\BridgeBootstrap;

$bridgeBootstrap = new BridgeBootstrap();
$bridgeBootstrap->bootstrap();
$bridgeBootstrap->loadCore();
