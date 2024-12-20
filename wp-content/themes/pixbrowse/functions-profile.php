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

// мета поле счет аккаунта в админ
add_action('show_user_profile', 'my_user_profile_edit_action');
add_action('edit_user_profile', 'my_user_profile_edit_action');
function my_user_profile_edit_action($user) {
	$account_wallet = get_user_meta($user->ID, 'account_wallet', true);
	$account_country = get_user_meta($user->ID, 'account_country', true);
	$account_city = get_user_meta($user->ID, 'account_city', true);
	$account_zip_code = get_user_meta($user->ID, 'account_zip_code', true);
	$account_state = get_user_meta($user->ID, 'account_state', true);
	$account_address = get_user_meta($user->ID, 'account_address', true);
	$account_phone = get_user_meta($user->ID, 'account_phone', true);
	$account_birth = get_user_meta($user->ID, 'account_birth', true);
	$account_verify = get_user_meta($user->ID, 'account_verify', true);
	$account_code = get_user_meta($user->ID, 'account_code', true);
	$account_code_timestamp = get_user_meta($user->ID, 'account_code_timestamp', true);
?>
	<h3>Account wallet</h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="account_wallet">Sum</label>
				</th>
				<td>
					<input type="number" name="account_wallet" id="account_wallet" value="<?php echo $account_wallet ? $account_wallet : 0; ?>" class="regular-text">
				</td>
			</tr>
		</tbody>
	</table>
	<h3>Account billing</h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="account_country">Country</label>
				</th>
				<td>
					<input type="text" name="account_country" id="account_country" value="<?php echo $account_country ? $account_country : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_city">City</label>
				</th>
				<td>
					<input type="text" name="account_city" id="account_city" value="<?php echo $account_city ? $account_city : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_zip_code">Zip code</label>
				</th>
				<td>
					<input type="text" name="account_zip_code" id="account_zip_code" value="<?php echo $account_zip_code ? $account_zip_code : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_state">State</label>
				</th>
				<td>
					<input type="text" name="account_state" id="account_state" value="<?php echo $account_state ? $account_state : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_address">Address</label>
				</th>
				<td>
					<input type="text" name="account_address" id="account_address" value="<?php echo $account_address ? $account_address : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_phone">Phone</label>
				</th>
				<td>
					<input type="text" name="account_phone" id="account_phone" value="<?php echo $account_phone ? $account_phone : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_birth">Birth</label>
				</th>
				<td>
					<input type="text" name="account_birth" id="account_birth" value="<?php echo $account_birth ? $account_birth : ''; ?>" class="regular-text">
				</td>
			</tr>
		</tbody>
	</table>
	<h3>Verify account</h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="account_verify">Verify?(true/false)</label>
				</th>
				<td>
					<input type="text" name="account_verify" id="account_verify" value="<?php echo $account_verify ? $account_verify : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_code">Verify code</label>
				</th>
				<td>
					<input type="text" name="account_code" id="account_code" value="<?php echo $account_code ? $account_code : ''; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th>
					<label for="account_code_timestamp">Verify code timestamp</label>
				</th>
				<td>
					<input type="text" name="account_code_timestamp" id="account_code_timestamp" value="<?php echo $account_code_timestamp ? $account_code_timestamp : ''; ?>" class="regular-text">
				</td>
			</tr>
		</tbody>
	</table>
<?php
}

// обновление мета поле счет аккаунта в админ
add_action('personal_options_update', 'my_user_profile_update_action');
add_action('edit_user_profile_update', 'my_user_profile_update_action');
function my_user_profile_update_action($user_id) {
	update_user_meta($user_id, 'account_wallet', $_POST['account_wallet']);
	update_user_meta($user_id, 'account_country', $_POST['account_country']);
	update_user_meta($user_id, 'account_city', $_POST['account_city']);
	update_user_meta($user_id, 'account_zip_code', $_POST['account_zip_code']);
	update_user_meta($user_id, 'account_state', $_POST['account_state']);
	update_user_meta($user_id, 'account_address', $_POST['account_address']);
	update_user_meta($user_id, 'account_phone', $_POST['account_phone']);
	update_user_meta($user_id, 'account_birth', $_POST['account_birth']);
	update_user_meta($user_id, 'account_verify', $_POST['account_verify']);
	update_user_meta($user_id, 'account_code', $_POST['account_code']);
	update_user_meta($user_id, 'account_code_timestamp', $_POST['account_code_timestamp']);
}
