<?php

add_action('wp_ajax_register', 'register_action');
add_action('wp_ajax_nopriv_register', 'register_action');

function register_action() {

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['register_nonce_field'], 'register_nonce_action')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	$errors = [];
	/* 	if (empty($_POST['signup_name'])) {
		$errors['signup_name'] = 'signup_name';
	}
	if (empty($_POST['signup_surname'])) {
		$errors['signup_surname'] = 'signup_surname';
	}
	if (empty($_POST['signup_phone'])) {
		$errors['signup_phone'] = 'signup_phone';
	} */
	if (empty($_POST['register_email']) || !filter_var($_POST['register_email'], FILTER_VALIDATE_EMAIL)) {
		$errors['register_email'] = 'register_email';
	}
	if (empty($_POST['register_password'])) {
		$errors['register_password'] = 'register_password';
	}

	if (empty($errors) && strlen($_POST['register_password']) < 8) {
		$errors['register_password'] = 'register_password';
		http_response_code(422);
		echo json_encode(['result' => 'false', 'errors' => $errors, 'message' => 'The password length must be more than 8 characters.']);
		die();
	}

	if (empty($errors) && $_POST['register_password'] !== $_POST['register_password_repeat']) {
		$errors['register_password'] = 'register_password';
		$errors['register_password_repeat'] = 'register_password_repeat';
		http_response_code(422);
		echo json_encode(['result' => 'false', 'errors' => $errors, 'message' => 'Passwords do not match!']);
		die();
	}

	if (!empty($errors)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'errors' => $errors, 'message' => 'Please fill in the required fields!']);
		die();
	}

	$email = $_POST['register_email'];
	$password = $_POST['register_password'];

	$userdata = [
		'user_login' => $email,
		'user_email' => $email,
		'user_pass'  => $password,
		'meta_input' => [
			'account_wallet' => 0
		]
	];

	$user_id = wp_insert_user($userdata);

	if (is_wp_error($user_id)) {
		if ($user_id->get_error_code() === 'existing_user_login') {
			$errorMessage = 'Sorry, this phone is already in use!';
		}

		if ($user_id->get_error_code() === 'existing_user_email') {
			$errorMessage = 'Sorry, this email address is already in use!';
		}
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => $errorMessage]);
		die();
	}
	$creds = array();
	$creds['user_login'] = $email;
	$creds['user_password'] = $password;
	$creds['remember'] = true;
	wp_signon($creds, false);

	if ($user_id) {
		http_response_code(200);
		echo json_encode(['result' => 'ok', 'message' => 'You have registered successfully.', 'redirect' => '/profile/']);
	} else {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
	}
	die();
}


add_action('wp_ajax_login', 'login_action');
add_action('wp_ajax_nopriv_login', 'login_action');

function login_action() {

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['login_nonce_field'], 'login_nonce_action')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	if ($_POST['login_email'] === 'moderator' || $_POST['login_email'] === 'redaktor') {
		$creds = array();
		$creds['user_login'] = $_POST['login_email'];
		$creds['user_password'] = $_POST['login_password'];
		$creds['remember'] = true;
		$user = wp_signon($creds, true);
		http_response_code(200);
		echo json_encode(['result' => 'ok', 'message' => 'You have successfully logged in.', 'redirect' => '/wp-admin/']);
		die();
	}

	$errors = [];

	if (empty($_POST['login_email']) || !filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL)) {
		$errors['login_email'] = 'login_email';
	}
	if (empty($_POST['login_password'])) {
		$errors['login_password'] = 'login_password';
	}

	if (!empty($errors)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'errors' => $errors, 'message' => 'Please fill in the required fields!']);
		die();
	}

	$email = $_POST['login_email'];
	$password = $_POST['login_password'];

	$creds = array();
	$creds['user_login'] = $email;
	$creds['user_password'] = $password;
	$creds['remember'] = true;
	$user = wp_signon($creds, true);

	if (is_wp_error($user)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Incorrect password']);
	} else {
		http_response_code(200);
		echo json_encode(['result' => 'ok', 'message' => 'You have successfully logged in.', 'redirect' => '/profile/']);
	}

	die();
}
