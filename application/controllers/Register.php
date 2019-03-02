<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
		// Check if the user is logged in
		if( isLoggedIn() ) {
			// Redirect to dashboard
			redirect( base_url('nearby') );
		}

		// Insert page title into the variables array
		$variables['pageSubTitle'] = 'Account registration';

		// Set custom delimiters for displaying validation errors
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		// Run form validation
		if($this->form_validation->run('register') !== FALSE) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Load our user account model and connect to the database
			$this->load->model('account_model', 'account', TRUE);

			// Use the regidster method to complete user registration
			if( $this->account->register($username, $password) === TRUE) {
				// Set referrer in flashdata storage
				$this->session->set_flashdata('referrer', 'register');
				// Redirect user to login page
				redirect( base_url('login') );
			} else {
				// Database error occured
				redirect( base_url('error') );
			}
		}

		// Load header and navbar views
		$this->load->view('page_structure/header', $variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('register');

		// Load footer view
		$this->load->view('page_structure/footer');
	}
}
