<?php
/**
 * Tests for the flags class.
 *
 * @package WPZAPP\Flags
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Flags\Tests;

use WPZAPP\Flags\Flags;
use PHPUnit\Framework\TestCase;

class FlagsTest extends TestCase
{

    const TESTFLAG1 = 1;

    const TESTFLAG2 = 2;

    const TESTFLAG3 = 4;

    const TESTFLAG4 = 8;

    const TESTFLAG5 = 16;

    const TESTFLAG6 = 32;

    /**
     * @dataProvider dataSetFlag
     */
    public function testSetFlag($flags, $expected)
    {
        $container = new Flags();

        foreach ($flags as $flag => $value) {
            $container->setFlag($flag, $value);
        }

        $this->assertSame($expected, $container->getFlags());
    }

    public function dataSetFlag()
    {
        return array(
            array(
                array(
                    self::TESTFLAG1 => true,
                    self::TESTFLAG2 => true,
                    self::TESTFLAG3 => false,
                    self::TESTFLAG5 => true,
                    self::TESTFLAG2 => false,
                ),
                self::TESTFLAG1 | self::TESTFLAG5,
            ),
            array(
                array(
                    self::TESTFLAG1 => false,
                    self::TESTFLAG3 => false,
                    self::TESTFLAG3 => true,
                    self::TESTFLAG6 => true,
                    self::TESTFLAG3 => false,
                ),
                self::TESTFLAG6,
            ),
            array(
                array(
                    self::TESTFLAG1 => true,
                    self::TESTFLAG4 => true,
                    self::TESTFLAG4 => false,
                    self::TESTFLAG1 => false,
                ),
                0,
            ),
            array(
                array(),
                0,
            ),
            array(
                array(
                    self::TESTFLAG1 => true,
                    self::TESTFLAG2 => true,
                    self::TESTFLAG3 => true,
                    self::TESTFLAG4 => true,
                    self::TESTFLAG5 => true,
                    self::TESTFLAG6 => true,
                ),
                self::TESTFLAG1 | self::TESTFLAG2 | self::TESTFLAG3 | self::TESTFLAG4 | self::TESTFLAG5 | self::TESTFLAG6,
            ),
        );
    }

    /**
     * @dataProvider dataIsFlagSet
     */
    public function testIsFlagSet($flagsValue, $expected)
    {
        $container = new Flags($flagsValue);

        $result = array();
        foreach ($expected as $flag => $value) {
            $result[$flag] = $container->isFlagSet($flag);
        }

        $this->assertSame($expected, $result);
    }

    public function dataIsFlagSet()
    {
        return array(
            array(
                self::TESTFLAG1 | self::TESTFLAG3 | self::TESTFLAG4,
                array(
                    self::TESTFLAG1 => true,
                    self::TESTFLAG2 => false,
                    self::TESTFLAG3 => true,
                    self::TESTFLAG4 => true,
                    self::TESTFLAG5 => false,
                    self::TESTFLAG6 => false,
                ),
            ),
            array(
                self::TESTFLAG4 | self::TESTFLAG5,
                array(
                    self::TESTFLAG1 => false,
                    self::TESTFLAG2 => false,
                    self::TESTFLAG3 => false,
                    self::TESTFLAG4 => true,
                    self::TESTFLAG5 => true,
                    self::TESTFLAG6 => false,
                ),
            ),
            array(
                0,
                array(
                    self::TESTFLAG1 => false,
                    self::TESTFLAG2 => false,
                    self::TESTFLAG3 => false,
                    self::TESTFLAG4 => false,
                    self::TESTFLAG5 => false,
                    self::TESTFLAG6 => false,
                ),
            ),
            array(
                self::TESTFLAG1 | self::TESTFLAG2 | self::TESTFLAG3 | self::TESTFLAG4 | self::TESTFLAG5 | self::TESTFLAG6,
                array(
                    self::TESTFLAG1 => true,
                    self::TESTFLAG2 => true,
                    self::TESTFLAG3 => true,
                    self::TESTFLAG4 => true,
                    self::TESTFLAG5 => true,
                    self::TESTFLAG6 => true,
                ),
            ),
        );
    }

    /**
     * @dataProvider dataGetFlags
     */
    public function testGetFlags($flagsValue)
    {
        $container = new Flags($flagsValue);

        $this->assertSame($flagsValue, $container->getFlags());
    }

    public function dataGetFlags()
    {
        return array(
            array(0),
            array(self::TESTFLAG2 | self::TESTFLAG3),
            array(self::TESTFLAG4 | self::TESTFLAG5 | self::TESTFLAG6),
        );
    }
}
