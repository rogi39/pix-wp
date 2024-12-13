<?php

add_action('wp_ajax_profile_update', 'profile_update_action');
add_action('wp_ajax_nopriv_profile_update', 'profile_update_action');

function profile_update_action() {


	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['profile_update_nonce_field'], 'profile_update_nonce_action')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	$errors = [];
	if (empty($_POST['first_name'])) {
		$errors['first_name'] = 'first_name';
	}
	if (empty($_POST['last_name'])) {
		$errors['last_name'] = 'last_name';
	}
	if (empty($_POST['nickname'])) {
		$errors['nickname'] = 'nickname';
	}

	/* 	if (empty($_POST['register_email']) || !filter_var($_POST['register_email'], FILTER_VALIDATE_EMAIL)) {
		$errors['register_email'] = 'register_email';
	} */



	if (!empty($errors)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'errors' => $errors, 'message' => 'Please fill in the required fields!']);
		die();
	}


	$user_id = wp_update_user([
		'ID' => $_POST['user_id'],
		'first_name'       => $_POST['first_name'],
		'last_name' => $_POST['last_name'],
		'user_nicename' => $_POST['nickname']
	]);




	if (is_wp_error($user_id)) {
		// if ($user_id->get_error_code() === 'existing_user_login') {
		// 	$errorMessage = 'Sorry, this phone is already in use!';
		// }

		// if ($user_id->get_error_code() === 'existing_user_email') {
		// 	$errorMessage = 'Sorry, this email address is already in use!';
		// }
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}


	if ($user_id) {
		http_response_code(200);
		echo json_encode(['result' => 'ok', 'message' => 'Data updated successfully!', 'redirect' => '/profile/']);
	} else {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
	}
	die();
}
