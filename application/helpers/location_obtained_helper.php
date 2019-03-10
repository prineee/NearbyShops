<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Check if the function doesn't already exist
if ( ! function_exists('location_obtained') ) {
	// Declare the function and set the parameters
	function location_obtained($latitude, $longitude) {
		// If user location is provided and is not null
		if( ! is_null($latitude) && ! is_null($longitude) ) {
			// Set location as already obtained
			return true;
		} else {
			// Set location as not obtained
			return false;
		}
	}
}
