<?php

// Create a class to work with the Philadelphia Indego Bike Share API
class Indego {

	private $stations = [];		// Create empty private array to fill in with station data
	private $initialized = false;	// Initialization (retrieval) of station data hasn't happened yet

	// Create a function to hit the API and find all of the stations
	private function findStations() {

		// Specify the Indego bikes API URL
		$url = 'https://api.phila.gov/bike-share-stations/v1';

		// Specify a friendly user-agent to hit the API with
		$user_agent = 'Indego PHP API Library - https://github.com/ericoc/indego-php-lib';

		// Hit the API to get the JSON response
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($c, CURLOPT_TIMEOUT, 2);
		$r = curl_exec($c);
		curl_close($c);

		// Decode the JSON response from the API
		$raw = json_decode($r);

		// Add each station to our own array that's easier to work with
		foreach ($raw->features as $station) {
			$this->addStation($station->properties, $station->geometry->coordinates);
		}

		// Initialization complete since stations have been found at this point
		$this->initialized = true;
	}

	// Create a function to add stations to our own array (from large passed in array)
	private function addStation($properties, $coordinates) {
		$id = $properties->kioskId;		//	Get the station kiosk ID
		$this->stations[$id] = new stdClass();	//	Make a new object in our own array for the station

		// Fill in the properties of the station in to our own array
		foreach ($properties as $name => $value) {
			$this->stations[$id]->$name = $value;
		}

		// Fill in the coordinates for the station
		$this->stations[$id]->coordinates = $coordinates;
	}

	// Create a function to search for and return stations
	public function getStations($where = '') {

		// Find all of the stations first, if that hasn't already been done
		if (!$this->initialized) {
			$this->findStations();
		}

		// Create empty array to fill in with station data that will be returned by this function
		$return = [];

		// Just provide all of the stations if no search query was given
		if (empty($where)) {
			$return = $this->stations;

		// If a search query was passed, process it...
		} else {

			// Create a case-insensitive pattern to match station names and addresses with
			$pattern = '/' . trim($where) . '/i';

			// Loop through each station in the primary array
			foreach($this->stations as $station) {

				// If the search query is five digits, only match the stations with that zip code
				if ( (is_numeric($where)) && (strlen($where) == 5) ) {
					if ($station->addressZipCode == $where) {
						$return[$station->kioskId] = $station;
					}

				// Do a regular expression match using the search query on the name and address of each station
				} elseif ( (preg_match($pattern, $station->addressStreet)) || (preg_match($pattern, $station->name)) ) {
					$return[$station->kioskId] = $station;
				}
			}
		}

		// Return the stations!
		return $return;
	}
}
