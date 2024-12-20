<?php
if (!is_user_logged_in()) {
	wp_redirect(home_url() . '/login/');
	exit;
}
if (checkConfirmAcc() == false) {
	wp_redirect(home_url() . '/profile/');
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
				</div>
				<?php
				$get_liked_posts = get_user_meta($current_user->ID, 'purchased_products', true);
				if (!empty($get_liked_posts)) {
					$post_query = new WP_Query([
						'post_type' => 'photos',
						'posts_per_page' => -1,
						'post__in' => $get_liked_posts,
						'orderby' => 'post__in',
						'post_status' => 'publish'
					]);
					if ($post_query->have_posts()) {
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

										<form method="post" action="/wp-admin/admin-ajax.php" class="table__form">
											<input type="hidden" name="action" value="download_photo">
											<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
											<?php wp_nonce_field('download_nonce_action', 'download_nonce_field'); ?>
											<button class="photo__btn photo__download-btn table__form-btn">
												<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon-start">
													<path d="M15.75 10.5C15.5511 10.5 15.3603 10.579 15.2197 10.7197C15.079 10.8603 15 11.0511 15 11.25V14.25C15 14.4489 14.921 14.6397 14.7803 14.7803C14.6397 14.921 14.4489 15 14.25 15H3.75C3.55109 15 3.36032 14.921 3.21967 14.7803C3.07902 14.6397 3 14.4489 3 14.25V11.25C3 11.0511 2.92098 10.8603 2.78033 10.7197C2.63968 10.579 2.44891 10.5 2.25 10.5C2.05109 10.5 1.86032 10.579 1.71967 10.7197C1.57902 10.8603 1.5 11.0511 1.5 11.25V14.25C1.5 14.8467 1.73705 15.419 2.15901 15.841C2.58097 16.2629 3.15326 16.5 3.75 16.5H14.25C14.8467 16.5 15.419 16.2629 15.841 15.841C16.2629 15.419 16.5 14.8467 16.5 14.25V11.25C16.5 11.0511 16.421 10.8603 16.2803 10.7197C16.1397 10.579 15.9489 10.5 15.75 10.5ZM8.4675 11.7825C8.53883 11.8508 8.62294 11.9043 8.715 11.94C8.80478 11.9797 8.90185 12.0002 9 12.0002C9.09815 12.0002 9.19522 11.9797 9.285 11.94C9.37706 11.9043 9.46117 11.8508 9.5325 11.7825L12.5325 8.7825C12.6737 8.64127 12.7531 8.44973 12.7531 8.25C12.7531 8.05027 12.6737 7.85873 12.5325 7.7175C12.3913 7.57627 12.1997 7.49693 12 7.49693C11.8003 7.49693 11.6087 7.57627 11.4675 7.7175L9.75 9.4425V2.25C9.75 2.05109 9.67098 1.86032 9.53033 1.71967C9.38968 1.57902 9.19891 1.5 9 1.5C8.80109 1.5 8.61032 1.57902 8.46967 1.71967C8.32902 1.86032 8.25 2.05109 8.25 2.25V9.4425L6.5325 7.7175C6.46257 7.64757 6.37955 7.5921 6.28819 7.55426C6.19682 7.51641 6.09889 7.49693 6 7.49693C5.90111 7.49693 5.80318 7.51641 5.71181 7.55426C5.62045 7.5921 5.53743 7.64757 5.4675 7.7175C5.39757 7.78743 5.3421 7.87045 5.30426 7.96181C5.26641 8.05318 5.24693 8.15111 5.24693 8.25C5.24693 8.34889 5.26641 8.44682 5.30426 8.53819C5.3421 8.62955 5.39757 8.71257 5.4675 8.7825L8.4675 11.7825Z" fill="currentColor"></path>
												</svg>
												Download
											</button>
										</form>
										<?php /* 
									<div class="table__load" id="download" data-product-id="<?php echo $post->ID; ?>">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon-start">
											<path d="M15.75 10.5C15.5511 10.5 15.3603 10.579 15.2197 10.7197C15.079 10.8603 15 11.0511 15 11.25V14.25C15 14.4489 14.921 14.6397 14.7803 14.7803C14.6397 14.921 14.4489 15 14.25 15H3.75C3.55109 15 3.36032 14.921 3.21967 14.7803C3.07902 14.6397 3 14.4489 3 14.25V11.25C3 11.0511 2.92098 10.8603 2.78033 10.7197C2.63968 10.579 2.44891 10.5 2.25 10.5C2.05109 10.5 1.86032 10.579 1.71967 10.7197C1.57902 10.8603 1.5 11.0511 1.5 11.25V14.25C1.5 14.8467 1.73705 15.419 2.15901 15.841C2.58097 16.2629 3.15326 16.5 3.75 16.5H14.25C14.8467 16.5 15.419 16.2629 15.841 15.841C16.2629 15.419 16.5 14.8467 16.5 14.25V11.25C16.5 11.0511 16.421 10.8603 16.2803 10.7197C16.1397 10.579 15.9489 10.5 15.75 10.5ZM8.4675 11.7825C8.53883 11.8508 8.62294 11.9043 8.715 11.94C8.80478 11.9797 8.90185 12.0002 9 12.0002C9.09815 12.0002 9.19522 11.9797 9.285 11.94C9.37706 11.9043 9.46117 11.8508 9.5325 11.7825L12.5325 8.7825C12.6737 8.64127 12.7531 8.44973 12.7531 8.25C12.7531 8.05027 12.6737 7.85873 12.5325 7.7175C12.3913 7.57627 12.1997 7.49693 12 7.49693C11.8003 7.49693 11.6087 7.57627 11.4675 7.7175L9.75 9.4425V2.25C9.75 2.05109 9.67098 1.86032 9.53033 1.71967C9.38968 1.57902 9.19891 1.5 9 1.5C8.80109 1.5 8.61032 1.57902 8.46967 1.71967C8.32902 1.86032 8.25 2.05109 8.25 2.25V9.4425L6.5325 7.7175C6.46257 7.64757 6.37955 7.5921 6.28819 7.55426C6.19682 7.51641 6.09889 7.49693 6 7.49693C5.90111 7.49693 5.80318 7.51641 5.71181 7.55426C5.62045 7.5921 5.53743 7.64757 5.4675 7.7175C5.39757 7.78743 5.3421 7.87045 5.30426 7.96181C5.26641 8.05318 5.24693 8.15111 5.24693 8.25C5.24693 8.34889 5.26641 8.44682 5.30426 8.53819C5.3421 8.62955 5.39757 8.71257 5.4675 8.7825L8.4675 11.7825Z" fill="currentColor"></path>
										</svg>
										Download
									</div>
									 */ ?>
									</div>
								</div>
							</div>

				<?php
						}
					} else {
						echo '<div class="table__row"><div class="table__col">No downloads</div></div>';
					}
					wp_reset_postdata();
				} else {
					echo '<div class="table__row"><div class="table__col">No downloads</div></div>';
				}
				?>

				<?php /* 
				<script>
					let download = document.querySelector('#download');
					if (download) {
						const downloadPhoto = (e) => {
							let trg = e.currentTarget;
							let postId = trg.dataset.productId;
							let form = document.createElement('form');
							let formData = new FormData(form);
							formData.append("action", "download_photo");
							formData.append("post_id", postId);
							formData.append("download_nonce_field", downloadNonce.download_nonce_field);
							let blob = fetch('/wp-admin/admin-ajax.php', {
									method: "POST",
									body: formData,
								})
								.then(response => response.blob())
								.then(response => {
									console.log(response);
									const blob = new Blob([response], {
										type: 'application/jpeg'
									});
									const downloadUrl = URL.createObjectURL(blob);

									const a = document.createElement("a");
									a.href = downloadUrl;
									a.download = "jpeg.jpeg";
									document.body.appendChild(a);
									a.click();
								});
						}
						download.addEventListener('click', downloadPhoto);
					}
				</script>
				 */ ?>

			</div>
		</div>
	</div>


	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>