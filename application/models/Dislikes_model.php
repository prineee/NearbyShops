<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dislikes_model extends MY_Model {
	public function __construct() {
		parent::__construct();

		// Set database table
		$this->table = 'dislikes';
	}

	public function get_dislikes($user_id) {
		// Initialize the dislikes array in case there is no likes shops
		$dislikes = array();

		// Fetch database for the list of dislikes shop ids by the usee
		$query = $this->get_all_entries('user_id', $user_id);

		// Go through the query results
		foreach ($query as $object => $row) {
			// Convert MySQL timestamp format to Unix timestamp format
			$row_timestamp = strtotime($row->timestamp);

			// Check if the conversion was successful
			if($row_timestamp !== FALSE) {
				// Get the current timestamp value
				$current_timestamp = time();
				// Check whether the row is older than 2 hours
				if( ($current_timestamp-$row_timestamp) > 7200 ) {
					// If so delete the row from the table
					$this->remove_dislike($row->id);
				} else {
					// Otherwise add the shop is to dislikes array
					$dislikes[$row->id] = $row->shop_id;
				}
			}
		}

		// Return dislikes array
		return $dislikes;
	}

	public function add_dislike($user_id, $shop_id) {
		// Check whether the user hasn't already disliked this shop
		$this->db->where('user_id', $user_id);
		$row_exists = $this->get_by_key('shop_id', $shop_id);

		// If that's the case and such row doesn't exist
		if($row_exists === FALSE) {
			// Place insert operation values into an array
			$data = array(
				'user_id' => $user_id,
				'shop_id' => $shop_id,
			);

			// Execute the insert operation into the table
			return $this->add_new_entry($data);
		} else {
			// Avoid inserting duplicate
			return false;
		}
	}

	public function remove_dislike($dislike_id) {
		// Delete the dislike row by dislike id
		$this->delete_by_key('id', $dislike_id);
	}
}
