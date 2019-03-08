<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === FALSE) {
			// Redirect to the home page
			redirect( base_url() );
		}

		// Run form validation
		if($this->form_validation->run('locator') !== FALSE) {
			// Get submitted latitude and longitude
			$latitude = $this->input->post('latitude');
			$longitude = $this->input->post('longitude');

			// Round again server-side just in case
			$latitude = round($latitude, 8);
			$longitude = round($longitude, 8);

			// Store latituse and longitude in the session data
			if( ($this->session->latitude = $latitude) && ($this->session->longitude = $longitude) ) {
				// If the operation completed successfully
				echo 'success';
			} else {
				// If the operation has failed
				echo 'error';
			}
		} else {
			// Show validation errors
			echo validation_errors();
		}
	}
}
