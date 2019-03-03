<?php

$config = array(
	'register' => array(
		array(
			'field' => 'email',
			'label' => 'email address',
			'rules' => 'trim|required|strip_tags|valid_email|min_length[6]|max_length[64]|is_unique[users.email]'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required|min_length[8]|max_length[255]',
		),
	),
	'login' => array(
		array(
			'field' => 'email',
			'label' => 'email address',
			'rules' => 'trim|required|strip_tags|valid_email'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required',
		),
	),
	'liker' => array(
		array(
			'field' => 'id',
			'label' => 'button id',
			'rules' => 'trim|required|integer|min_length[1]|max_length[10]',
		),
		array(
			'field' => 'action',
			'label' => 'action type',
			'rules' => 'trim|required|in_list[like,unlike,dislike]',
		),
	),
	'locator' => array(
		array(
			'field' => 'latitude',
			'label' => 'latitude',
			'rules' => 'trim|required|numeric|greater_than_equal_to[-90]|less_than_equal_to[90]',
		),
		array(
			'field' => 'longitude',
			'label' => 'longitude',
			'rules' => 'trim|required|numeric|greater_than_equal_to[-180]|less_than_equal_to[180]',
		),
	),
);
