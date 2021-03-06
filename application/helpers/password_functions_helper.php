<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Check if the function doesn't already exist
if ( ! function_exists('get_password_hash') ) {
	// Declare the function and set the parameters
	function get_password_hash($password_entered_plain) {
		// Set the options and hash the plaintext password with the BCrypt hash function
		$hash = password_hash($password_entered_plain, PASSWORD_BCRYPT, ['cost' => 10]);
		// Return hashing results
		return ($hash !== FALSE) ? $hash : FALSE;
	}
}

// ------------------------------------------------------------------------

// Check if the function doesn't already exist
if ( ! function_exists('check_password_hash') ) {
	// Declare the function and set the parameters
	function check_password_hash($password_entered_plain, $password_hash_database) {
    	// Compare the plain password to the stored hash and return a boolean value
		return password_verify($password_entered_plain, $password_hash_database);
    }
}
