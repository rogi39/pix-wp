<?php get_header(); ?>
<main>
	<div class="section section_photo">
		<div class="container">
			<?php echo get_template_part("template_parts/search", null, ['width' => 'w100']); ?>
			<h1 class="title title_fw400"><?php the_title(); ?></h1>

			<?php
			$tags = get_the_terms($post->ID, 'tags');
			if (!empty($tags)) { ?>
				<ul class="tag-list tag-list_single">
					<?php
					foreach ($tags as $tag) {
					?>
						<li class="tag-list__item">
							<a href="<?php echo get_term_link($tag); ?>" class="tag-list__item-link"><?php echo $tag->name; ?></a>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>

			<div class="photo" id="photo" data-product-id="<?php echo $post->ID; ?>">
				<div class="photo__row">
					<div class="photo__left">
						<div class="photo__img-block">
							<?php the_post_thumbnail("large", array("alt" => get_the_title(), "class" => "photo__img")); ?>
						</div>
					</div>
					<div class="photo__right">
						<div class="photo__price"><span><?php echo get_field('price'); ?></span> Credits</div>
						<div class="photo__btn-row">

							<?php if (is_user_logged_in()) { ?>
								<?php if (checkPurchasedProduct($post->ID) === true) { ?>


									<form method="post" action="/wp-admin/admin-ajax.php" class="photo__download">
										<input type="hidden" name="action" value="download_photo">
										<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
										<?php wp_nonce_field('download_nonce_action', 'download_nonce_field'); ?>
										<button class="photo__btn photo__download-btn">
											<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon-start">
												<path d="M15.75 10.5C15.5511 10.5 15.3603 10.579 15.2197 10.7197C15.079 10.8603 15 11.0511 15 11.25V14.25C15 14.4489 14.921 14.6397 14.7803 14.7803C14.6397 14.921 14.4489 15 14.25 15H3.75C3.55109 15 3.36032 14.921 3.21967 14.7803C3.07902 14.6397 3 14.4489 3 14.25V11.25C3 11.0511 2.92098 10.8603 2.78033 10.7197C2.63968 10.579 2.44891 10.5 2.25 10.5C2.05109 10.5 1.86032 10.579 1.71967 10.7197C1.57902 10.8603 1.5 11.0511 1.5 11.25V14.25C1.5 14.8467 1.73705 15.419 2.15901 15.841C2.58097 16.2629 3.15326 16.5 3.75 16.5H14.25C14.8467 16.5 15.419 16.2629 15.841 15.841C16.2629 15.419 16.5 14.8467 16.5 14.25V11.25C16.5 11.0511 16.421 10.8603 16.2803 10.7197C16.1397 10.579 15.9489 10.5 15.75 10.5ZM8.4675 11.7825C8.53883 11.8508 8.62294 11.9043 8.715 11.94C8.80478 11.9797 8.90185 12.0002 9 12.0002C9.09815 12.0002 9.19522 11.9797 9.285 11.94C9.37706 11.9043 9.46117 11.8508 9.5325 11.7825L12.5325 8.7825C12.6737 8.64127 12.7531 8.44973 12.7531 8.25C12.7531 8.05027 12.6737 7.85873 12.5325 7.7175C12.3913 7.57627 12.1997 7.49693 12 7.49693C11.8003 7.49693 11.6087 7.57627 11.4675 7.7175L9.75 9.4425V2.25C9.75 2.05109 9.67098 1.86032 9.53033 1.71967C9.38968 1.57902 9.19891 1.5 9 1.5C8.80109 1.5 8.61032 1.57902 8.46967 1.71967C8.32902 1.86032 8.25 2.05109 8.25 2.25V9.4425L6.5325 7.7175C6.46257 7.64757 6.37955 7.5921 6.28819 7.55426C6.19682 7.51641 6.09889 7.49693 6 7.49693C5.90111 7.49693 5.80318 7.51641 5.71181 7.55426C5.62045 7.5921 5.53743 7.64757 5.4675 7.7175C5.39757 7.78743 5.3421 7.87045 5.30426 7.96181C5.26641 8.05318 5.24693 8.15111 5.24693 8.25C5.24693 8.34889 5.26641 8.44682 5.30426 8.53819C5.3421 8.62955 5.39757 8.71257 5.4675 8.7825L8.4675 11.7825Z" fill="currentColor"></path>
											</svg>
											Download
										</button>
									</form>


								<?php } else { ?>
									<div class="photo__btn" id="buy"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon-start">
											<path d="M15.75 10.5C15.5511 10.5 15.3603 10.579 15.2197 10.7197C15.079 10.8603 15 11.0511 15 11.25V14.25C15 14.4489 14.921 14.6397 14.7803 14.7803C14.6397 14.921 14.4489 15 14.25 15H3.75C3.55109 15 3.36032 14.921 3.21967 14.7803C3.07902 14.6397 3 14.4489 3 14.25V11.25C3 11.0511 2.92098 10.8603 2.78033 10.7197C2.63968 10.579 2.44891 10.5 2.25 10.5C2.05109 10.5 1.86032 10.579 1.71967 10.7197C1.57902 10.8603 1.5 11.0511 1.5 11.25V14.25C1.5 14.8467 1.73705 15.419 2.15901 15.841C2.58097 16.2629 3.15326 16.5 3.75 16.5H14.25C14.8467 16.5 15.419 16.2629 15.841 15.841C16.2629 15.419 16.5 14.8467 16.5 14.25V11.25C16.5 11.0511 16.421 10.8603 16.2803 10.7197C16.1397 10.579 15.9489 10.5 15.75 10.5ZM8.4675 11.7825C8.53883 11.8508 8.62294 11.9043 8.715 11.94C8.80478 11.9797 8.90185 12.0002 9 12.0002C9.09815 12.0002 9.19522 11.9797 9.285 11.94C9.37706 11.9043 9.46117 11.8508 9.5325 11.7825L12.5325 8.7825C12.6737 8.64127 12.7531 8.44973 12.7531 8.25C12.7531 8.05027 12.6737 7.85873 12.5325 7.7175C12.3913 7.57627 12.1997 7.49693 12 7.49693C11.8003 7.49693 11.6087 7.57627 11.4675 7.7175L9.75 9.4425V2.25C9.75 2.05109 9.67098 1.86032 9.53033 1.71967C9.38968 1.57902 9.19891 1.5 9 1.5C8.80109 1.5 8.61032 1.57902 8.46967 1.71967C8.32902 1.86032 8.25 2.05109 8.25 2.25V9.4425L6.5325 7.7175C6.46257 7.64757 6.37955 7.5921 6.28819 7.55426C6.19682 7.51641 6.09889 7.49693 6 7.49693C5.90111 7.49693 5.80318 7.51641 5.71181 7.55426C5.62045 7.5921 5.53743 7.64757 5.4675 7.7175C5.39757 7.78743 5.3421 7.87045 5.30426 7.96181C5.26641 8.05318 5.24693 8.15111 5.24693 8.25C5.24693 8.34889 5.26641 8.44682 5.30426 8.53819C5.3421 8.62955 5.39757 8.71257 5.4675 8.7825L8.4675 11.7825Z" fill="currentColor"></path>
										</svg> Buy</div>
								<?php } ?>
								<div class="photo__like <?php if (checkLikeOnPost($post) === true) echo "active"; ?>" id="like-photo">
									<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.8301 4.09298C18.5421 3.42618 18.1269 2.82194 17.6076 2.31407C17.088 1.80469 16.4753 1.3999 15.8029 1.12169C15.1057 0.83207 14.3579 0.683824 13.6029 0.685562C12.5438 0.685562 11.5104 0.975601 10.6123 1.52345C10.3975 1.65451 10.1934 1.79845 10 1.95529C9.80664 1.79845 9.60254 1.65451 9.3877 1.52345C8.48965 0.975601 7.45625 0.685562 6.39707 0.685562C5.63438 0.685562 4.89531 0.831656 4.19707 1.12169C3.52246 1.40099 2.91445 1.80275 2.39238 2.31407C1.87245 2.82137 1.45712 3.42575 1.16992 4.09298C0.871289 4.78692 0.71875 5.52384 0.71875 6.28223C0.71875 6.99766 0.864844 7.74317 1.15488 8.50156C1.39766 9.13535 1.7457 9.79277 2.19043 10.4566C2.89512 11.5072 3.86406 12.6029 5.06719 13.7137C7.06094 15.5549 9.03535 16.8267 9.11914 16.8783L9.62832 17.2049C9.85391 17.3488 10.1439 17.3488 10.3695 17.2049L10.8787 16.8783C10.9625 16.8246 12.9348 15.5549 14.9307 13.7137C16.1338 12.6029 17.1027 11.5072 17.8074 10.4566C18.2521 9.79277 18.6023 9.13535 18.843 8.50156C19.133 7.74317 19.2791 6.99766 19.2791 6.28223C19.2813 5.52384 19.1287 4.78692 18.8301 4.09298ZM10 15.5055C10 15.5055 2.35156 10.6049 2.35156 6.28223C2.35156 4.09298 4.1627 2.31837 6.39707 2.31837C7.96758 2.31837 9.32969 3.19493 10 4.4754C10.6703 3.19493 12.0324 2.31837 13.6029 2.31837C15.8373 2.31837 17.6484 4.09298 17.6484 6.28223C17.6484 10.6049 10 15.5055 10 15.5055Z" fill="#303030"></path>
									</svg>
								</div>
							<?php } else { ?>
								<a href="/login/" class="photo__btn"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon-start">
										<path d="M15.75 10.5C15.5511 10.5 15.3603 10.579 15.2197 10.7197C15.079 10.8603 15 11.0511 15 11.25V14.25C15 14.4489 14.921 14.6397 14.7803 14.7803C14.6397 14.921 14.4489 15 14.25 15H3.75C3.55109 15 3.36032 14.921 3.21967 14.7803C3.07902 14.6397 3 14.4489 3 14.25V11.25C3 11.0511 2.92098 10.8603 2.78033 10.7197C2.63968 10.579 2.44891 10.5 2.25 10.5C2.05109 10.5 1.86032 10.579 1.71967 10.7197C1.57902 10.8603 1.5 11.0511 1.5 11.25V14.25C1.5 14.8467 1.73705 15.419 2.15901 15.841C2.58097 16.2629 3.15326 16.5 3.75 16.5H14.25C14.8467 16.5 15.419 16.2629 15.841 15.841C16.2629 15.419 16.5 14.8467 16.5 14.25V11.25C16.5 11.0511 16.421 10.8603 16.2803 10.7197C16.1397 10.579 15.9489 10.5 15.75 10.5ZM8.4675 11.7825C8.53883 11.8508 8.62294 11.9043 8.715 11.94C8.80478 11.9797 8.90185 12.0002 9 12.0002C9.09815 12.0002 9.19522 11.9797 9.285 11.94C9.37706 11.9043 9.46117 11.8508 9.5325 11.7825L12.5325 8.7825C12.6737 8.64127 12.7531 8.44973 12.7531 8.25C12.7531 8.05027 12.6737 7.85873 12.5325 7.7175C12.3913 7.57627 12.1997 7.49693 12 7.49693C11.8003 7.49693 11.6087 7.57627 11.4675 7.7175L9.75 9.4425V2.25C9.75 2.05109 9.67098 1.86032 9.53033 1.71967C9.38968 1.57902 9.19891 1.5 9 1.5C8.80109 1.5 8.61032 1.57902 8.46967 1.71967C8.32902 1.86032 8.25 2.05109 8.25 2.25V9.4425L6.5325 7.7175C6.46257 7.64757 6.37955 7.5921 6.28819 7.55426C6.19682 7.51641 6.09889 7.49693 6 7.49693C5.90111 7.49693 5.80318 7.51641 5.71181 7.55426C5.62045 7.5921 5.53743 7.64757 5.4675 7.7175C5.39757 7.78743 5.3421 7.87045 5.30426 7.96181C5.26641 8.05318 5.24693 8.15111 5.24693 8.25C5.24693 8.34889 5.26641 8.44682 5.30426 8.53819C5.3421 8.62955 5.39757 8.71257 5.4675 8.7825L8.4675 11.7825Z" fill="currentColor"></path>
									</svg> Buy</a>
								<a href="/login/" class="photo__like ">
									<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.8301 4.09298C18.5421 3.42618 18.1269 2.82194 17.6076 2.31407C17.088 1.80469 16.4753 1.3999 15.8029 1.12169C15.1057 0.83207 14.3579 0.683824 13.6029 0.685562C12.5438 0.685562 11.5104 0.975601 10.6123 1.52345C10.3975 1.65451 10.1934 1.79845 10 1.95529C9.80664 1.79845 9.60254 1.65451 9.3877 1.52345C8.48965 0.975601 7.45625 0.685562 6.39707 0.685562C5.63438 0.685562 4.89531 0.831656 4.19707 1.12169C3.52246 1.40099 2.91445 1.80275 2.39238 2.31407C1.87245 2.82137 1.45712 3.42575 1.16992 4.09298C0.871289 4.78692 0.71875 5.52384 0.71875 6.28223C0.71875 6.99766 0.864844 7.74317 1.15488 8.50156C1.39766 9.13535 1.7457 9.79277 2.19043 10.4566C2.89512 11.5072 3.86406 12.6029 5.06719 13.7137C7.06094 15.5549 9.03535 16.8267 9.11914 16.8783L9.62832 17.2049C9.85391 17.3488 10.1439 17.3488 10.3695 17.2049L10.8787 16.8783C10.9625 16.8246 12.9348 15.5549 14.9307 13.7137C16.1338 12.6029 17.1027 11.5072 17.8074 10.4566C18.2521 9.79277 18.6023 9.13535 18.843 8.50156C19.133 7.74317 19.2791 6.99766 19.2791 6.28223C19.2813 5.52384 19.1287 4.78692 18.8301 4.09298ZM10 15.5055C10 15.5055 2.35156 10.6049 2.35156 6.28223C2.35156 4.09298 4.1627 2.31837 6.39707 2.31837C7.96758 2.31837 9.32969 3.19493 10 4.4754C10.6703 3.19493 12.0324 2.31837 13.6029 2.31837C15.8373 2.31837 17.6484 4.09298 17.6484 6.28223C17.6484 10.6049 10 15.5055 10 15.5055Z" fill="#303030"></path>
									</svg>
								</a>
							<?php } ?>

						</div>
						<div class="photo__item">Includes our <a href="#">standard license</a></div>
						<div class="photo__item">PixBrowse photo ID: <span><?php echo $post->ID; ?></span></div>
						<div class="photo__item">Upload date: <span> <?php echo get_the_date('M d, Y'); ?></span></div>
						<div class="photo__item">Categories:
							<?php
							$terms = get_the_terms($post->ID, 'categories');
							$len = count($terms);
							$i = 1;
							foreach ($terms as $term) {
								echo '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
								if ($len !== $i) echo ', ';
								$i++;
							}
							?>
						</div>
						<div class="photo__item">Quality: Standard</div>
						<div class="photo__item">Resolution: <span><?php echo wp_get_attachment_metadata(get_post_thumbnail_id($post->ID))['width']; ?> x <?php echo wp_get_attachment_metadata(get_post_thumbnail_id($post->ID))['height']; ?> pixels</span></div>
						<div class="photo__item">Extension: JPG</div>
					</div>
				</div>
				<?php if (get_the_content()) { ?>
					<div class="photo__desc">Description</div>
					<div class="photo__text"><?php the_content(); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="section section_pt0">
		<div class="container">
			<div class="title-row">
				<div class="title">Photos from same series</div>
				<a href="#" class="title-link">View all photos</a>
			</div>
			<div class="grid">
				<div class="grid__gutter"></div>
				<div class="grid__sizer"></div>

				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item1.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item2.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item3.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item4.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item5.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item6.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item7.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item8.jpg" alt="alt" class="grid__img">
				</div>
			</div>
		</div>
	</div>

	<div class="section section_pt0">
		<div class="container">
			<div class="title-row">
				<div class="title">Similar images</div>
				<a href="#" class="title-link">View all photos</a>
			</div>
			<div class="grid">
				<div class="grid__gutter"></div>
				<div class="grid__sizer"></div>

				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item1.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item2.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item3.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item4.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item5.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item6.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item7.jpg" alt="alt" class="grid__img">
				</div>
				<div class="grid__item">
					<img src="<?php echo get_template_directory_uri(); ?>/images/dest/item8.jpg" alt="alt" class="grid__img">
				</div>
			</div>
		</div>
	</div>


	<div class="footer-block">Hold on to the high-quality images you have a fondness for.</div>
</main>
<?php get_footer(); ?>