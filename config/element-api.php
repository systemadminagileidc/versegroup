<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        'areas.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => [
                    'section' => 'areas',
                    'orderBy' => 'score',
                    'search' => (Craft::$app->request->getQueryParam('q'))
                ],
                'transformer' => function(Entry $entry) {
                    //Get top level [arent for flag in auto complete
                    $parent = $entry->getAncestors()->level(2)->one();

                    //If ireland of ireland is top level, get level below for republic/northern ireland flag
                    if($parent && $parent->title == 'Island of Ireland' && $entry->level > 3) {
                        $parent = $entry->getAncestors()->level(3)->one();
                    }

                    //Return title and country for the flag
                    return [
                        'title' => $entry->title,
                        'country' => $parent?$parent->title:$entry->title
                    ];
                },
            ];
        }
    ]
];
