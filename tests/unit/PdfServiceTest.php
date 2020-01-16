<?php 
use \Codeception\Test\Unit;
use \Dotenv\Dotenv;
use kennethormandy\craftapi2pdf\services\PdfService;

class PdfServiceTest extends Unit
{
    public $service;
    public $apiKey = '';
    
    protected function _before()
    {
      parent::_before(); 

      $dotenv = Dotenv::createImmutable(__DIR__ . './../../'); 
      $dotenv->load();

      $this->service = new PdfService();
      $this->apiKey = getenv('API2PDF_KEY');
    }

    protected function _after()
    {
    }

    public function testGenerateFromHtml()
    {
      $res = $this->service->generateFromHtml('<p>Hello, world</p>', [
        "apiKey" => $this->apiKey
      ]);

      codecept_debug($res);

      $this->assertTrue($res['success']);
      $this->assertContains('url', $res);
      $this->assertContains('mbIn', $res);
      $this->assertTrue($res['mbIn'] > 0);
    }
    
    public function testGenerateFromUrl()
    {
      $res = $this->service->generateFromUrl('https://example.com', [
        "apiKey" => $this->apiKey
      ]);

      codecept_debug($res);

      $this->assertTrue($res['success']);
      $this->assertContains('url', $res);
      $this->assertContains('mbIn', $res);
      $this->assertTrue($res['mbIn'] > 0);
    }
}
