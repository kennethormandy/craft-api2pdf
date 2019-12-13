<?php
/**
 * craft-api2pdf plugin for Craft CMS 3.x
 *
 * Generate PDFs using api2pdf.com
 *
 * @link      https://kennethormandy.com
 * @copyright Copyright (c) 2019 Kenneth Ormandy
 */

namespace kennethormandy\craftapi2pdf\variables;

use kennethormandy\craftapi2pdf\CraftApi2Pdf;

use Craft;

/**
 * craft-api2pdf Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.api2pdf }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Kenneth Ormandy
 * @package   Api2Pdf
 * @since     0.1.0
 */
class CraftApi2PdfVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.api2pdf.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.api2pdf.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function headlessChromeFromHtml(string $html = null, array $options = null)
    {
        $result = CraftApi2Pdf::getInstance()->pdfService->generatePdf('<h1>Hello from <code>action</code></h1>');

        return $result;
    }
}
