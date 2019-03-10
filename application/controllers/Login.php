<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	protected $variables;

	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === TRUE) {
			// Redirect to nearby shops page
			redirect( base_url('nearby') );
		}

		// Insert page sub title into the variables array
		$this->variables['sub_title'] = 'Account login';

		// Load required libraries
		$this->load->library('form_validation');

		// Load required helper
		$this->load->helper('password_functions');

		// Set custom delimiters for displaying validation errors
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		// Check whether the user came from a successful registration
		$this->variables['new_user'] = ($this->session->referrer === 'register');

		// Run form validation
		if($this->form_validation->run('login') !== FALSE) {
			// Load our user account model and connect to the database
			$this->load->model('account_model', 'account', TRUE);

			// Use the login method to check the validity of user credentials
			if( ($this->id = $this->account->login($this->input->post('email'), $this->input->post('password'))) !== FALSE ) {
				// Successful user login save session
				$this->session->id = $this->id;
				// Redirect user to nearby shops
				redirect( base_url('nearby') );
			} else {
				// Set message for account not found
				$this->variables['custom_error'] = "Wrong login details";
			}
		}

		// Load header and navbar views
		$this->load->view('page_structure/header', $this->variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('login');

		// Load footer view
		$this->load->view('page_structure/footer');
	}
}
