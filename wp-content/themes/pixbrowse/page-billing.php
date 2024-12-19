<?php
if (!is_user_logged_in()) {
	wp_redirect(home_url() . '/login/');
	exit;
}

get_header();
?>
<main>
	<?php echo get_template_part("template_parts/cabinet-menu"); ?>

	<div class="billing">
		<div class="container">
			<div class="billing__row">
				<div class="billing__left">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/billing.png" alt="billing" class="billoing__bg">
				</div>
				<div class="billing__right">
					<div class="title title_mb">Your credits</div>
					<div class="billing-credits">
						<div class="billing-credits__row">
							<div class="billing-credits__left">
								<div class="billing-credits__total"><?php echo number_format(get_user_meta($current_user->ID, 'account_wallet', true), 0, '', ' '); ?></div>
								<div class="billing-credits__total-text">Total credits</div>
							</div>
							<div class="billing-credits__right">
								<a href="/pricing/" class="billing-credits__btn">Buy now</a>
							</div>
						</div>
					</div>
					<div class="title title_mb">Billing Information</div>
					<form class="billing-form send-form" action="billing_update">
						<div class="billing-form__block">
							<label class="billing-form__label">
								<span class="billing-form__label-span">Country *</span>
								<input type="text" class="billing-form__input" name="country" value="<?php echo get_user_meta($current_user->ID, 'account_country', true); ?>">
							</label>
							<label class="billing-form__label">
								<span class="billing-form__label-span">City *</span>
								<input type="text" class="billing-form__input" name="city" value="<?php echo get_user_meta($current_user->ID, 'account_city', true); ?>">
							</label>
							<label class="billing-form__label">
								<span class="billing-form__label-span">Zip code *</span>
								<input type="text" class="billing-form__input" name="zip_code" value="<?php echo get_user_meta($current_user->ID, 'account_zip_code', true); ?>">
							</label>
							<label class="billing-form__label">
								<span class="billing-form__label-span">State</span>
								<input type="text" class="billing-form__input" name="state" value="<?php echo get_user_meta($current_user->ID, 'account_state', true); ?>">
							</label>
							<label class="billing-form__label">
								<span class="billing-form__label-span">Address *</span>
								<input type="text" class="billing-form__input" name="address" value="<?php echo get_user_meta($current_user->ID, 'account_address', true); ?>">
							</label>
							<label class="billing-form__label">
								<span class="billing-form__label-span">Phone *</span>
								<input type="text" class="billing-form__input" name="phone" value="<?php echo get_user_meta($current_user->ID, 'account_phone', true); ?>">
							</label>
							<label class="billing-form__label">
								<span class="billing-form__label-span">Date of birth *</span>
								<input type="date" class="billing-form__input" name="birth" value="<?php echo get_user_meta($current_user->ID, 'account_birth', true); ?>">
							</label>
						</div>
						<div class="billing-form__required">* - required fields</div>
						<?php wp_nonce_field('billing_update_nonce_action', 'billing_update_nonce_field'); ?>
						<div class="billing-form__btn-block">
							<button class="billing-form__btn">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>