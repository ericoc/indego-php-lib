Indego Bike Share PHP Library
==============================

About
-----

This is still under construction, but I am trying to make a re-usable PHP library for the Philadelphia Indego Bike Share API!

Check out [the City of Philadelphia GitHub](https://github.com/CityOfPhiladelphia) while you are waiting for my library to be more usable!


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


Currently, the constructor of the `Indego` class executes a `findStations()` function which hits their API returning all of the (approximately 73) stations.

Providing a filter to `getStations()` to return a list of stations only limits the results within the `Indego` class. Unfortunately, there does not appear to be a signifcant amount of documentation for the API being used nor does their seem to be any parameters available to limit the stations being retrieved from the API. 

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


More Information
----------------
* [The actual API, a GeoJSON file](https://api.phila.gov/bike-share-stations/v1)
* [OpenDataPhilly description of the API](https://www.opendataphilly.org/dataset/bike-share-stations)
* [Interesting article visualizing Indego usage](http://www.randalolson.com/2015/09/05/visualizing-indego-bike-share-usage-patterns-in-philadelphia-part-2/)
