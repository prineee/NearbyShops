<?php

$config = array(
	'register' => array(
		array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required|strip_tags|alpha_dash|min_length[6]|max_length[32]|is_unique[users.username]',
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required|min_length[8]|max_length[255]',
		),
	),
	'login' => array(
		array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required|strip_tags',
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
