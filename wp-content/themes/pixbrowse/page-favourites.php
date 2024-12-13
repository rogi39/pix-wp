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

				<?php
				$get_liked_posts = get_user_meta($current_user->ID, 'likes', true);
				if (!empty($get_liked_posts)) {
					$post_query = new WP_Query([
						'post_type' => 'photos',
						'posts_per_page' => -1,
						'post__in' => $get_liked_posts,
						'orderby' => 'post__in',
					]);
					while ($post_query->have_posts()) {
						$post_query->the_post();
						$post_query->post; ?>
						<div class="table__row">
							<a href="<?php the_permalink(); ?>" class="table__col table__col_mounth-single">
								<?php the_post_thumbnail("thumbnail", array("alt" => get_the_title(), "class" => "table__img")); ?>
								<?php the_title(); ?>
							</a>
							<div class="table__col table__col_days-single">
								<div class="table__col-key">Price</div>
								<div class="table__col-value"><?php echo get_field('price') ?> credits</div>
							</div>

							<div class="table__col table__col_dates-single">
								<div class="table__col-key">Date</div>
								<div class="table__col-value"><?php echo get_the_date('M d, Y'); ?></div>
							</div>

							<div class="table__col table__col_time-single">
								<div class="table__col-key">Method</div>
								<div class="table__col-value">Credits</div>
							</div>
							<div class="table__col table__col_teacher-single">
								<div class="table__col-key"></div>
								<div class="table__col-value">
									<div class="table__del" data-product-id="<?php echo $post->ID; ?>">
										<svg focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="DeleteIcon">
											<path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
										</svg>
									</div>
								</div>
							</div>
						</div>
				<?php
					}
					wp_reset_postdata();
				} else {
					echo '<div class="table__row"><div class="table__col">No likes</div></div>';
				}
				?>
			</div>
		</div>
	</div>

	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>