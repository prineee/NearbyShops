<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preferred extends CI_Controller {
	protected $variables;

	public function index() {
		// Check whether the user is logged in
		if(is_logged_in() === FALSE) {
			// Redirect to the login page
			redirect( base_url('login') );
		}

		// Insert page sub title into the variables array
		$this->variables['sub_title'] = 'My Preferred Shops';

		// Load required libraries
		$this->load->library('form_validation');
		$this->load->library('shops');

		// Load required models
		$this->load->model('shops_model');
		$this->load->model('likes_model');
		$this->load->model('dislikes_model');

		// Load required helpers
		$this->load->helper('location_obtained');
		$this->load->helper('get_distance_difference');
 
		// Run form validation
		if($this->form_validation->run('liker') !== FALSE) {
			// Unlike a shop
			if($this->input->post('action') === 'unlike') {
				$remove_like = $this->likes_model->remove_like(
					$this->session->id,
					$this->input->post('id')
				);
			}

			// Refresh the page to prevent a page refresh from repeating the query
			redirect( base_url('preferred') );
		}

		// Check whether user location is provided and is not null
		$this->variables['location'] = location_obtained(
			$this->session->latitude,
			$this->session->longitude
		);

		// Get all shops except those liked or disliked by the logged in user
		$this->variables['preferred'] = $this->shops->get_preferred_shops($this->session->id);

		// Sort the shops by user location if provided
		if($this->variables['location'] === TRUE) {
			$this->variables['preferred'] = $this->shops->location_sort_shops(
				$this->variables['preferred'],
				$this->session->latitude,
				$this->session->longitude
			);
		}

		// Load header and navbar views
		$this->load->view('page_structure/header', $this->variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('preferred');

		// Load footer view
		$this->load->view('page_structure/footer');
	}
}
