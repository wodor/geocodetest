<?php
namespace Wodor\Gmap\Service;

use Geocoder\GeocoderInterface;

class Geocoder {

    protected $formatter;

    protected $geocoder;

    public function __construct(GeocoderInterface $geocoder, $formatter)
    {
        $this->geocoder = $geocoder;
        $this->formatter = $formatter;
    }

    /**
     * @param $address
     * @return string
     */
    public function geocodeToString($address)
    {
        try {
            /** @var \Geocoder\Result\ResultInterface $result */
            $result = $this->geocoder->geocode($address);
            return $this->formatter->format($result);
        } catch (\Geocoder\Exception\NoResultException $e) {
            return "Sorry, no results for you query: " . $address;
        }
    }
}