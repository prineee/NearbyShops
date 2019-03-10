<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	protected $variables;

	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === TRUE) {
			// Redirect to nearby shops page
			redirect( base_url('nearby') );
		}

		// Insert page sub title into the variables array
		$this->variables['sub_title'] = 'Home';

		// Load header and navbar views
		$this->load->view('page_structure/header', $this->variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('home');

		// Load footer view
		$this->load->view('page_structure/footer');
	}
}
