<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shops_model extends MY_Model {
	public function __construct() {
		parent::__construct();

		// Set database table
		$this->table = 'shops';
	}
}
