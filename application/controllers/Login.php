<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if( isLoggedIn() ) {
			// Redirect to nearby shops page
			redirect( base_url('nearby') );
		}

		// Insert page sub title into the variables array
		$variables['sub_title'] = 'Account login';

		// Set custom delimiters for displaying validation errors
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		// if the user came from a successful registration
		$variables['new_user'] = ($this->session->referrer === "register");

		// Run form validation
		if($this->form_validation->run('login') !== FALSE) {
			// Retrieve submitted account login credentials
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			// Load our user account model and connect to the database
			$this->load->model('account_model', 'account', TRUE);

			// Use the login method to check the validity of user credentials
			if( ($id = $this->account->login($email, $password)) !== FALSE ) {
				// Successful user login save session
				$this->session->id = $id;
				// Redirect user to nearby shops
				redirect( base_url('nearby') );
			} else {
				// Set message for account not found
				$variables['custom_error'] = "Wrong login details";
			}
		}

		// Load header and navbar views
		$this->load->view('page_structure/header', $variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('login');

		// Load footer view
		$this->load->view('page_structure/footer');
	}
}
