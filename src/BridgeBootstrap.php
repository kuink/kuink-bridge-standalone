<?php

namespace Kuink\Bridge;

use Dotenv\Dotenv;
use Kuink\Core\Configuration;
use Kuink\Core\Core;
use Kuink\Core\ProcessOrchestrator;

/**
 * Does the bridge bootstrap
 */
class BridgeBootstrap
{
    /**
     * Start a session
     * @return void
     */
    public function startSession()
    {
        session_start();
        ob_start();
    }

    /**
     * Bootstrap the bridge
     *
     * @return void
     */
    public function bootstrap()
    {
        $configurationValues = parse_ini_file(__DIR__.'/../../../config/config.ini', true, INI_SCANNER_TYPED);
        if ($configurationValues === false) {
            die('No configuration found in '.realpath(__DIR__.'/../../../config/config.ini'));
        }
        $configuration = Configuration::creatFromArray($configurationValues);

        // for all dates, set utc timezone.
        date_default_timezone_set($configuration->defaults->timezone ?? 'UTC');
        ini_set('display_errors', $configuration->debug ?? 0);
    }

    /**
     * Loads the .env configuration into $_ENV variables
     *
     * @return void
     */
    protected function loadEnv()
    {
        $dotenv = new Dotenv(__DIR__ . '/..');
        $dotenv->load();
    }

    /**
     * Load kuink core runtime
     *
     * @return void
     */
    public function loadCore()
    {
        $layoutAdapter = \Kuink\UI\Layout\Layout::getInstance();
        $layoutAdapter->setCache(false);
        $layoutAdapter->setTheme('adminlte');

        $kuinkCore = new Core();
        $kuinkCore->run();

        $layoutAdapter->render();
    }

    /**
     * Render a file stream
     */
    public function stream()
    {
        global $KUINK_BRIDGE_CFG, $KUINK_CFG, $KUINK;
        $KUINK = new \stdClass();
        $KUINK->id = null;
        $KUINK->fullname = '';
        $KUINK->appname = 'framework';
        $KUINK->config = '<Configuration/>';

        $type = $_GET['type'];
        $guid = $_GET['guid'];


        $kuinkCore = new Core();
        $kuinkCore->stream($type, $guid);
    }

    /**
     * Render api
     */
    public function api()
    {
        global $KUINK_BRIDGE_CFG, $KUINK_CFG, $KUINK;
        $function = isset($_GET['neonfunction']) ? ( string )$_GET['neonfunction'] : '';

        //Authenticate user if token is present
        ProcessOrchestrator::registerAPI($function);
        $_SESSION['_kuink_api_security_bypass'] = true;

        $kuinkCore = new Core();
        $kuinkCore->call($function);
    }
}
