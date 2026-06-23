<?php
/**
 * top100 plugin for Craft CMS 3.x
 *
 * top100 plugin
 *
 * @link      https://www.verse.co.uk/
 * @copyright Copyright (c) 2021 Verse
 * @copyright Copyright (c) 2021 Verse
 */

namespace verse\top100\controllers;

use Craft;
use craft\helpers\App;
use craft\web\Controller;

/**
 * Image Controller
 *  Redirecting images for App, flexible for future thumbnail generation as needed
 */
class ImageController extends Controller
{
    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index','large'];

    /**
     * actionIndex
     *  Redirect for App images
     *
     * @param string $img
     * @return \yii\web\Response
     */
    public function actionIndex($img = '') {
        $appImageRouteSmall = App::env('APP_IMAGE_SMALL_REDIRECT_PATH') ?: '/attractions/images/';

        $this->redirect($appImageRouteSmall.$img);
    }

    /**
     * largeIndex
     *  Redirect for App images
     *
     * @param string $img
     * @return \yii\web\Response
     */
    public function actionLarge($img = '') {
        $appImageRouteLarge = App::env('APP_IMAGE_LARGE_REDIRECT_PATH') ?: '/attractions/images/';

        $this->redirect($appImageRouteLarge.$img);
    }
}
