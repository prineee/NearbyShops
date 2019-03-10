<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends MY_Model {
	protected $data, $account_data, $password_hash;
	public $table;

	public function __construct() {
		parent::__construct();

		// Set database table
		$this->table = 'users';
	}

	public function register($email, $password) {
		// Insert email and the password hash into an array
		$this->data = array(
			'email' => $email,
			'password' => get_password_hash($password),
		);

		// Execute the insert operation into the table
		if( $this->add_new_entry($data) ) {
			// Account registered successfully
			return true;
		} else {
			// An error occured
			return false;
		}
	}

	public function login($email, $password_plain) {
		// Execute the login query with provided email
		$this->account_data = $this->get_by_key('email', $email);

		// If an array is returned then the operation succeeded, else is failure
		if ( is_object($this->account_data) ) {
			// Retrieve the corresponding password value of the provided email
			$this->password_hash = $this->account_data->password;

			// Check if the stored entered password hash and the password hash matches
			if(check_password_hash($password_plain, $this->password_hash) === FALSE) {
				// Wrong password entered
				return false;
			} else {
				// Return account id
				return $this->account_data->id;
			}
		} else {
			// Email not found in table
			return false;
		}
	}
}
