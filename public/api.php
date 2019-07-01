<?php

require_once '../vendor/autoload.php';
error_reporting(1);
use Kuink\Bridge\BridgeBootstrap;

$bridgeBootstrap = new BridgeBootstrap();
$bridgeBootstrap->startSession();
$bridgeBootstrap->bootstrap();
$bridgeBootstrap->api();
