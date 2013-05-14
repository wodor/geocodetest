Simple test of availble geocoding libraries

to run

    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

than you can do a query

     ./console gmap:query "Blackburn"

or run tests

    phpunit --bootstrap vendor/autoload.php src

