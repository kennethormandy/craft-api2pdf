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
      $request = Craft::$app->getRequest();
      $htmlString = $request->getParam('html');
      $redirect = $request->getParam('redirect') ?? false;
      $options = $this->_getOptions($request);
      $result = CraftApi2Pdf::getInstance()->pdfService->generateFromHtml($htmlString, $redirect, $options);
      return $this->asJson($result);
    }
    
    public function actionGenerateFromUrl(string $url = '')
    {
      $request = Craft::$app->getRequest();
      $url = $request->getParam('url');
      $redirect = $request->getParam('redirect') ?? false;
      $options = $this->_getOptions($request);
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
      $redirect = $request->getParam('redirect') ?? false;
      $options = $this->_getOptions($request);
      $result = CraftApi2Pdf::getInstance()->pdfService->mergeFromUrls($urls, $redirect, $options);
      return $this->asJson($result);
    }
    
    private function _getOptions ($request)
    {
      $options = $request->getParam('options');
      if (!$options) {
        $options = [];
      }
      return $options;
    }
}
