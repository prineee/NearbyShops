<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Check if the function doesn't already exist
if ( ! function_exists('isValidEmail') ) {
	// Declare the function and set the parameters
	function isValidEmail($email) {
		// Validate email against the filter
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}
