<?php
return [
    'defaultProfile' => 'standard',
    'cacheEnabled' => false,

    // Global
    'defaultMeta' => [
        'description' => ['siteSeo.globalSeoFields:settings.description'],
        'image' => ['siteSeo.globalSeoFields:settings.image'],
    ],

    // Page
    'fieldProfiles' => [
        'standard' => [
            'title' => ['seoFields:settings.alternativeTitle', 'title'],
            'description' => ['seoFields:settings.description'],
            'image' => ['seoFields:settings.image'],
            'robots' => ['seoFields:settings.robots'],
        ],
    ],
];