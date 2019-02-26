<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shops_model extends MY_Model {
	public function __construct() {
		parent::__construct();

		// Set database table
		$this->table = 'shops';
	}

	public function get_shops() {
		// Initialize the shops array in case there is no shops
		$shops = array();

		// Fetch table for the list of shops available
		$query = $this->get_all_entries();

		// Go through the query results
		foreach ($query as $object => $row) {
			// Assign each row as an indexed entry in the shops array
			$shops[$row->id] = array(
				'name' => $row->name,
				'description' => $row->description,
				'latitude' => $row->latitude,
				'longitude' => $row->longitude,
				'image' => $row->image,
			);
		}

		// Return shops array
		return $shops;
	}
}
