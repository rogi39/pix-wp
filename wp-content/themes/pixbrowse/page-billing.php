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
					<div class="billing-info"></div>
				</div>
			</div>
		</div>
	</div>

	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>