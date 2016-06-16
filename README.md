Indego Bike Share PHP Library
==============================

About
-----

I am mostly fooling around with PHP to get more used to object-orientation as opposed to doing just procedural PHP all of the time. In my journey, I've made a re-usable PHP library for the Philadelphia Indego Bike Share API!

Check out [the City of Philadelphia GitHub](https://github.com/CityOfPhiladelphia) if you think this library is interesting!


Example
-------

### Code

When combined with the provided `Indego` class, the following code will generate the example output in the next section:

	// Require the Indego class
	require_once('Indego.class.php');

	// Instantiate the Indego class which will immediately discover all of the stations
	$indego = new Indego;

	// Just get "university" stations
	$uni_stations = $indego->getStations('university');

	print_r($uni_stations);


Providing a argument/filter to `getStations()` to return a list of stations only limits the results within the `Indego` class.

Unfortunately, there does not appear to be a signifcant amount of documentation for the API being used nor does there seem to be any parameters available to limit the stations being retrieved from the API.

Calling `getStations()` without any arguments will return a list of all (*currently*, 103) stations!

### Output

    $ php example.php
    Array
    (
        [3008] => stdClass Object
            (
                [addressStreet] => 1076 Berks Street
                [addressCity] => Philadelphia
                [addressState] => PA
                [addressZipCode] => 19122
                [bikesAvailable] => 9
                [closeTime] => 23:58:00
                [docksAvailable] => 8
                [eventEnd] =>
                [eventStart] =>
                [isEventBased] =>
                [isVirtual] =>
                [kioskId] => 3008
                [kioskPublicStatus] => Active
                [name] => Temple University Station
                [openTime] => 00:02:00
                [publicText] =>
                [timeZone] => Eastern Standard Time
                [totalDocks] => 19
                [trikesAvailable] => 0
                [coordinates] => Array
                    (
                        [0] => -75.14973
                        [1] => 39.98082
                    )

            )

        [3020] => stdClass Object
            (
                [addressStreet] => 3051 South St.
                [addressCity] => Philadelphia
                [addressState] => PA
                [addressZipCode] => 19147
                [bikesAvailable] => 18
                [closeTime] => 23:58:00
                [docksAvailable] => 17
                [eventEnd] =>
                [eventStart] =>
                [isEventBased] =>
                [isVirtual] =>
                [kioskId] => 3020
                [kioskPublicStatus] => Active
                [name] => University City Station
                [openTime] => 00:02:00
                [publicText] =>
                [timeZone] => Eastern Standard Time
                [totalDocks] => 35
                [trikesAvailable] => 0
                [coordinates] => Array
                    (
                        [0] => -75.18986
                        [1] => 39.94887
                    )

            )

    )


Command-line script
--------------------

The included [`indego-cli.php` script](https://github.com/ericoc/indego-php-lib/blob/master/indego-cli.php) is a fun command-line PHP script that I wrote which uses the `Indego` class/library to get the bike share data from the citys API!

![Indego PHP Library CLI screenshot](https://raw.githubusercontent.com/ericoc/indego-php-lib/master/cli.png "Indego PHP Library CLI screenshot")


More Information
----------------
* [The actual API, a GeoJSON file](https://www.rideindego.com/stations/json/)
* [OpenDataPhilly description of the API](https://www.opendataphilly.org/dataset/bike-share-stations)
* [Interesting article visualizing Indego usage](http://www.randalolson.com/2015/09/05/visualizing-indego-bike-share-usage-patterns-in-philadelphia-part-2/)
