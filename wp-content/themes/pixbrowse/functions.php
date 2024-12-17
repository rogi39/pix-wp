<?php

require get_template_directory() . '/functions-default.php';
require get_template_directory() . '/functions-styles.php';
require get_template_directory() . '/functions-menu.php';
require get_template_directory() . '/functions-mail.php';
require get_template_directory() . '/functions-login.php';
require get_template_directory() . '/functions-profile.php';
require get_template_directory() . '/functions-billing.php';
require get_template_directory() . '/functions-payment.php';
require get_template_directory() . '/functions-like.php';
require get_template_directory() . '/functions-buy-and-download-photo.php';

// запрет и перенапраление с wp-admin
add_filter('init', 'my_registration_page_redirect');
function my_registration_page_redirect() {
	global $pagenow;
	if ((strtolower($pagenow) == 'wp-login.php')) {
		wp_redirect(home_url('/login/'));
	}
	if ((strtolower($pagenow) == 'wp-login.php') && (strtolower($_GET['action']) == 'register')) {
		wp_redirect(home_url('/login/'));
	}
}

//скрывать все меню, кроме админ
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

// хз че, тоже что то с админкой для зарегестрировнных пользователей
function custom_blockusers_init() {
	if (is_user_logged_in() && is_admin() && !current_user_can('administrator') && !wp_doing_ajax()) {
		wp_redirect(home_url());
		exit;
	}
}
add_action('init', 'custom_blockusers_init');


// при добавлении изображения, создает структуру вне public_html и копирует оригинал изображения
add_filter('wp_generate_attachment_metadata', 'wp_generate_attachment_metadata_filter', 1, 3);
function wp_generate_attachment_metadata_filter($metadata, $attachment_id, $context) {
	// $upload_dir = wp_upload_dir();
	// $full_image_path = trailingslashit($upload_dir['basedir']) . $metadata['file'];
	// $deleted = unlink($full_image_path);
	// return $metadata;

	$upload_dir = wp_get_upload_dir();
	$structure = ABSPATH . '../pixbrowse_files/' . $upload_dir['subdir'];
	if (!is_dir($structure)) {
		mkdir($structure, 0777, true);
	}

	copy($upload_dir['basedir'] . '/' . $metadata['file'], str_replace('public_html/', '', ABSPATH) . 'pixbrowse_files/' . $metadata['file']);

	return $metadata;
}


// при удалении изображения, удаляет оригинал вне public_html
add_filter('pre_delete_attachment', 'pre_delete_attachment_filter', 9999, 3);

function pre_delete_attachment_filter($delete, $post, $force_delete) {
	$base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' . $_SERVER['HTTP_HOST'] . '/' : 'http://' . $_SERVER['HTTP_HOST'] . '/';

	$attch_url = str_replace('http://', 'https://', wp_get_attachment_url($post->ID));
	$attch_url = str_replace($base_url, '', $attch_url);
	$attch_url = str_replace('wp-content/uploads/', '', $attch_url);
	$full_img = str_replace('public_html/', '', ABSPATH) . 'pixbrowse_files/' . $attch_url;

	unlink($full_img);

	return $delete;
}

// не генерирует изображения -scaled, -rotate
add_filter('big_image_size_threshold', '__return_zero');
add_action('wp_image_maybe_exif_rotate', '__return_false');

// переименовывет загружаемый файл
add_filter('sanitize_file_name', 'sanitize_file_name_filter', 10);
function sanitize_file_name_filter($filename) {
	$info = pathinfo($filename);
	$ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
	$name = basename($filename, $ext) . time();
	return md5($name) . $ext;
}

// в custom post добавляет на конец post_id
add_action('wp_insert_post', 'change_slug');
function change_slug($post_id) {
	$slug = 'photos';
	if ($slug != $_POST['post_type']) {
		return;
	}
	$post = get_post($post_id);
	if ($post->post_name == $post_id) return;
	wp_update_post([
		'ID' => $post_id,
		'post_name' => $post_id
	]);
}

function my_post_queries($query) {
	if (!is_admin() && $query->is_main_query()) {
		if (is_post_type_archive('photos')) {
			$query->set('orderby', 'rand');
		}
	}
}
add_action('pre_get_posts', 'my_post_queries');


function my_acf_json_save_point($path) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
