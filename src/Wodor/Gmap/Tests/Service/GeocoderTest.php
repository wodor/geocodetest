<?php
namespace Wodor\Tests\Gmap\Service;

use Geocoder\Result\Geocoded;
use Wodor\Gmap\Service\Geocoder;

class GeocoderTest  extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function shouldCatchNoResultExceptions()
    {
        $internalGeocoder = $this->getMock('Geocoder\GeocoderInterface');
        $internalGeocoder->expects($this->once())
            ->method('geocode')
            ->will($this->throwException(new \Geocoder\Exception\NoResultException()));

        $formatter = $this->getMockBuilder('\Wodor\Geocoder\Formatter')
            ->disableOriginalConstructor()
            ->getMock();

        $formatter->expects($this->never())
            ->method('format');

        $geocoder = new Geocoder($internalGeocoder, $formatter);

        $address = 'foobar';
        $this->assertEquals("Sorry, no results for you query: " . $address, $geocoder->geocodeToString($address));
    }

    /**
     * @test
     */
    public function shouldPutResultToFormatterAndReturnFormattedString()
    {
        $result = new Geocoded();
        $address = 'foobaZ';

        $internalGeocoder = $this->getMock('Geocoder\GeocoderInterface');
        $internalGeocoder->expects($this->once())
            ->method('geocode')
            ->with($address)
            ->will($this->returnValue($result));

        $formatter = $this->getMockBuilder('\Wodor\Geocoder\Formatter')
            ->disableOriginalConstructor()
            ->getMock();

        $stringResult = 'foobar';
        $formatter->expects($this->once())
            ->method('format')
        ->with($result)
        ->will($this->returnValue($stringResult));

        $geocoder = new Geocoder($internalGeocoder, $formatter);

        $this->assertEquals($stringResult, $geocoder->geocodeToString($address));
    }


}