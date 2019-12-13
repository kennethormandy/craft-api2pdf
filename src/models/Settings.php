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
     * Returns the validation rules for attributes.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['apiKey', 'string'],
            ['apiKey', 'default', 'value' => ''],
        ];
    }
}
