<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

$isNgrok = array_key_exists("HTTP_X_ORIGINAL_HOST", $_SERVER) && strpos($_SERVER["HTTP_X_ORIGINAL_HOST"], "ngrok");
$host = 'http://' . $_SERVER[$isNgrok ? 'HTTP_X_ORIGINAL_HOST' : 'SERVER_NAME'] . '/';

return [
    // Global settings
    '*' => [
'runQueueAutomatically' => true,
        'extraFileKinds' => [
            'svg' => [
                'label' => 'SVG',
                'extensions' => ['svg'],
            ],
        ],
        'aliases' => [
            '@siteName' => getenv('SITE_NAME'),
            '@mapApi' => getenv('MAPS_API'),
            '@mapId' => getenv('MAP_ID'),
            '@gtm' => getenv('GTM'),
            '@email' => getenv('SITE_EMAIL'),
        ],
        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 1,

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => true,

        // Control panel trigger word
        'cpTrigger' => 'admin',

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => App::env('SECURITY_KEY'),
        'generateTransformsBeforePageLoad' => true

    ],

    // Dev environment settings
    'dev' => [
        // Dev Mode (see https://craftcms.com/guides/what-dev-mode-does)
        'devMode' => true,

        // Prevent crawlers from indexing pages and following links
        'disallowRobots' => true,

        'siteUrl' => $host,
        'baseCpUrl' => $host,
        'aliases' => [
            '@web' => $host,
            '@assetsUrl' => '@web/assets',
            '@siteURL' => getenv('SITE_URL'),
        ],
        'enableTemplateCaching' => false,
        // Logging in to the CP will fail unless you turn off CSRF protection.
        'enableCsrfProtection' => false,
        // Craft config settings from .env variables
        'enableGraphQlCaching' => (bool)getenv('ENABLE_GQL_CACHING'),
    ],

    // Staging environment settings
    'staging' => [
        // Set this to `false` to prevent administrative changes from being made on Staging
        'allowAdminChanges' => false,
        // Don’t allow updates on Staging
        'allowUpdates' => false,

        // Prevent crawlers from indexing pages and following links
        'disallowRobots' => true,
        'devMode' => true,
        'enableTemplateCaching' => false,
        'siteUrl' => getenv('SITE_URL'),
        'aliases' => [
            '@web' => getenv('SITE_URL'),
            '@assetsUrl' => '@web/assets',
        ],
    ],

    // Production environment settings
    'production' => [
        // Set this to `false` to prevent administrative changes from being made on Production
        'allowAdminChanges' => false,
        // Don’t allow updates on Production
        'allowUpdates' => false,
        'enableTemplateCaching' => false,
        'siteUrl' => getenv('SITE_URL'),
        'aliases' => [
            '@web' => getenv('SITE_URL'),
            '@assetsUrl' => '@web/assets',
        ],
    ],
];
