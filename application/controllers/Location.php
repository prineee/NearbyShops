<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
	protected $latitude, $longitude;

	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === FALSE) {
			// Redirect to the home page
			redirect( base_url() );
		}

		// Load required libraries
		$this->load->library('form_validation');

		// Run form validation
		if($this->form_validation->run('locator') !== FALSE) {
			// Get submitted coordinates and round them to proper length
			$this->latitude = round($this->input->post('latitude'), 8);
			$this->longitude = round($this->input->post('longitude'), 8);

			// Store latituse and longitude in the session data
			if( ($this->session->latitude = $this->latitude) && ($this->session->longitude = $this->longitude) ) {
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
