<?php
if (!is_user_logged_in()) {
	wp_redirect(home_url() . '/login/');
	exit;
}

get_header();


?>
<main>
	<?php echo get_template_part("template_parts/cabinet-menu"); ?>
	<div class="profile">
		<div class="container">
			<div class="profile__row">
				<div class="profile__left">
					<div class="profile__info">
						<div class="profile__info-top">
							<div class="profile__info-circle"><?php echo mb_substr($current_user->user_login, 0, 1); ?></div>
							<div class="profile__info-name">
								<?php
								if (!empty($current_user->user_firstname) && !empty($current_user->user_lastname)) {
									echo $current_user->user_firstname . ' ' . $current_user->user_lastname;
								} else {
									echo 'Your name and surname';
								}
								?>
							</div>
						</div>
						<div class="profile__info-mail"><svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.0667 9.3501L7.91666 14.5084C7.2415 15.1084 6.36261 15.4278 5.45976 15.4012C4.55691 15.3747 3.69832 15.0041 3.05963 14.3655C2.42094 13.7268 2.05042 12.8682 2.02384 11.9653C1.99726 11.0625 2.31664 10.1836 2.91666 9.50843L9.58332 2.84176C9.98134 2.46368 10.5094 2.25287 11.0583 2.25287C11.6073 2.25287 12.1353 2.46368 12.5333 2.84176C12.9211 3.23475 13.1385 3.76465 13.1385 4.31676C13.1385 4.86887 12.9211 5.39877 12.5333 5.79176L6.78332 11.5334C6.72642 11.5947 6.658 11.6442 6.58197 11.679C6.50594 11.7139 6.4238 11.7334 6.34023 11.7365C6.25665 11.7396 6.17329 11.7262 6.09489 11.6971C6.0165 11.6679 5.94461 11.6237 5.88332 11.5668C5.82204 11.5099 5.77256 11.4414 5.73772 11.3654C5.70288 11.2894 5.68336 11.2072 5.68026 11.1237C5.67717 11.0401 5.69056 10.9567 5.71968 10.8783C5.74881 10.7999 5.79308 10.728 5.84999 10.6668L10.125 6.4001C10.2819 6.24318 10.3701 6.03035 10.3701 5.80843C10.3701 5.58651 10.2819 5.37368 10.125 5.21676C9.96807 5.05984 9.75524 4.97169 9.53332 4.97169C9.31141 4.97169 9.09858 5.05984 8.94166 5.21676L4.66666 9.5001C4.45274 9.71235 4.28296 9.96485 4.1671 10.243C4.05124 10.5212 3.99159 10.8196 3.99159 11.1209C3.99159 11.4223 4.05124 11.7206 4.1671 11.9988C4.28296 12.277 4.45274 12.5295 4.66666 12.7418C5.10363 13.158 5.684 13.3902 6.28749 13.3902C6.89098 13.3902 7.47135 13.158 7.90832 12.7418L13.65 6.99176C14.3124 6.28089 14.673 5.34066 14.6559 4.36915C14.6387 3.39764 14.2452 2.47072 13.5581 1.78365C12.871 1.09659 11.9441 0.703028 10.9726 0.685887C10.0011 0.668746 9.06086 1.02936 8.34999 1.69176L1.68332 8.35843C0.784323 9.35413 0.304181 10.6583 0.342935 11.9992C0.38169 13.3402 0.936352 14.6145 1.89136 15.5566C2.84636 16.4987 4.12805 17.036 5.46939 17.0565C6.81073 17.077 8.10827 16.5792 9.09166 15.6668L14.25 10.5168C14.3277 10.4391 14.3893 10.3468 14.4314 10.2453C14.4734 10.1438 14.4951 10.035 14.4951 9.9251C14.4951 9.81521 14.4734 9.70641 14.4314 9.60489C14.3893 9.50337 14.3277 9.41113 14.25 9.33343C14.1723 9.25573 14.08 9.1941 13.9785 9.15205C13.877 9.11 13.7682 9.08835 13.6583 9.08835C13.5484 9.08835 13.4396 9.11 13.3381 9.15205C13.2366 9.1941 13.1444 9.25573 13.0667 9.33343V9.3501Z" fill="black" fill-opacity="0.51"></path>
							</svg><?php echo $current_user->user_email; ?></div>
					</div>
				</div>
				<div class="profile__right">
					<form class="profile__form send-form" action="profile_update">
						<div class="title title_mb">Account data</div>
						<div class="profile__form-row">
							<div class="profile__form-col">
								<input type="text" class="profile__form-input" placeholder="Name" name="first_name" value="<?php echo $current_user->user_firstname; ?>">
							</div>
							<div class="profile__form-col">
								<input type="text" class="profile__form-input" placeholder="Surname" name="last_name" value="<?php echo $current_user->user_lastname; ?>">
							</div>
							<div class="profile__form-col">
								<input type="text" class="profile__form-input" placeholder="Username" name="nickname" value="<?php echo $current_user->user_nicename; ?>">
							</div>
							<div class="profile__form-col">
								<input type="text" class="profile__form-input" placeholder="Email" value="<?php echo $current_user->user_email; ?>" disabled>
							</div>
						</div>
						<input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>">
						<?php wp_nonce_field('profile_update_nonce_action', 'profile_update_nonce_field'); ?>
						<button class="profile__form-btn">Save changes</button>
					</form>

				</div>
			</div>
		</div>
	</div>

	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>