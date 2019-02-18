<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if( isLoggedIn() ) {
			// Redirect to dashboard
			redirect( base_url('nearby') );
		}

		// Load the form vzlidation library
		$this->load->library('form_validation');

		// Insert page title into the variables array
		$variables['pageSubTitle'] = 'Account registration';

		// Set custom delimiters for displaying validation errors
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		// Run form validation
		if ($this->form_validation->run('register') !== FALSE) {
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Load our user account model and connect to database
			$this->load->model('account_model', 'model', TRUE);

			// Hash the password
			$pwdHash = pwdHash($password);

			// Use the regidster method to complete user registration
			if( $this->model->register($email, $username, $pwdHash) === TRUE) {
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
