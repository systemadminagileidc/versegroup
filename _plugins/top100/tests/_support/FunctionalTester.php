<?php
/**
 * top100 plugin for Craft CMS 3.x
 *
 * top100 plugin
 *
 * @link      https://www.verse.co.uk/
 * @copyright Copyright (c) 2021 Andrew Page
 */

use Codeception\Actor;
use Codeception\Lib\Friend;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
 *
 */
class FunctionalTester extends Actor
{
    use _generated\FunctionalTesterActions;

}
