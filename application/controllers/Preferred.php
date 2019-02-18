<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preferred extends CI_Controller {
	public function index() {
		// Insert page title into the variables array
		$variables['pageSubTitle'] = 'My Preferred Shops';

		// Placeholder image: https://via.placeholder.com/100x100
		$placeholder_img = "data:image/png;base64,
			iVBORw0KGgoAAAANSUhEUgAAAGQAAABkBAMAAACCzIhnAAAAG1BMVEXMzMyWlpacnJy+vr6jo6PFxcW3t7eqq
			qqxsbHbm8QuAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAiklEQVRYhe3QMQ6EIBAF0C+GSInF9mYTs+1ewRsQbm
			BlayysKefYO2asXbbYxvxHQj6ECQMAEREREf2NQ/fCtp5Zky6vtRMkSJEzhyISynWJnzH6Z8oQlzS7lEc/fLm
			mQUSvc16OrCPqRl1JePxQYo1ZSWVj9nxrrOb5esw+eXdvzTWfTERERHRXH4tWFZGswQ2yAAAAAElFTkSuQmCC";

		// Fetch liked shops from the shops model
		$variables['shops'] = array(
			array(
				'id' => 1,
				'name' => "Liked shop 1",
				'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
				'img' => $placeholder_img
			),
			array(
				'id' => 2,
				'name' => "Liked shop 2",
				'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
				'img' => $placeholder_img
			),
			array(
				'id' => 3,
				'name' => "Liked shop 3",
				'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
				'img' => $placeholder_img
			),
			array(
				'id' => 4,
				'name' => "Liked shop 4",
				'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
				'img' => $placeholder_img
			)
		);

		// Load header and navbar views
		$this->load->view('page_structure/header', $variables);
		$this->load->view('page_structure/navbar');
		
		// Load the main page view
		$this->load->view('preferred');

		// Load footer view
		$this->load->view('page_structure/footer');
	}

	public function user_action() {
		$unlike = $this->input->post('unlike');

		if( isset($unlike) ) {
			echo 'Unlike: ';
			echo $unlike;
		}

		// Redirect user back
		redirect( base_url('preferred') );
	}
}
