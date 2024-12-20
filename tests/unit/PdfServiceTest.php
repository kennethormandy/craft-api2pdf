<?php
use \Codeception\Test\Unit;
use kennethormandy\craftapi2pdf\services\PdfService;

class PdfServiceTest extends Unit
{
    public $service;
    public $apiKey = '';
    
    protected function _before()
    {
        parent::_before();

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
        $this->assertArrayHasKey('pdf', $res);
        $this->assertArrayHasKey('mbIn', $res);
        $this->assertTrue($res['mbOut'] > 0);
    }
    
    public function testGenerateFromUrl()
    {
        $res = $this->service->generateFromUrl('https://example.com', [
          "apiKey" => $this->apiKey
        ]);
    
        codecept_debug($res);
    
        $this->assertTrue($res['success']);
        $this->assertArrayHasKey('pdf', $res);
        $this->assertArrayHasKey('mbIn', $res);
        $this->assertTrue($res['mbOut'] > 0);
    }
    
    public function testMergeFromUrl()
    {
        $opts = [ "apiKey" => $this->apiKey ];
        $pdf1 = $this->service->generateFromUrl('https://example.com', $opts);
        $pdf2 = $this->service->generateFromUrl('https://example.com', $opts);
    
        $pdfs = [
          $pdf1['pdf'],
          $pdf2['pdf']
        ];
    
        $res = $this->service->merge($pdfs, $opts);
    
        codecept_debug($res);
    
        $this->assertTrue($res['success']);
        $this->assertArrayHasKey('pdf', $res);
        $this->assertArrayHasKey('mbIn', $res);
        $this->assertTrue($res['mbOut'] > 0);
    }
    
    public function testMergeLocalUrls()
    {
        $opts = [ "apiKey" => $this->apiKey ];
        $pdfs = [
        'http://localhost:8000/2.pdf',
        'http://localhost:9000/1.pdf'
      ];

        $res = $this->service->merge($pdfs, $opts);

        codecept_debug($res);

        $this->assertArrayHasKey('success', $res);
        $this->assertArrayHasKey('error', $res);
        $this->assertFalse($res['success']);
    }
}
