<?php
/**
 * top100 plugin for Craft CMS 3.x
 *
 * top100 plugin
 *
 * @link      https://www.verse.co.uk/
 * @copyright Copyright (c) 2021 Andrew Page
 */

namespace verse\top100tests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use verse\top100\Top100;

/**
 * ExampleUnitTest
 *
 *
 * @author    Andrew Page
 * @package   Top100
 * @since     1
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            Top100::class,
            Top100::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
