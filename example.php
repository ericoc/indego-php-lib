<?php

// Require the Indego class
require_once('indego.class.php');

// Instantiate the Indego class which will immediately discover all of the stations
$indego = new Indego;

// Just get "university" stations
$uni_stations = $indego->getStations('university');

print_r($uni_stations);
