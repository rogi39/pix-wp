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
						<div class="title title_mb">Sign up to PixBrowse</div>
						<p>Upload stock photos and videos in the best quality</p>
						<form class="form" id="register">
							<div class="form__input-block">
								<input type="text" class="form__input" name="register_email" placeholder="Email">
							</div>
							<div class="form__input-block">
								<input type="password" class="form__input" name="register_password" placeholder="Password">
							</div>
							<div class="form__input-block">
								<input type="password" class="form__input" name="register_password_repeat" placeholder="Repeat password">
							</div>
							<div class="form__check">
								<input type="checkbox" class="form__checkbox" id="form-offers" name="register_offers">
								<label for="form-offers" class="form__checkbox-label"></label>
								<div class="form__policy">Yes, I want emails with visual inspiration, special offers and more.</div>
							</div>
							<div class="form__check">
								<input type="checkbox" class="form__checkbox" id="form-privacy" name="register_privacy">
								<label for="form-privacy" class="form__checkbox-label"></label>
								<div class="form__policy">I accept the <a href="/user-agreement/">User Agreement</a>, <a href="/privacy-policy/">Privacy Policy</a> and <a href="/terms-of-use/">Terms of Use</a>.</div>
							</div>
							<?php wp_nonce_field('register_nonce_action', 'register_nonce_field'); ?>
							<button class="form__btn">Sign up Now</button>
						</form>
						<p class="login-page__sign">This service is offered by DigitalHunter OÜ (16974359), Harju maakond, Tallinn, Kesklinna linnaosa, Vesivärava tn 50-201, 10152, Estonia.</p>
						<p class="login-page__sign">Already have account? <a href="/login/">Login</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer('', ['without' => true]); ?>