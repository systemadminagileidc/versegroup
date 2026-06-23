<?php

return [
    'fields' => [
        'pageBuilder' => [
            'groups' => [
                [
//                    'label' => 'Text',
//                    'types' => ['text'],
                ],
            ],
            'types' => [
                'gridRow' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['blockRepeater'],
                        ],
                        [
                            'label' => 'Settings',
                            'fields' => ['rowWidth', 'rowLayout', 'gridGap', 'spaceTop', 'rowColour', 'paddingBottom', 'paddingTop', 'anchorLabel', 'backgroundImage', 'advancedSettings'],
                        ],
                        [
                            'label' => 'Media Queries',
                            'fields' => ['mediaQueries'],
                        ],
                    ],
                ],
                'channelRow' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['layouts', 'channelSelect', 'limit', 'options', 'popup', 'buttonStyle', 'imageCrop','hideButtons', 'showPostDate','useExcerptLimit'],
                        ],
                        [
                            'label' => 'Settings',
                            'fields' => ['rowWidth', 'rowLayout', 'gridGap', 'spaceTop', 'rowColour', 'paddingBottom', 'paddingTop', 'advancedSettings'],
                        ],
                    ],
                ],
                'social' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['rowContent'],
                        ],
                        [
                            'label' => 'Settings',
                            'fields' => ['rowWidth'],
                        ],
                    ],
                ],
            ],
        ],
        'heroBuilder' => [
            'groups' => [
                [
//                    'label' => 'Text',
//                    'types' => ['text'],
                ],
            ],
            'types' => [
                'static' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['media', 'heroContent'],
                        ],
                        [
                            'label' => 'Settings',
                            'fields' => ['heroWidth', 'contentWidth', 'gridGap', 'heroHeight', 'overlay', 'overlayType', 'opacity', 'blendMode', 'textColour', 'advancedOptions', 'paddingBottom', 'paddingTop', 'layout'],
                        ],
                    ],
                ],
                'heroSlides' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['slides', 'sliderSettings'],
                        ],
                        [
                            'label' => 'Settings',
                            'fields' => ['heroWidth', 'contentWidth', 'gridGap', 'heroHeight', 'overlay', 'overlayType', 'opacity', 'blendMode', 'textColour', 'arrows','navigation', 'autoplay', 'advancedOptions', 'paddingBottom', 'paddingTop'],
                        ],
                    ],
                ],
            ],
        ],
        'footerBuilder' => [
            'groups' => [
                [
//                    'label' => 'Text',
//                    'types' => ['text'],
                ],
            ],
            'types' => [
                'blocks' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['rowContent'],
                        ],
                        [
                            'label' => 'Settings',
                            'fields' => ['rowWidth', 'rowLayout', 'gridGap', 'spaceTop', 'rowColour', 'rowColour', 'paddingBottom', 'paddingTop', 'backgroundImage'],
                        ],
                        [
                            'label' => 'Media Queries',
                            'fields' => ['mediaQueries'],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
