<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preferred extends CI_Controller {
	public function index() {
		// Check whether the user is logged in
		if( isLoggedIn() === FALSE ) {
			// Redirect to dashboard
			redirect( base_url() );
		}

		// Insert page title into the variables array
		$variables['pageSubTitle'] = 'My Preferred Shops';

		// Load our shops and likes and dislikes models and connect to the database
		$this->load->model('shops_model', 'shops', TRUE);
		$this->load->model('likes_model', 'likes', TRUE);
		$this->load->model('dislikes_model', 'dislikes', TRUE);

		// Run form validation
		if($this->form_validation->run('liker') !== FALSE) {
			// Get the requiredd input elements
			$shop_id = $this->input->post('id');
			$action = $this->input->post('action');

			// Unlike a shop
			if($action === 'unlike') {
				$remove_like = $this->likes->remove_like($this->session->id, $shop_id);
			}

			// Refresh the page to prevent a page refresh from repeating the query
			redirect( base_url('preferred') );
		}
		// Fetch all the shops using the shops model
		$shops = $this->shops->get_shops();

		// Fetch the list of likes and dislikes shops for the currently logged in user
		$likes = $this->likes->get_likes($this->session->id);
		$dislikes = $this->dislikes->get_dislikes($this->session->id);

		// Mock location
		$my_latitude = 33.9722702;
		$my_longitude = -6.8515323;

		// Go through the shops array and prepare it for sorting
		foreach ($shops as $id => $details) {
			// Remove not likes or dislikes shops from the shops array
			if( (array_search($id, $likes) === FALSE) || (array_search($id, $dislikes) !== FALSE) ) {
				// Unset the entry from array
				unset($shops[$id]);
			} else {
				// Calculate the distance difference from the user location
				$distance_to_user[$id] = getDistanceDifference($my_latitude, $my_longitude, $details['latitude'], $details['longitude']);
			}
		}

		// Check if the resulting distances array is not empty before proceeding
		if( empty($distance_to_user) === FALSE ) {
			// Sort the array by the calculated distance value
			asort($distance_to_user);
			// Fill preferred array based o the sorted distance ids
			foreach ($distance_to_user as $id => $distance) {
				$variables['preferred'][$id] = $shops[$id];
			}
		}

		// Load header and navbar views
		$this->load->view('page_structure/header', $variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('preferred');

		// Load footer view
		$this->load->view('page_structure/footer');
	}
}
