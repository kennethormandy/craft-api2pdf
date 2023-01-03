<?php
/**
 * Api2Pdf plugin for Craft CMS 3.x
 *
 * Generate PDFs using api2pdf.com
 */

namespace kennethormandy\craftapi2pdf\models;

use kennethormandy\craftapi2pdf\CraftApi2Pdf;

use Craft;
use craft\base\Model;
use craft\behaviors\EnvAttributeParserBehavior;

/**
 * Api2Pdf Settings Model
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Kenneth Ormandy
 * @package   Api2Pdf
 * @since     0.1.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Api2Pdf API key
     */
    public $apiKey = '';

    // Public Methods
    // =========================================================================

    /**
     * @return string the parsed API key
     */
    public function getApiKey(): string
    {
        return Craft::parseEnv($this->apiKey);
    }
    
    /*
     * https://docs.craftcms.com/v3/extend/environmental-settings.html#validation
     */
    public function behaviors(): array
    {
        return [
            'parser' => [
                'class' => EnvAttributeParserBehavior::class,
                'attributes' => ['apiKey'],
            ],
        ];
    }

    /**
     * Returns the validation rules for attributes.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            ['apiKey', 'required'],
            ['apiKey', 'string'],
            ['apiKey', 'default', 'value' => ''],
        ];
    }
}
