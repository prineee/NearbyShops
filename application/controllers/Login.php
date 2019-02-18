<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if( isLoggedIn() ) {
			// Redirect to dashboard
			redirect( base_url('nearby') );
		}

		// Load the form vzlidation library
		$this->load->library('form_validation');

		// Insert page title into the variables array
		$variables['pageSubTitle'] = 'Account login';

		// Set custom delimiters for displaying validation errors
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		// if the user came from a successful registration
		if($this->session->referrer == "register") {
			$variables['new_user'] = true;
		} else {
			$variables['new_user'] = false;
		}

		// Run form validation
		if ($this->form_validation->run('login') !== FALSE) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Load our user account model and connect to database
			$this->load->model('account_model', 'model', TRUE);

			// Use the login method to check the validity of user credentials
			$login_model = $this->model->login($username, $password);

			if($login_model == FALSE) {
				// Set error for account not found
				$variables['custom_error'] = "Wrong login details";
			} else {
				// Successful user login save session
				$this->session->id = $login_model;
				// Redirect user to nearby shops
				redirect( base_url('nearby') );
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
