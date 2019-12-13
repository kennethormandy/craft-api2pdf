<?php
/**
 * API2PDF plugin for Craft CMS 3.x
 *
 * Generate PDFs using api2pdf.com
 *
 * @link      https://kennethormandy.com
 * @copyright Copyright © 2019 Kenneth Ormandy
 */

namespace kennethormandy\craftapi2pdf;

use kennethormandy\craftapi2pdf\variables\CraftApi2PdfVariable;
use kennethormandy\craftapi2pdf\models\Settings;
use kennethormandy\craftapi2pdf\services\PdfService;
use kennethormandy\craftapi2pdf\controllers\PdfController;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;

use yii\base\Event;

/**
 * @since     0.1.0
 *
 * @property  PdfService $pdfService
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class CraftApi2Pdf extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * CraftApi2Pdf::$plugin
     *
     * @var CraftApi2Pdf
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '0.1.0';

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * CraftApi2Pdf::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
      
        parent::init();
        self::$plugin = $this;

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('api2pdf', CraftApi2PdfVariable::class);
            }
        );

        // Register service
        $this->setComponents([
            'pdfService' => \kennethormandy\craftapi2pdf\services\PdfService::class,
        ]);
        
        // Do something after we're installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                }
            }
        );

/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 *
 * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
 *
 * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
 * the category to the method (prefixed with the fully qualified class name) where the constant appears.
 *
 * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
 * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
 *
 * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
 */
        Craft::info(
          $this->name . ' plugin loaded',
          __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'craft-api2pdf/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
