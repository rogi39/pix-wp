<?php
if (!is_user_logged_in()) {
	wp_redirect(home_url() . '/login/');
	exit;
}

get_header();
?>
<main>
	<?php echo get_template_part("template_parts/cabinet-menu"); ?>

	<div class="table-block">
		<div class="container">
			<div class="table">
				<div class="table__row table__row_header">
					<div class="table__col table__col_mounth-single">Details</div>
					<div class="table__col table__col_days-single">Price</div>
					<div class="table__col table__col_dates-single">Date</div>
					<div class="table__col table__col_time-single">Method</div>
					<div class="table__col table__col_teacher-single"></div>
					<!-- <div class="table__col table__col_details-single">Детали</div> -->
				</div>
				<div class="table__row">
					<a href="#" class="table__col table__col_mounth-single">
						<img src="<?php echo get_template_directory_uri(); ?>/images/dest/table.jpg" alt="table" class="table__img">
						This is a Funny forest gnome photo from Character category
					</a>
					<div class="table__col table__col_days-single">
						<div class="table__col-key">Price</div>
						<div class="table__col-value">500 credits</div>
					</div>

					<div class="table__col table__col_dates-single">
						<div class="table__col-key">Date</div>
						<div class="table__col-value">Jul 19, 2024</div>
					</div>

					<div class="table__col table__col_time-single">
						<div class="table__col-key">Method</div>
						<div class="table__col-value">Credits</div>
					</div>
					<div class="table__col table__col_teacher-single">
						<div class="table__col-key"></div>
						<div class="table__col-value">
							<div class="table__del">
								<svg focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="DeleteIcon">
									<path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="table__row">
					<a href="#" class="table__col table__col_mounth-single">
						<img src="<?php echo get_template_directory_uri(); ?>/images/dest/table.jpg" alt="table" class="table__img">
						This is a Funny forest gnome photo from Character category
					</a>
					<div class="table__col table__col_days-single">
						<div class="table__col-key">Price</div>
						<div class="table__col-value">500 credits</div>
					</div>

					<div class="table__col table__col_dates-single">
						<div class="table__col-key">Date</div>
						<div class="table__col-value">Jul 19, 2024</div>
					</div>

					<div class="table__col table__col_time-single">
						<div class="table__col-key">Method</div>
						<div class="table__col-value">Credits</div>
					</div>
					<div class="table__col table__col_teacher-single">
						<div class="table__col-key"></div>
						<div class="table__col-value">
							<div class="table__del">
								<svg focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="DeleteIcon">
									<path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
								</svg>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>