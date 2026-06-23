<?php
/**
 * AutoSockDirect plugin for Craft CMS 3.x
 *
 * ASD Plugin
 *
 * @link      Verse.co.uk
 * @copyright Copyright (c) 2019 Verse
 */

namespace verse\top100\etc;

use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use craft\helpers\App;
use yii\base\Event;

/**
 * Trait Routes
 *  Register attractions/area search route
 * @author    Verse
 * @since     1.0.0
 *
 */
trait Routes
{
    private function _registerSiteRoutes()
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['attractions/area'] = 'top100/area/index';
                $event->rules[(App::env('APP_IMAGE_SMALL_PATH')?:'/attractions/images/135x135/').'<img:{slug}>'] = 'top100/image/index';
                $event->rules[(App::env('APP_IMAGE_LARGE_PATH')?:'/attractions/images/600x600/').'<img:{slug}>'] = 'top100/image/large';
            }
        );
    }
}
