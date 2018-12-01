<?php

namespace Kuink\Bridge;;
use Dotenv\Dotenv;
global $KUINK_BRIDGE_CFG, $KUINK_CFG;

/**
 * Does the bridge bootstrap
 */
class BridgeBootstrap
{
    public function startSession()
    {
        session_start();
    }

    /**
     * Bootstrap the bridge
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->loadEnv();

        // for all dates, set utc timezone.
        date_default_timezone_set(getenv('DEFAULT_TIMEZONE'));
        ini_set("display_errors=", getenv('DEBUG') == '1' ? '1' : '0');


        // ################################ KUINK START #######################################
        global $KUINK_INCLUDE_PATH;
        global $KUINK_BRIDGE_CFG;
        global $CFG;

        $KUINK_INCLUDE_PATH = getenv('KUINK_INCLUDE_PATH');
        $KUINK_BRIDGE_CFG = new \stdClass;
        $KUINK_BRIDGE_CFG->loginhttps = getenv('LOGIN_HTTPS');
        $KUINK_BRIDGE_CFG->wwwRoot = getenv('WWW_ROOT');
        $KUINK_BRIDGE_CFG->dirRoot = getenv('DIR_ROOT');
        $KUINK_BRIDGE_CFG->dataRoot = getenv("DATA_ROOT");
        $KUINK_BRIDGE_CFG->appRoot = getenv('APP_ROOT');
        $KUINK_BRIDGE_CFG->kuinkRoot = getenv('KUINK_ROOT');
        $KUINK_BRIDGE_CFG->theme = getenv('THEME');
        $KUINK_BRIDGE_CFG->themeRoot = getenv('THEME_ROOT');
        $KUINK_BRIDGE_CFG->bridge = 'kuink-bridge-standalone/public';        
        $KUINK_BRIDGE_CFG->uploadVirtualPrefix = getenv('UPLOAD_VIRTUAL_PREFIX'); //Only for neon compatibility. Leave blank in a fresh install.

        // ######## Authentication stuff ########
        $roles = [];
        $currentRole = getenv('AUTH_CURRENT_ROLE');
        $roles[] = $currentRole;
        // $roles[] = 'framework.admin';

        $KUINK_BRIDGE_CFG->application = getenv('DEFAULT_APPLICATION'); // Default application
        $KUINK_BRIDGE_CFG->configuration = getenv('DEFAULT_CONFIGURATION');

        $KUINK_BRIDGE_CFG->auth = new \stdClass;
        $KUINK_BRIDGE_CFG->auth->user = new \stdClass;
        $KUINK_BRIDGE_CFG->auth->roles = $roles;
        $KUINK_BRIDGE_CFG->auth->isAdmin = false;
        $KUINK_BRIDGE_CFG->auth->currentRole = $currentRole;

        $KUINK_BRIDGE_CFG->auth->user->id = getenv('AUTH_USER_ID');
        $KUINK_BRIDGE_CFG->auth->user->firstName = getenv('AUTH_USER_FIRST_NAME');
        $KUINK_BRIDGE_CFG->auth->user->lastName = getenv('AUTH_USER_LAST_NAME');
        $KUINK_BRIDGE_CFG->auth->user->lang = getenv('AUTH_USER_LANG');
        $KUINK_BRIDGE_CFG->auth->sessionKey = null;

        $KUINK_BRIDGE_CFG->trigger = new \stdClass; //The url to set in breadcrumb after home. On other bridges this is the external point where kuink was triggered. Allow get back to that url
        $KUINK_BRIDGE_CFG->trigger->url = null;
        $KUINK_BRIDGE_CFG->trigger->label = null;
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

        global $KUINK_BRIDGE_CFG, $KUINK_CFG;

        require_once ('./kuink-core/bootstrap/autoload.php');

        $layoutAdapter = \Kuink\UI\Layout\Layout::getInstance ();
        $layoutAdapter->setCache ( false );
        $layoutAdapter->setTheme ( 'adminlte' );

        $kuinkCore = new \Kuink\Core($KUINK_BRIDGE_CFG, $layoutAdapter, $KUINK_CFG);
        $kuinkCore->run();

        $layoutAdapter->render();
    }

    public function stream()
    {
        global $KUINK_BRIDGE_CFG, $KUINK_CFG, $KUINK;
        $KUINK = new \stdClass();
        $KUINK->id = null;
        $KUINK->fullname = '';
        $KUINK->appname = 'framework';
        $KUINK->config = '<Configuration/>';

        $type = $_GET ['type'];
        $guid = $_GET ['guid'];

        require_once ('./kuink-core/bootstrap/autoload.php');
        $kuinkCore = new \Kuink\Core($KUINK_BRIDGE_CFG, null, $KUINK_CFG);
        $kuinkCore->stream($type, $guid);
    }

    public function api()
    {
        global $KUINK_BRIDGE_CFG, $KUINK_CFG, $KUINK;
        $function = isset ( $_GET ['neonfunction'] ) ? ( string ) $_GET ['neonfunction'] : '';

        require_once ('./kuink-core/bootstrap/autoload.php');
  
        //Authenticate user if token is present
        \Kuink\Core\ProcessOrchestrator::registerAPI($function);
        $_SESSION['_kuink_api_security_bypass'] = true;
        
        $kuinkCore = new \Kuink\Core($KUINK_BRIDGE_CFG, null, $KUINK_CFG);
        $kuinkCore->call($function);
    }


}
