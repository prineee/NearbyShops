<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === TRUE) {
			// Redirect to nearby shops page
			redirect( base_url('nearby') );
		}

		// Insert page sub title into the variables array
		$variables['sub_title'] = 'Account registration';

		// Set custom delimiters for displaying validation errors
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		// Run form validation
		if( $this->form_validation->run('register') !== FALSE ) {
			// Retrieve submitted email and password form inputs
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			// Load our user account model and connect to the database
			$this->load->model('account_model', 'account', TRUE);

			// Use the regidster method to complete user registration
			if( $this->account->register($email, $password) === TRUE ) {
				// Set referrer in flashdata storage
				$this->session->set_flashdata('referrer', 'register');
				// Redirect user to login page
				redirect( base_url('login') );
			} else {
				// Set message for database error
				$variables['custom_error'] = "Database error occured";
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
