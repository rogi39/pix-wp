<?php
if (is_user_logged_in()) {
	wp_redirect(home_url());
	exit;
}
get_header('', ['without' => true]);
?>

<body>
	<div class="login-page">
		<div class="container">
			<div class="login-page__row">
				<div class="login-page__left">
					<div class="login-page__bg"></div>
				</div>
				<div class="login-page__right">
					<div class="login-page__right-block">
						<a href="/" class="login-page__logo">
							<img src="<?php echo get_template_directory_uri(); ?>/images/logo-black.svg" alt="logo" class="logo">
						</a>
						<div class="title title_mb">Login to PixBrowse</div>
						<p>Upload stock photos and videos in the best quality</p>
						<form class="form" id="login">
							<div class="form__input-block">
								<input type="text" class="form__input" placeholder="Email" name="login_email">
							</div>
							<div class="form__input-block">
								<input type="password" class="form__input" placeholder="Password" name="login_password">
							</div>
							<?php wp_nonce_field('login_nonce_action', 'login_nonce_field'); ?>
							<button class="form__btn">Login</button>
						</form>
						<p class="login-page__sign">Don't have an account? <a href="/register/">Sign up Now</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer('', ['without' => true]); ?>