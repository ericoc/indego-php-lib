<?php

// Require the Indego class
require_once('Indego.class.php');

// Instantiate the Indego class
$indego = new Indego;

// Get the stations that were requests if doing a search with a CLI argumen
if ( (isset($argv[1])) && (!empty($argv[1])) ) {
	$search = trim($argv[1]);

// Otherwise, get all stations
} else {
	$search = '';
}

// Get stations
$stations = $indego->getStations($search);

// Loop through each bike-share station
foreach ($stations as $station) {

	// Skip the station if its kiosk is not active?
	if ($station->kioskPublicStatus !== 'Active') {
		continue;
	}

	// Create an array of the current stations dock counts
	$graph = '';

	// Pad the current stations name with tabs so everything lines up
	$name		=	explode(',', $station->name);
	$name		=	explode('-', $name[0]);
	$name		=	str_pad($name[0], 48);

	// List the current stations information in a unique row
	echo $station->kioskId . "\t" . $name;

	// Print a pretty graph of stylized blocks for bikes at the current station
	for ($bike = 0; $bike < $station->bikesAvailable; $bike++) {
		$graph .= "#";
	}

	// And print another pretty graph of stylized blocks for empty docks at the current station
	for ($dock = 0; $dock < $station->docksAvailable; $dock++) {
		$graph .= "=";
	}

	$graph = str_pad($graph, 38);
	$graph = str_replace('#', "\e[32m#\033[0m", $graph);
	$graph = str_replace('=', "\e[31m=\033[0m", $graph);
	echo $graph;
	echo str_pad($station->bikesAvailable . ' bikes', 12);
	echo str_pad($station->docksAvailable . ' docks', 12);
	echo "\n";

	// Forget the current stations name and graph
	unset($name, $graph);
}
