<?php
/**
 * top100 plugin for Craft CMS 3.x
 *
 * top100 plugin
 *
 * @link      https://www.verse.co.uk/
 * @copyright Copyright (c) 2021 Verse
 */

namespace verse\top100;

use verse\top100\etc\Routes;
use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Top100
 *  Core plugin to init plugin, controllers, routes and services
 */
class Top100 extends Plugin
{
    use Routes;

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Top100::$plugin
     *
     * @var Top100
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1';

    /**
     * Set to `true` if the plugin should have a settings view in the control panel.
     *
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * Set to `true` if the plugin should have its own section (main nav item) in the control panel.
     *
     * @var bool
     */
    public $hasCpSection = false;

    /**
     * init
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register our site routes
        $this->_registerSiteRoutes();

        // Do something after we're installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                }
            }
        );

        Craft::info(
            Craft::t(
                'top100',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
