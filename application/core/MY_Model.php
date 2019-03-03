<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	// Class properties
	public $table;

	// Class constructor
	public function __construct() {
		parent::__construct();

		// Load database driver
		$this->load->database();
	}

	// Gets all rows from the current table matching the key value
	public function get_all_entries($key = '', $value = NULL) {
		// Add where clause if a specific key is provided
		if($key !== '' && $value !== NULL) {
			// Select row to be fetched
			$this->db->where($key, $value);
		}
		// Execute the get query and return the results
		return $this->db->get($this->table)->result();
	}

	// Gets a single hopefully unique row matching the key value
	public function get_by_key($key, $value) {
		// Select row to be fetched
		$this->db->where($key, $value);
		// Execute the get query on the current table
		$query = $this->db->get($this->table, 1);
		// Return the resulting row if found otherwise false
		return ($query->num_rows() > 0) ? $query->row() : false;
	}

	// Creates a new row to the current table with the data array
	public function add_new_entry(array $data) {
		// Execute the insert query with provided data and return a boolean result
		return $this->db->insert($this->table, $data);
	}

	// Updates a row matching the key value with the data array
	public function update_by_key($key, $value, array $data) {
        // Select row to be updated
		$this->db->where($key, $value);
		// Execute the update query and return a boolean result
	    return $this->db->update($this->table, $data);
	}

	// Deletes a row matching the key value in the current table
	public function delete_by_key($key, $value) {
		// Select row to be deleted
		$this->db->where($key, $value);
		// Execute the delete query with provided data
		return $this->db->delete($this->table);
	}
}
