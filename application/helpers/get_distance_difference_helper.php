<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Check if the function doesn't already exist
if ( ! function_exists('getDistanceDifference') ) {
	// Declare the function and set the parameters talculate the great-circle distance between two points using the Vincenty formula
	function getDistanceDifference($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $planetRadius = 6371000, $unit = 'm') {
		// Make sure unit is lowercase
		$unit = strtolower($unit);

		// If the two points are equal there's no distance to calculate
		if( ($latitudeFrom === $latitudeTo) && ($longitudeFrom === $longitudeTo) ) {
			$distance = 0;
		} else {
			// Convert from degrees to radians
			$latFrom = deg2rad($latitudeFrom);
			$lonFrom = deg2rad($longitudeFrom);
			$latTo = deg2rad($latitudeTo);
			$lonTo = deg2rad($longitudeTo);

			// Calculate longitudinal Delta
			$lonDelta = $lonTo - $lonFrom;

			// Lots of trigonometric maths here
			$a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
			// More maths here
			$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
			// Maths marathon
			$angle = atan2(sqrt($a), $b);

			// Multiply the resulting angle by the planet's radius to get the distance
			$distance = $angle * $planetRadius;
		}


		// Convert distance to specified unit otherwise return meters
		if($unit === 'km') {
			// Convert from meters to kilometers
			$distance = $distance*0.001;
		} elseif ($unit === 'mi') {
			// Convert from meters to statute miles
			$distance = $distance*0.000621371;
		} elseif ($unit === 'nm') {
			// Convert from meters to nautical miles
			$distance = $distance*0.000539957;
		}

		// Return final distance
		return $distance;
	}
}
