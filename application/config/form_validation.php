<?php

$config = array(
	'register' => array(
		array(
			'field' => 'email',
			'label' => 'email address',
			'rules' => 'trim|required|strip_tags|valid_email|min_length[6]|max_length[64]|is_unique[users.email]'
		),
		array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required|strip_tags|alpha_dash|min_length[6]|max_length[32]|is_unique[users.username]'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required|min_length[8]|max_length[255]'
		)
	),
	'login' => array(
		array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required|strip_tags'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required'
		)
	)
);
