#!/usr/bin/env php
<?php

// Require the Indego class
require_once('Indego.class.php');

// Instantiate the Indego class
$indego = new Indego;

// Get the stations that were requested if doing a search with a CLI argument
if ( (isset($argv[1])) && (!empty($argv[1])) ) {
	$search = trim($argv[1]);

// Otherwise, get all stations
} else {
	$search = '';
}

// Get stations
$stations = $indego->getStations($search);

// Return red error message to standard error (stderr) if no stations were found and exit with non-zero
if (empty($stations)) {
	$stderr = fopen('php://stderr', 'w+');
	fwrite($stderr, "\e[31mNo stations found!\033[0m\n");
	fclose($stderr);
	exit(1);
}

// Loop through each bike-share station
foreach ($stations as $station) {

	// Skip the station if its kiosk is not active?
	if ($station->kioskPublicStatus !== 'Active') {
		continue;
	}

	// Pad the current stations name with spaces so everything lines up
	$name = explode(',', $station->name);
	$name = explode('-', $name[0]);
	$name = str_pad($name[0], 48);

	// List the current stations information in a unique row
	echo $station->kioskId . "\t" . $name;

	// Build a pretty graph for bikes at the current station
	$graph = '';	// Graph starts empty
	for ($bike = 0; $bike < $station->bikesAvailable; $bike++) {
		$graph .= "#";
	}

	// And build another pretty graph of for empty docks at the current station
	for ($dock = 0; $dock < $station->docksAvailable; $dock++) {
		$graph .= "=";
	}

	// Pad the graph with spaces to line stuff up and color code the bikes (#) vs. docks (=) graphs that we just built
	$graph = str_pad($graph, 38);
	$graph = str_replace('#', "\e[32m#\033[0m", $graph);	// Bikes are green
	$graph = str_replace('=', "\e[31m=\033[0m", $graph);	// Docks are red
	echo $graph;

	// Pad the bikes and docks numbers with spaces to line stuff up
	echo str_pad($station->bikesAvailable . ' bikes', 12);
	echo str_pad($station->docksAvailable . ' docks', 12);
	echo "\n";
}
