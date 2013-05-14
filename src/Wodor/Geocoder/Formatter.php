<?php

/**
 * Geocoder's formatter interface is does not fit my needs
 * (I rather have different result to format the same way than opposite)
 */

namespace Wodor\Geocoder;

use Geocoder\Formatter\FormatterInterface;
use Geocoder\Result\ResultInterface;

class Formatter /* does not implement FormatterInterface  */
{
    /**
     * @var string
     */
    private $format;

    /**
     * @param ResultInterface $result
     */
    public function __construct($format)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function format(ResultInterface $result)
    {
        return strtr($this->format, array(
            FormatterInterface::STREET_NUMBER   => $result->getStreetNumber(),
            FormatterInterface::STREET_NAME     => $result->getStreetName(),
            FormatterInterface::CITY            => $result->getCity(),
            FormatterInterface::ZIPCODE         => $result->getZipcode(),
            FormatterInterface::CITY_DISTRICT   => $result->getCityDistrict(),
            FormatterInterface::COUNTY          => $result->getCounty(),
            FormatterInterface::COUNTY_CODE     => $result->getCountyCode(),
            FormatterInterface::REGION          => $result->getRegion(),
            FormatterInterface::REGION_CODE     => $result->getRegionCode(),
            FormatterInterface::COUNTRY         => $result->getCountry(),
            FormatterInterface::COUNTRY_CODE    => $result->getCountryCode(),
            FormatterInterface::TIMEZONE        => $result->getTimezone(),
        ));
    }
}
