<?php

namespace kennethormandy\craftapi2pdf\services;
use kennethormandy\craftapi2pdf\CraftApi2Pdf;

use Craft;
use craft\web\View;
use craft\web\Response;
use craft\base\Component;
use Api2Pdf\Api2Pdf;

class PdfService extends Component
{
    public function init()
    {
        parent::init();
    }
    
    public function getClient($apiKey = null) {
      if ($apiKey == null) {
        $apiKey = CraftApi2Pdf::$plugin->getSettings()->getApiKey();        
      }

      return new Api2Pdf($apiKey);
    }
    
    public function configureClient ($options = []) {
      $apiClient = $this->getClient();
      
      if ($options) {
        if (isset($options["inline"])) {
          $apiClient->setInline($options["inline"]);
        }
        if (isset($options["filename"]) && $options["filename"]) {
          $apiClient->setFilename($options["filename"]);
        }
        if (isset($options) && $options) {
          $apiClient->setOptions($options);
        }
      }

      return $apiClient;
    }
    
    public function formatResponse ($resp, $redirect) {
      if ($resp) {
        $pdfUrl = $resp->getPdf();

        if ($redirect && $pdfUrl) {
          Craft::$app->getResponse()->redirect($pdfUrl);
        } else {
          return [
            "success" => true,
            "pdf" => $pdfUrl,
            "mbIn" => $resp->getMbIn(),
            "mbOut" => $resp->getMbOut(),
            "cost" => $resp->getCost(),
            "responseId" => $resp->getResponseId()
          ];
        }
      } else {
        return [
          "success" => false,
          "error" => "No response."
        ];
      }
    }
    
    public function renderPdfTemplateHtml() {
      // https://docs.craftcms.com/v3/extend/updating-plugins.html#rendering-templates

      /*
      // For using templates within the plugin

      $oldMode = \Craft::$app->view->getTemplateMode();
      \Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);

      // Strangely, it seems necessary to leave out `templates/`
      $templatePath = 'api2pdf/pdf.twig';

      $pdfHtml = \Craft::$app->view->renderTemplate($templatePath, [
        'body' => 'Example body from plugin'
      ]);
      \Craft::$app->view->setTemplateMode($oldMode);
      */
      
      // Using templates from the site
      Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_SITE);

      // TODO The specific template and the variables need
      // to be passed along as arguments
      $pdfHtml = Craft::$app->getView()->renderTemplate(
        "/pdf/proof-letter.twig",
        [
          'body' => 'Testing'
        ]
      );
      
      return $pdfHtml;
    }
    
    public function generateFromUrl(string $url = 'https://example.com', $options = []) {    
      $apiClient = $this->configureClient($options);
      $redirect = false;

      if (!$url) {
        return [ "success" => false, "error" => "No URL provided." ];        
      }
      
      if (strpos($url, 'localhost:') !== false || strpos($url, 'ddev') !== false) {
        return [ "success" => false, "error" => "Invalid URL: local URL provided, which Api2Pdf won’t be able to access: " . $url ];        
      }

      if (isset($options['redirect'])) {
        $redirect = $options['redirect'];
      }
      
      $resp = $apiClient->headlessChromeFromUrl($url, $options);
      return $this->formatResponse($resp, $redirect);
    }
    
    public function generateFromHtml(string $html = '', array $options = []) {
      // if ($html !== '') {
      //   $pdfHtml = $this->renderPdfTemplateHtml();        
      // } else {
        // TODO Remove support for the $html argument from Twig, once it’s
        // possible to supply your own templates, ex. we get them from your
        // templates/api2pdf directory or whatever
        $pdfHtml = $html;
      // }
      $redirect = false;

      $apiClient = $this->configureClient($options);

      if (!$pdfHtml) {
        return [ "success" => false, "error" => "No HTML provided." ];        
      }
      
      if (isset($options['redirect'])) {
        $redirect = $options['redirect'];
      }
      
      $resp = $apiClient->headlessChromeFromHtml($pdfHtml, $options);
      return $this->formatResponse($resp, $redirect);
    }

    public function mergeFromUrls(array $urls = [], array $options = []) {
      $apiClient = $this->configureClient($options);

      if (!$urls || 0 >= sizeof($urls)) {
        return [ "success" => false, "error" => "No URLs provided." ];        
      }
      
      // TODO Check each URL to make sure it isn’t local
      // if (strpos($url, 'localhost:') !== false || strpos($url, 'ddev') !== false) {
      //   return [ "success" => false, "error" => "Invalid URL: local URL provided, which Api2Pdf won’t be able to access: " . $url ];        
      // }

      $resp = $apiClient->merge($urls);
      return $this->formatResponse($resp, $redirect);
    }
    
}
