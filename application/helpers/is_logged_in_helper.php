<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Check if the function doesn't already exist
if ( ! function_exists('is_logged_in') ) {
	function is_logged_in() {
		// Get CodeIgniter instance by reference
		$CI =& get_instance();

		// Get id of the logged in user
		$id = (int) $CI->session->id;

		if ( isset($id) && is_int($id) && ($id > 0) ) {
			// User signed in
			return true;
		} else {
			// Not signed in
			return false;
		}
	}
}
