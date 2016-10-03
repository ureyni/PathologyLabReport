<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-10-03 at 18:37:57.
 */
define("APPPATH", "../application/");
require_once '../application/libraries/PdfConverter.php';

class PdfConverterTest extends PHPUnit_Framework_TestCase {

    /**
     * @var PdfConverter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new PdfConverter(array('pdfhome'=>__DIR__));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers PdfConverter::dopdf
     * @todo   Implement testDopdf().
     */
    public function testDopdf() {
        $this->assertNotEquals(false, $this->object->dopdf());
    }

}
