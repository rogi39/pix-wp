<?php
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
