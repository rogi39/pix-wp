<?php

add_action('wp_ajax_billing_update', 'billing_update_action');
add_action('wp_ajax_nopriv_billing_update', 'billing_update_action');

function billing_update_action() {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['billing_update_nonce_field'], 'billing_update_nonce_action')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	$errors = [];
	if (empty($_POST['country'])) {
		$errors['country'] = 'country';
	}
	if (empty($_POST['city'])) {
		$errors['city'] = 'city';
	}
	if (empty($_POST['zip_code'])) {
		$errors['zip_code'] = 'zip_code';
	}
	if (empty($_POST['address'])) {
		$errors['address'] = 'address';
	}
	if (empty($_POST['phone'])) {
		$errors['phone'] = 'phone';
	}
	if (empty($_POST['birth'])) {
		$errors['birth'] = 'birth';
	}

	/* 	if (empty($_POST['register_email']) || !filter_var($_POST['register_email'], FILTER_VALIDATE_EMAIL)) {
		$errors['register_email'] = 'register_email';
		} */


	if (!empty($errors)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'errors' => $errors, 'message' => 'Please fill in the required fields!']);
		die();
	}

	global $current_user;

	foreach ($_POST as $k => $v) {
		if ($k !== 'country' && $k !== 'city' && $k !== 'zip_code' && $k !== 'state' && $k !== 'address' && $k !== 'phone' && $k !== 'birth') break;
		update_user_meta($current_user->ID, 'account_' . $k, $v);
	}
	http_response_code(200);
	echo json_encode(['result' => 'ok', 'message' => 'Billing information updated successfully!', 'redirect' => '/profile/billing/']);
	die();
}

function getBillingFields() {
	global $current_user;
	$arr = ['country', 'city', 'zip_code', 'state', 'address', 'phone', 'birth'];
	$res = [];
	foreach ($arr as $el) {
		$res['account_' . $el] = get_user_meta($current_user->ID, 'account_' . $el, true);
	}
	return $res;
}
function checkRequiredBillingFields() {
	global $current_user;
	$arr = ['country', 'city', 'zip_code', 'address', 'phone', 'birth'];
	foreach ($arr as $el) {
		if (empty(get_user_meta($current_user->ID, 'account_' . $el, true))) {
			return false;
		}
	}
	return true;
}


add_action('wp_ajax_pricing', 'pricing_action');
add_action('wp_ajax_nopriv_pricing', 'pricing_action');

function pricing_action() {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['pricing_nonce_field'], 'pricing_nonce_action')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}


	if (checkRequiredBillingFields() === false) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Please update billing information!', 'redirect' => '/profile/billing/']);
		die();
	}
	global $current_user;
	$productPrice = (1 / 100) * intval($_POST['pricing_sum']);
	$productName = $_POST['pricing_sum'] . ' credits';

	$postFields = [
		"description" => $productName,
		"autoConfirm" => true,
		"expireAt" => gmdate("Y-m-d\TH:i:s\Z", strtotime('+1 hour')),
		"amount" => [
			"value" => strval($productPrice),
			"currency" => 'EUR'
		],
		"customFields" => [
			"cf1" => $current_user->user_email,
			"cf2" => strval($current_user->ID),
			"cf3" => getBillingFields()['account_country'],
			"cf4" => getBillingFields()['account_address'],
			"cf5" => $productName
		],
	];

	$payload = json_encode($postFields);
	send_order($payload);
	die();
}
