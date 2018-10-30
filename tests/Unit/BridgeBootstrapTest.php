<?php
/**
 * Created by PhpStorm.
 * User: jmp
 * Date: 10/29/2018
 * Time: 12:40 PM
 */

namespace Kuink\Bridge\Tests\Unit;

use Kuink\Bridge\BridgeBootstrap;

class BridgeBootstrapTest extends BaseUnitTest
{
    public function testLoadEnv()
    {
        $bootstrap = new BridgeBootstrap();
        $bootstrap->bootstrap();
        global $KUINK_BRIDGE_CFG;
        $this->assertNotEmpty($KUINK_BRIDGE_CFG, 'Configuration loaded into $KUINK_BRIDGE_CFG');
    }
}
