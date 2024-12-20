<?php get_header(); ?>
<main>
	<section class="section section_photo">
		<div class="container">
			<div class="section__row">
				<div class="section__left">
					<?php echo get_template_part("template_parts/search", null, ['width' => 'w100']); ?>
					<h1 class="title title_fw400 title_mb"><?php echo 'Search result: ' . '<span>' . get_search_query() . '</span>'; ?></h1>
					<?php
					if (have_posts()) {
					?>
						<div class="grid">
							<div class="grid__gutter"></div>
							<div class="grid__sizer"></div>
							<?php
							while (have_posts()) {
								the_post();
								echo get_template_part("template_parts/grid-item");
							}
							?>
						</div>
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
	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>
<?php get_footer(); ?>