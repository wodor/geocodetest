<?php
$container = new Pimple();

$container['adapter'] = function() {
    return new \Geocoder\HttpAdapter\CurlHttpAdapter();
};

$container['provider.googleMaps'] = $container->share(function($container) {
    return new \Geocoder\Provider\GoogleMapsProvider($container['adapter']);
});

$container['geocoder'] = function($container) {
    $geocoder = new \Geocoder\Geocoder();
    $geocoder->registerProvider($container['provider.googleMaps']);
    return $geocoder;
};

$container['formatter'] = $container->share(function($container) {
    return new  \Wodor\Geocoder\Formatter($container['formatter.format']);
});

$container['geocoder.formatted'] = $container->share(function($container) {
    return new  \Wodor\Gmap\Service\Geocoder($container['geocoder'], $container['formatter']);
});

return $container;