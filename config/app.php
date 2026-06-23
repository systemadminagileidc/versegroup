<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use craft\helpers\App;

return [
    '*' => [
        'modules' => [
            'upgrade-module' => [
                'class' => \modules\upgrademodule\UpgradeModule::class,
            ],
            'dashboard-widget-module' => [
                'class' => \modules\dashboardwidgetmodule\DashboardWidgetModule::class,
            ],
        ],
        'bootstrap' => ['upgrade-module','dashboard-widget-module'],
    ],
    'id' => App::env('APP_ID') ?: 'CraftCMS',
    'db' => function() {
        $config = craft\helpers\App::dbConfig();
        $config['enableSchemaCache'] = true;
        $config['schemaCacheDuration'] = 60; // 1 day
        return Craft::createObject($config);
    },
];
