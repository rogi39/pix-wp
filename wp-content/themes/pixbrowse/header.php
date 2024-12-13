<?php
if (isset($_GET['logout'])) {
	wp_logout();
	wp_redirect('/');
}
$current_user = wp_get_current_user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body>
	<?php

	if ($args['without'] !== true) {
	?>
		<header class="header">
			<div class="header__overlay"></div>
			<div class="container">
				<div class="header__row">
					<div class="header__left">
						<?php if (is_front_page()) { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo" class="logo">
						<?php } else { ?>
							<a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo" class="logo"></a>
						<?php } ?>
					</div>
					<div class="header__right">
						<nav class="menu">
							<div class="menu__close">&#10006;</div>
							<ul class="menu__list">
								<li class="menu__item"><a href="/photos/" class="menu__link">Explore</a></li>
								<li class="menu__item"><a href="#" class="menu__link">Pricing</a></li>
								<?php
								if (!is_user_logged_in()) {
								?>
									<li class="menu__item"><a href="/login/" class="menu__link">Login</a></li>
									<li class="menu__item"><a href="/register/" class="menu__link menu__link_black">Sign Up</a></li>
								<?php } else { ?>
									<li class="menu__balance">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M17.25 6.74999V5.60249C17.2502 5.42065 17.2104 5.241 17.1334 5.07624C17.0565 4.91147 16.9443 4.76562 16.8048 4.649C16.6653 4.53239 16.5019 4.44784 16.3261 4.40136C16.1503 4.35487 15.9664 4.34757 15.7875 4.37999L5.2875 6.28874C4.3125 6.46874 3.375 7.24874 3.375 8.24999" stroke="#fde999" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M19.875 11.25V8.25C19.875 7.85218 19.717 7.47064 19.4357 7.18934C19.1544 6.90804 18.7728 6.75 18.375 6.75H4.875C4.47718 6.75 4.09564 6.90804 3.81434 7.18934C3.53304 7.47064 3.375 7.85218 3.375 8.25V18.375C3.375 18.7728 3.53304 19.1544 3.81434 19.4357C4.09564 19.717 4.47718 19.875 4.875 19.875H18.375C18.7728 19.875 19.1544 19.717 19.4357 19.4357C19.717 19.1544 19.875 18.7728 19.875 18.375V15.375" stroke="#fde999" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M15.75 15.375H20.25C20.4489 15.375 20.6397 15.296 20.7803 15.1553C20.921 15.0147 21 14.8239 21 14.625V12C21 11.8011 20.921 11.6103 20.7803 11.4697C20.6397 11.329 20.4489 11.25 20.25 11.25H15.75L14.625 13.3125L15.75 15.375Z" stroke="#fde999" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M17.25 14.0625C17.6642 14.0625 18 13.7267 18 13.3125C18 12.8983 17.6642 12.5625 17.25 12.5625C16.8358 12.5625 16.5 12.8983 16.5 13.3125C16.5 13.7267 16.8358 14.0625 17.25 14.0625Z" fill="#fde999"></path>
										</svg>
										<a href="/profile/billing/" class="menu__balance-text">Balance: <span><?php echo number_format(get_user_meta($current_user->ID, 'account_wallet', true), 0, '', ' '); ?></span> credits</a>
									</li>

									<li class="menu__cabinet"><a href="/profile/"><?php echo mb_substr($current_user->user_login, 0, 1); ?></a></li>

									<li class="menu__logout">
										<a class="menu__logout-text" href="?logout">
											Log out
											<svg focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ExitToAppRoundedIcon">
												<path d="M10.79 16.29c.39.39 1.02.39 1.41 0l3.59-3.59c.39-.39.39-1.02 0-1.41L12.2 7.7a.9959.9959 0 0 0-1.41 0c-.39.39-.39 1.02 0 1.41L12.67 11H4c-.55 0-1 .45-1 1s.45 1 1 1h8.67l-1.88 1.88c-.39.39-.38 1.03 0 1.41zM19 3H5c-1.11 0-2 .9-2 2v3c0 .55.45 1 1 1s1-.45 1-1V6c0-.55.45-1 1-1h12c.55 0 1 .45 1 1v12c0 .55-.45 1-1 1H6c-.55 0-1-.45-1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1v3c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"></path>
											</svg>
										</a>
									</li>

								<?php } ?>
							</ul>
						</nav>
						<?php
						if (is_user_logged_in()) {
						?>
							<div class="menu__cabinet menu__cabinet_mobile"><a href="/profile/"><?php echo mb_substr($current_user->user_login, 0, 1); ?></a></div>
						<?php } ?>
						<span class="header__toggle-menu" id="toggle-menu">
							<span class="header__toggle-line"></span>
						</span>
					</div>
				</div>
			</div>
		</header>
	<?php } ?>