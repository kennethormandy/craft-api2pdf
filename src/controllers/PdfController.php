<?php
namespace kennethormandy\craftapi2pdf\controllers;
use kennethormandy\craftapi2pdf\CraftApi2Pdf;

use Craft;
use craft\web\Controller;

class PdfController extends Controller
{
    // TODO This might change based on whether we want everyone
    // logged into the site to make these. Possibly would
    // be configurable.
    protected $allowAnonymous = true;

    public function actionGenerateFromHtml()
    {
      // This works
      // return $this->asJson([ 'hello' => true ]);
      
      $request = Craft::$app->getRequest();
      $html = $request->getParam('url') || '<h1>Hello from <code>action</code></h1>';
      $redirect = $request->getParam('redirect') || false;
      $options = $request->getParam('options');
      if (!$options) {
        $options = [];
      }
      $result = CraftApi2Pdf::getInstance()->pdfService->generateFromHtml($html, $redirect, $options);

      return $this->asJson($result);
    }
    
    public function actionGenerateFromUrl($url = '')
    {
      $request = Craft::$app->getRequest();
      $url = $request->getParam('url');
      $redirect = $request->getParam('redirect') || false;
      $options = $request->getParam('options');
      if (!$options) {
        $options = [];
      }
      $result = CraftApi2Pdf::getInstance()->pdfService->generateFromUrl($url, $redirect, $options);
      return $this->asJson($result);
    }
    
    public function actionMergeFromUrls()
    {
      $request = Craft::$app->getRequest();
      $urls = $request->getParam('urls');
      if (!$urls) {
        $urls = [];
      }
      $redirect = $request->getParam('redirect') || false;
      $options = $request->getParam('options');
      if (!$options) {
        $options = [];
      }
      $result = CraftApi2Pdf::getInstance()->pdfService->mergeFromUrls($urls, $redirect, $options);
      return $this->asJson($result);
    }
}
