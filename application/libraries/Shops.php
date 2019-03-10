<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shops {
	protected $CI;

	public function __construct() {
		// Get CodeIgniter instance
		$this->CI =& get_instance();
	}

	public function get_nearby_shops($user_id) {
		// Fetch all shops using the shops model
		$shops = $this->CI->shops_model->get_shops();

		// Fetch the list of likes and dislikes shops for the user id
		$likes = $this->CI->likes_model->get_likes($user_id);
		$dislikes = $this->CI->dislikes_model->get_dislikes($user_id);

		// Go through the shops array and remove liked and disliked shops
		foreach ($shops as $id => $details) {
			// Check if current shop id is liked or disliked by the user
			if( (array_search($id, $likes) !== FALSE) || (array_search($id, $dislikes) !== FALSE) ) {
				// Unset the shop from array
				unset($shops[$id]);
			}
		}

		// Return nearby shops
		return $shops;
	}

	public function get_preferred_shops($user_id) {
		// Fetch all shops using the shops model
		$shops = $this->CI->shops_model->get_shops();

		// Fetch the list of likes and dislikes shops for the user id
		$likes = $this->CI->likes_model->get_likes($user_id);
		$dislikes = $this->CI->dislikes_model->get_dislikes($user_id);

		// Go through the shops array and remove liked and disliked shops
		foreach ($shops as $id => $details) {
			// Check if current shop id is not liked or disliked by the user
			if( (array_search($id, $likes) === FALSE) || (array_search($id, $dislikes) !== FALSE) ) {
				// Unset the entry from array
				unset($shops[$id]);
			}
		}

		// Return preferred shops
		return $shops;
	}

	public function location_sort_shops($shops, $latitude, $longitude) {
		// Initialize required variables
		$distance_to_user = array();
		$sorted_shops = array();

		// Go through the shops array and prepare it for sorting
		foreach ($shops as $id => $details) {
			// Calculate the distance difference from the user location
			$distance_to_user[$id] = get_distance_difference(
				$latitude,
				$longitude,
				$details['latitude'],
				$details['longitude']
			);
		}

		// Check if the resulting distance to user is not empty
		if( ! empty($distance_to_user) ) {
			// Sort the array by the calculated distance value
			asort($distance_to_user);

			// Fill shops array using the distance to user ids
			foreach ($distance_to_user as $id => $distance) {
				// Assign shop id entry to the sorted shops array
				$sorted_shops[$id] = $shops[$id];
			}

			// Return sorted shops
			return $sorted_shops;
		} else {
			// Nothing to sort
			return $shops;
		}
	}
}
