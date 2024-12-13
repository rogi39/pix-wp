<?php

function download_photo($filePath, $filename) {
	if (file_exists($filePath)) {
		if (ob_get_level()) {
			ob_end_clean();
		}
		header('Content-Description: File Transfer');
		header("Content-type:image/jpeg");
		header('Content-Disposition: attachment; filename=' . $filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filePath));
		/* readfile($filePath); */
		if ($fd = fopen($filePath, 'rb')) {
			while (!feof($fd)) {
				print fread($fd, 1024);
			}
			fclose($fd);
		}
		exit();
	}
}

add_action('wp_ajax_download_photo', 'download_photo_action');
add_action('wp_ajax_nopriv_download_photo', 'download_photo_action');

function download_photo_action() {

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['download_nonce_field'], 'download_nonce_field')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}


	if (!is_user_logged_in()) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'User is not authorized!', 'redirect_url' => '/login/']);
		die();
	}

	global $current_user;
	$post_id = $_POST['post_id'];
	if ('publish' !== get_post_status($post_id)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}


	$structure = ABSPATH . '../pixbrowse_files/' . wp_get_attachment_metadata(get_post_thumbnail_id($post_id))['file'];
	download_photo($structure, wp_get_attachment_metadata(get_post_thumbnail_id($post_id))['file']);
	echo "<hr /><h1>DEBUG</h1><pre>";
	var_dump(ABSPATH);
	var_dump($structure);
	echo "</pre>";
	die();
	$user_id = $current_user->ID;
	$user_wallet = intval(get_user_meta($user_id, 'account_wallet', true));
	$price_product = intval(get_field('price', $post_id));

	if ($user_wallet < $price_product) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Not enough credits!', 'redirect_url' => '/profile/billing/']);
		die();
	}

	$new_order_id = wp_insert_post([
		'post_author'    => 1,
		'post_status'    => 'publish',
		'post_date' 		 => wp_date("Y-m-d H:i:s"),
		'post_type'      => 'orders',
	]);
	if (is_wp_error($new_order_id)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	wp_update_post(wp_slash([
		'ID' => $new_order_id,
		'post_name' => $new_order_id,
		'post_title' => 'Order#' . $new_order_id,
	]));

	update_user_meta($user_id, 'account_wallet', $user_wallet - $price_product);

	$get_purchased_products = get_user_meta($current_user->ID, 'purchased_products', true);
	if (!empty($get_purchased_products)) {
		array_push($get_purchased_products, $post_id);
		update_user_meta($current_user->ID, 'purchased_products', $get_purchased_products);
	} else {
		update_user_meta($current_user->ID, 'purchased_products', [$post_id]);
	}
	http_response_code(200);
	echo json_encode(['result' => 'ok', 'message' => 'Thank you for your purchase', 'redirect_url' => '/profile/downloads/']);
	die();
}

add_action('wp_ajax_buy_product', 'buy_product_action');
add_action('wp_ajax_nopriv_buy_product', 'buy_product_action');

function buy_product_action() {

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_POST['buy_product_nonce_field'], 'buy_product_nonce_field')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	if (!is_user_logged_in()) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'User is not authorized!', 'redirect_url' => '/login/']);
		die();
	}

	global $current_user;
	$post_id = $_POST['post_id'];
	if ('publish' !== get_post_status($post_id)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}
	$user_id = $current_user->ID;
	$user_wallet = intval(get_user_meta($user_id, 'account_wallet', true));
	$price_product = intval(get_field('price', $post_id));

	if ($user_wallet < $price_product) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Not enough credits!', 'redirect_url' => '/profile/billing/']);
		die();
	}

	$new_order_id = wp_insert_post([
		'post_author'    => 1,
		'post_status'    => 'publish',
		'post_date' 		 => wp_date("Y-m-d H:i:s"),
		'post_type'      => 'orders',
	]);
	if (is_wp_error($new_order_id)) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}

	wp_update_post(wp_slash([
		'ID' => $new_order_id,
		'post_name' => $new_order_id,
		'post_title' => 'Order#' . $new_order_id,
	]));

	update_user_meta($user_id, 'account_wallet', $user_wallet - $price_product);

	$get_purchased_products = get_user_meta($current_user->ID, 'purchased_products', true);
	if (!empty($get_purchased_products)) {
		array_push($get_purchased_products, $post_id);
		update_user_meta($current_user->ID, 'purchased_products', $get_purchased_products);
	} else {
		update_user_meta($current_user->ID, 'purchased_products', [$post_id]);
	}
	http_response_code(200);
	echo json_encode(['result' => 'ok', 'message' => 'Thank you for your purchase', 'redirect_url' => '/profile/downloads/']);
	die();
}


add_action('wp_ajax_like_post', 'like_post_action');
add_action('wp_ajax_nopriv_like_post', 'like_post_action');

function like_post_action() {

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();

	$_POST = cleanPostArr($_POST);
	global $current_user;

	/* в форме: wp_nonce_field('_nonce_action', '_nonce_field'); */
	if (!wp_verify_nonce($_REQUEST['like_nonce_field'], 'like_nonce_field')) {
		http_response_code(422);
		echo json_encode(['result' => 'false', 'message' => 'Something went wrong!']);
		die();
	}
	$post_id = $_POST['post_id'];
	$get_liked_posts = get_user_meta($current_user->ID, 'likes', true);
	if (!empty($get_liked_posts)) {
		if (!in_array($post_id, $get_liked_posts)) {
			array_push($get_liked_posts, $post_id);
			update_user_meta($current_user->ID, 'likes', $get_liked_posts);
			http_response_code(200);
			echo json_encode(['result' => 'ok']);
			die();
		} else {
			$key = array_search($post_id, $get_liked_posts);
			unset($get_liked_posts[$key]);
			update_user_meta($current_user->ID, 'likes', $get_liked_posts);
			http_response_code(200);
			echo json_encode(['result' => 'ok']);
			die();
		}
	} else {
		update_user_meta($current_user->ID, 'likes', [$post_id]);
		http_response_code(200);
		echo json_encode(['result' => 'ok']);
		die();
	}
	die();
}


function checkLikeOnPost($post) {
	global $current_user;
	$get_liked_posts = get_user_meta($current_user->ID, 'likes', true);
	if (!empty($get_liked_posts)) {
		if (in_array($post->ID, $get_liked_posts)) {
			return 1;
		}
	}
	return 0;
}
