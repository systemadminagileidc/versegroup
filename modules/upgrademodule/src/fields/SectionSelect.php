<?php
/**
 * Custom Fields module for Craft CMS 3.x
 *
 * A custom module to allow the addition of custom fields
 *
 * @link      seguin.com
 * @copyright Copyright (c) 2021 George Hawthorne
 */

namespace modules\upgrademodule\fields;

use modules\upgrademodule\UpgradeModule;
use modules\upgrademodule\assetbundles\sectionselectfield\SectionSelectFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * SectionField Field
 *
 * Whenever someone creates a new field in Craft, they must specify what
 * type of field it is. The system comes with a handful of field types baked in,
 * and we’ve made it extremely easy for modules to add new ones.
 *
 * https://craftcms.com/docs/plugins/field-types
 *
 * @author    George Hawthorne
 * @package   CustomFieldsModule
 * @since     1.0.0
 */
class SectionSelect extends Field
{

    public $someAttribute = 'Some Default';

    public static function displayName(): string
    {
        return Craft::t('upgrade-module', 'Sections');
    }
    public $allowMultiple = false;
    public $whitelistedSections = [];
    public static function hasContentColumn(): bool
    {
        return true;
    }
    public function getContentColumnType(): string
    {
        return Schema::TYPE_STRING;
    }
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'upgrade-module/_components/fields/SectionSelect_settings',
            [
                'field' => $this,
                'sections' => $this->getSections()
            ]
        );
    }
    public function rules(): array
    {
        $rules = parent::rules();

        $rules[] = [['whitelistedSections'], 'validateSectionWhitelist'];

        return $rules;
    }
    public function validateSectionWhitelist(string $attribute) {

        $sections = $this->getSections();

        foreach ($this->whitelistedSections as $section) {
            if (!isset($sections[$section])) {
                $this->addError($attribute, Craft::t('section-field', 'Invalid section selected.'));
            }
        }
    }
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        $sections = $this->getSections(); // Get all sections available to the current user.
//        $whitelist = array_flip($this->whitelistedSections); // Get all whitelisted sections.
//        $whitelist[''] = true; // Add a blank entry in, in case the field's options allow a 'None' selection.
//        if (!$this->allowMultiple && !$this->required) { // Add a 'None' option specifically for optional, single value fields.
//            $sections = array('' => Craft::t('app', 'None')) + $sections;
//        }
//        $whitelist = array_intersect_key($sections, $whitelist); // Discard any sections not available within the whitelist.

        return Craft::$app->getView()->renderTemplate(
            'upgrade-module/_components/fields/SectionSelect_input',
            [
//                'field' => $this,
                'value' => $value,
//                'sections' => $whitelist,
                'field' => $this,
                'sections' => $this->getSections()
            ]
        );
    }
    public function getElementValidationRules(): array
    {
        return [
            ['validateSections'],
        ];
    }
    public function validateSections(ElementInterface $element)
    {
        $value = $element->getFieldValue($this->handle);

        if (!is_array($value)) {
            $value = [$value];
        }

        $sections = $this->getSections();

        foreach ($value as $section) {
            if (!isset($sections[$section])) {
                $element->addError($this->handle, Craft::t('section-field', 'Invalid section selected.'));
            }
        }
    }
    public function normalizeValue($value, ElementInterface $element = null)
    {
        // Convert string representation from db into plain array/int.
        if (is_string($value)) {
            $value = Json::decodeIfJson($value);
        }

        if (is_int($value)
            && $this->allowMultiple) {
            // Int, but field allows multiple, convert to array.
            $value = [$value];
        } else if (is_array($value)
            && !$this->allowMultiple
            && count($value) == 1) {
            // Array, but field allows only one, if single value, convert.
            $value = intval($value[0]);
        }

        // Convert string IDs to integers (for pre 1.1.0 data).
        if (is_array($value)) {
            foreach ($value as $key => $id) {
                $value[$key] = intval($id);
            }
        }

        return $value;
    }
    public function serializeValue($value, ElementInterface $element = null)
    {
        // Convert string IDs to integers for storage.
        if (is_array($value)) {
            foreach ($value as $key => $id) {
                $value[$key] = intval($id);
            }
        }

        return Json::encode($value);
    }


    // Private Methods
    // =========================================================================

    private function getSections() {
        $sections = array();
        foreach (Craft::$app->getSections()->getEditableSections() as $section) {
            $sections[$section->id] = Craft::t('site', $section->name);
        }
        return $sections;
    }
}
