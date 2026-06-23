<?php
/**
 * Site module for Craft CMS 3.x
 *
 * An example module for Craft CMS 3 that lets you enhance your websites with a
 * custom site module
 *
 * @link      https://nystudio107.com/
 * @copyright Copyright (c) 2019 nystudio107
 */

namespace modules\sitemodule\controllers;

use Craft;
use craft\web\Controller;

use yii\web\Response;

/**
 * @author    nystudio107
 * @package   SiteModule
 * @since     1.0.0
 */
class SiteController extends Controller
{
    // Constants
    // =========================================================================

    const GQL_TOKEN_NAME = 'Site GQL Token';

    // Protected Properties
    // =========================================================================

    protected $allowAnonymous = [
        'get-csrf',
        'get-gql-token',
        'get-field-options',
    ];

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function beforeAction($action): bool
    {
        // Disable CSRF validation for get-csrf POST requests
        if ($action->id === 'get-csrf') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * @return Response
     */
    public function actionGetCsrf(): Response
    {
        return $this->asJson([
            'name' => Craft::$app->getConfig()->getGeneral()->csrfTokenName,
            'value' => Craft::$app->getRequest()->getCsrfToken(),
        ]);
    }

    /**
     * @return Response
     */
    public function actionGetGqlToken(): Response
    {
        $result = null;
        $tokens = Craft::$app->getGql()->getTokens();
        foreach ($tokens as $token) {
            if ($token->name === self::GQL_TOKEN_NAME) {
                $result = $token->accessToken;
            }
        }

        return $this->asJson([
            'token' => $result,
        ]);
    }

    /**
     * Return all of the field options from the passed in array of $fieldHandles
     *
     * @return Response
     */
    public function actionGetFieldOptions(): Response
    {
        $result = [];
        $request = Craft::$app->getRequest();
        $fieldHandles = $request->getBodyParam('fieldHandles');
        foreach ($fieldHandles as $fieldHandle) {
            $field = Craft::$app->getFields()->getFieldByHandle($fieldHandle);
            if ($field) {
                $result[$fieldHandle] = $field->options;
            }
        }

        return $this->asJson($result);
    }
}