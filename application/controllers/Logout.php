<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === TRUE) {
			// Destroy the user session data
			$this->session->sess_destroy();	
		}

		// Redirect user to the homepage
		redirect( base_url() );
	}
}
