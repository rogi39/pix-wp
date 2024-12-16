<?php get_header(); ?>
<section class="section section_photo">
	<div class="container">
		<div class="section__row">
			<div class="section__left">
				<?php echo get_template_part("template_parts/search", null, ['width' => 'w100']); ?>
				<h1 class="title title_fw400 title_mb"><?php echo 'Search result: ' . '<span>' . get_search_query() . '</span>'; ?></h1>
				<?php
				$i = 1;
				if (have_posts()) {
					while (have_posts()) {
						the_post();
				?>
						<a href="<?php echo get_the_permalink(); ?>" class="search-item">
							<h2 class="search-item__title"><?php echo $i; ?>) <?php the_title(); ?></h2>
							<p class="search-item__text"><?php the_excerpt(); ?></p>
							<div class="search-item__link">Read more</div>
						</a>
						<?php $i++; ?>
					<?php } ?>
				<?php } else { ?>
					<p>No posts matching your query were found<?php if ($_GET['s']) echo ' "' . $_GET['s'] . '"'; ?>. Check if your query is entered correctly and there are no typos. Try changing the phrase or query criteria.</p>
				<?php } ?>
				<?php if (function_exists('wp_pagenavi')) {
					wp_pagenavi();
				} ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>