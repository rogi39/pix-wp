<?php get_header(); ?>
<main>
	<div class="hero">
		<div class="container">
			<h1 class="hero__title title title_tac">Discover a World of Visual Inspiration</h1>
			<div class="hero__text">Discover and download top-quality photos, designs, and mockups.</div>
			<?php echo get_template_part("template_parts/search"); ?>
		</div>
	</div>
	<img src="<?php echo get_template_directory_uri(); ?>/images/dest/picture.jpg" alt="pic" class="main-pic">
	<div class="section">
		<div class="container">
			<div class="title-row">
				<div class="title">Explore Stunning Visuals.</div>
				<a href="/pricing/" class="btn">View pricing</a>
			</div>
			<div class="category">
				<div class="category__row">
					<div class="category__col">
						<a href="/categories/nature/" class="category__item">
							<div class="category__name">Nature</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="category__arr">
							<img src="<?php echo get_template_directory_uri(); ?>/images/dest/cat1.jpg" alt="cat" class="category__img">
						</a>
					</div>
					<div class="category__col">
						<a href="/tags/art/" class="category__item">
							<div class="category__name">Art</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="category__arr">
							<img src="<?php echo get_template_directory_uri(); ?>/images/dest/cat2.jpg" alt="cat" class="category__img">
						</a>
					</div>
					<div class="category__col">
						<a href="/tags/abstract/" class="category__item">
							<div class="category__name">Abstraction</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="category__arr">
							<img src="<?php echo get_template_directory_uri(); ?>/images/dest/cat3.jpg" alt="cat" class="category__img">
						</a>
					</div>
					<div class="category__col">
						<a href="/tags/ai/" class="category__item">
							<div class="category__name">Generative AI</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="category__arr">
							<img src="<?php echo get_template_directory_uri(); ?>/images/dest/cat4.jpg" alt="cat" class="category__img">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section_pt0">
		<div class="container">
			<div class="difference">
				<div class="title">The PixBrowse difference</div>
				<div class="difference__text">As the original stock content site created by creatives for creatives, we get you. You need unique images and videos that connect with your audience, at prices that fit your budget. We've got all that—and more.</div>
				<div class="difference__row">
					<div class="difference__col">
						<div class="difference__item">
							<div>
								<div class="difference__item-icon">
									<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M3.31064 20.172L1.68797 10.032C1.58131 9.36666 1.87464 8.69999 2.43731 8.32933C2.99997 7.95866 3.72664 7.95199 4.29597 8.31066L9.37997 11.5213L14.708 5.41466C15.0333 5.04133 15.5053 4.82666 16 4.82666C16.4946 4.82666 16.9666 5.04133 17.292 5.41466L22.62 11.5213L27.704 8.31066C28.2733 7.95199 29 7.95866 29.5626 8.32933C30.1253 8.69999 30.4186 9.36666 30.312 10.032L28.6893 20.172H3.31064ZM28.3693 22.172L27.896 25.128C27.708 26.3067 26.6906 27.1733 25.4986 27.1733H6.50131C5.30931 27.1733 4.29197 26.3067 4.10397 25.128L3.63064 22.172H28.3693Z" fill="#000000"></path>
									</svg>
								</div>
								<div class="difference__item-title">Exclusive videos and images</div>
								<div class="difference__item-text">Visuals you won't find elsewhere, from global artists who work only with us.</div>
							</div>
							<div class="difference__item-link">Learn more</div>
						</div>
					</div>
					<div class="difference__col">
						<div class="difference__item">
							<div>
								<div class="difference__item-icon">
									<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0_21_729)">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M13.5786 0.0549316C6.07931 0.0549316 0 6.13424 0 13.6335C0 21.1327 6.07931 27.2121 13.5786 27.2121C21.0778 27.2121 27.1571 21.1327 27.1571 13.6335C27.1571 6.13424 21.0778 0.0549316 13.5786 0.0549316ZM31.4404 31.3612C30.6848 32.1301 29.4419 32.141 28.6731 31.3855L23.2454 26.0521C24.2779 25.2472 25.2073 24.3162 26.0108 23.2825L31.4161 28.5939C32.185 29.3494 32.1959 30.5923 31.4404 31.3612ZM13.5786 3.83556C18.9898 3.83556 23.3764 8.22224 23.3764 13.6334C23.3764 19.0446 18.9897 23.4313 13.5786 23.4313C8.16731 23.4313 3.78069 19.0446 3.78069 13.6334C3.78069 8.22224 8.16738 3.83556 13.5786 3.83556Z" fill="#000000"></path>
										</g>
										<defs>
											<clipPath id="clip0_21_729">
												<rect width="32" height="32" fill="white"></rect>
											</clipPath>
										</defs>
									</svg>
								</div>
								<div class="difference__item-title">AI-powered search</div>
								<div class="difference__item-text">Everything you want, without looking at page after page of visuals.</div>
							</div>
							<div class="difference__item-link">Learn more</div>
						</div>
					</div>
					<div class="difference__col">
						<div class="difference__item">
							<div>
								<div class="difference__item-icon">
									<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M29.174 15.412L16.581 2.819C16.07 2.315 15.37 2 14.6 2H4.80002C3.25298 2 2 3.25298 2 4.80002V14.6C2 15.377 2.315 16.077 2.82602 16.581L15.426 29.181C15.93 29.685 16.63 30 17.4 30C18.17 30 18.877 29.685 19.381 29.181L29.181 19.381C29.685 18.87 30 18.1701 30 17.4C30 16.623 29.685 15.923 29.174 15.412ZM6.90002 9.00002C5.738 9.00002 4.80002 8.06204 4.80002 6.90002C4.80002 5.738 5.738 4.80002 6.90002 4.80002C8.06204 4.80002 9.00002 5.738 9.00002 6.90002C9.00002 8.06204 8.06197 9.00002 6.90002 9.00002Z" fill="#000000"></path>
									</svg>
								</div>
								<div class="difference__item-title">Affordable pricing</div>
								<div class="difference__item-text">Value and premium-quality—never sacrifice one for the other.</div>
							</div>
							<div class="difference__item-link">Learn more</div>
						</div>
					</div>
					<div class="difference__col">
						<div class="difference__item">
							<div>
								<div class="difference__item-icon">
									<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0_21_750)">
											<path d="M30.657 9.42745L27.39 7.47282L26.654 4.42595C26.3272 3.07463 25.0756 2.17376 23.7032 2.28176L19.9651 2.57107L17.8237 0.67507C16.769 -0.224867 15.2346 -0.224867 14.1763 0.674133L12.0349 2.57101L8.29674 2.2817C6.93992 2.18651 5.67192 3.07545 5.37986 4.31507C5.31942 4.50294 4.22774 7.89638 4.29861 7.67595L1.34349 9.42645C0.159736 10.1534 -0.314514 11.6127 0.215549 12.8963L1.49086 15.9871L0.216486 19.0771C-0.314514 20.3616 0.160611 21.82 1.34349 22.546L4.60711 24.4869L5.34592 27.5476C5.67092 28.8979 6.91699 29.7943 8.29667 29.6918L11.9945 29.4061L14.1762 31.3244C14.7045 31.7748 15.3518 32 16 32C16.6472 32 17.2955 31.7748 17.8237 31.3243L20.0054 29.4061L23.7032 29.6917C25.1004 29.8024 26.329 28.8988 26.654 27.5475L27.39 24.5006L30.657 22.546C31.8389 21.82 32.3132 20.3616 31.784 19.0771L30.5087 15.9872L31.7849 12.8954C32.3141 11.6128 31.8399 10.1534 30.657 9.42745ZM16 26.3125C10.3137 26.3125 5.68749 21.6863 5.68749 16C5.68749 10.3137 10.3137 5.68751 16 5.68751C21.6863 5.68751 26.3125 10.3137 26.3125 16C26.3125 21.6863 21.6863 26.3125 16 26.3125Z" fill="#000000"></path>
											<path d="M16 7.5625C11.3473 7.5625 7.5625 11.3473 7.5625 16C7.5625 20.6527 11.3473 24.4375 16 24.4375C20.6527 24.4375 24.4375 20.6527 24.4375 16C24.4375 11.3473 20.6527 7.5625 16 7.5625ZM21.3503 13.8503L15.7253 19.4753C15.5422 19.6584 15.3023 19.75 15.0625 19.75C14.8227 19.75 14.5828 19.6584 14.3997 19.4753L10.6497 15.7253C10.2835 15.3591 10.2835 14.7658 10.6497 14.3996C11.0159 14.0334 11.6092 14.0334 11.9754 14.3996L15.0625 17.4868L20.0247 12.5246C20.3909 12.1584 20.9842 12.1584 21.3504 12.5246C21.7166 12.8908 21.7166 13.4841 21.3503 13.8503Z" fill="#000000"></path>
										</g>
										<defs>
											<clipPath id="clip0_21_750">
												<rect width="32" height="32" fill="white"></rect>
											</clipPath>
										</defs>
									</svg>
								</div>
								<div class="difference__item-title">Worry-free licensing</div>
								<div class="difference__item-text">Commercial-use content backed by industry-leading coverage.</div>
							</div>
							<div class="difference__item-link">Learn more</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section_pt0">
		<div class="container">
			<div class="title">Create your best work, with the best royalty-free content</div>
			<p>Unique hand-picked photos, affordable HD and 4K video clips, editable vectors—and much, much more. You'll find it all, right here.</p>
			<div class="grid">
				<div class="grid__gutter"></div>
				<div class="grid__sizer"></div>

				<?php
				$post_query = new WP_Query([
					'post_type' => 'photos',
					'posts_per_page' => 8,
					'orderby' => 'rand'
				]);
				while ($post_query->have_posts()) {
					$post_query->the_post();
					$post_query->post;
					echo get_template_part("template_parts/grid-item");
				}
				wp_reset_postdata();
				?>

			</div>
		</div>
	</div>
	<?php /* 
	<div class="section section_pt0">
		<div class="container">
			<div class="title title_mb">Browse all categories</div>
			<ul class="category-list">
				<?php
				$terms = get_terms([
					'taxonomy' => 'categories',
					'hide_empty' => false
				]);
				if (!empty($terms)) {
					foreach ($terms as $term) {
				?>
						<li class="category-list__item">
							<a href="<?php echo get_term_link($term); ?>" class="category-list__link"><?php echo $term->name; ?></a>
						</li>
					<?php } ?>
				<?php } ?>

			</ul>
		</div>
	</div>
	 */ ?>
	<div class="section section_stock">
		<div class="container">
			<div class="title title_mb">Get free stock photos, illustrations and videos</div>
			<p>Each week, our experts select a photo from our exclusive Signature collection and make it free to download, with free illustrations and video clips available monthly.</p>
			<div class="stock-cat">
				<div class="stock-cat__row">
					<div class="stock-cat__col">
						<a href="/categories/architecture/" class="stock-cat__item">
							<img src="<?php echo get_template_directory_uri(); ?>/images/p3.jpg" alt="stock_cat1" class="stock-cat__item-img">
							<div class="stock-cat__item-title">Backgrounds</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="stock-cat__item-svg">
						</a>
					</div>
					<div class="stock-cat__col">
						<a href="/categories/landscapes/" class="stock-cat__item">
							<img src="<?php echo get_template_directory_uri(); ?>/images/p2.jpg" alt="stock_cat1" class="stock-cat__item-img">
							<div class="stock-cat__item-title">Meadows</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="stock-cat__item-svg">
						</a>
					</div>
					<div class="stock-cat__col">
						<a href="/categories/nature/" class="stock-cat__item">
							<img src="<?php echo get_template_directory_uri(); ?>/images/p1.jpg" alt="stock_cat1" class="stock-cat__item-img">
							<div class="stock-cat__item-title">Mountains</div>
							<img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" alt="arr" class="stock-cat__item-svg">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>