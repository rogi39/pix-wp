<?php
add_action('wp_enqueue_scripts', 'site_scripts');

function site_scripts() {
	$ver = '1.0.1';
	wp_enqueue_style('main', get_template_directory_uri() . '/css/app.min.css', [], $ver);
	wp_enqueue_style('style', get_stylesheet_uri(), [], $ver);

	wp_deregister_script('wp-embed');
	wp_deregister_style('wp-block-library');
	wp_dequeue_style('global-styles');
	wp_dequeue_style('classic-theme-styles');

	// wp_enqueue_script( 'reacaptcha_js', 'https://www.google.com/recaptcha/api.js?render=6LfdrnwaAAAAABDn2Il7mXGDJuqnRIwyXsGV-3YS', '', '', true);
	wp_enqueue_script('main', get_template_directory_uri() . '/js/app.min.js', [], $ver, true);
	if (is_page('favourites') || is_singular('photos')) {
		wp_localize_script('main', 'likeNonce', [
			'like_nonce_field' => wp_create_nonce('like_nonce_field')
		]);
	}
	if (is_singular('photos')) {
		wp_localize_script('main', 'buyProduct', [
			'buy_product_nonce_field' => wp_create_nonce('buy_product_nonce_field')
		]);
	}
}
