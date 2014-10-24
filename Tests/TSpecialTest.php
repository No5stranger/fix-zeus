<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Fixzeus\Model\TSpecial;

class TSpecialTest extends PHPUnit_Framework_TestCase
{
    public function specialDataProvider()
    {
        return array(
            array(__DIR__ . '/special.json', 'name', 'cjp'),
            array('TB.php', 'cjp', false)
        );
    }

    /**
     * @dataProvider specialDataProvider
     */
    public function testCustomize($path, $var, $val)
    {
        $this->assertEquals(TSpecial::customize($path, $var), $val);
    }
}
