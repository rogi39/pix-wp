<?php
get_header();
$gqo = get_queried_object()
?>
<main>
	<div class="section section_photo">
		<div class="container">
			<form class="search search_w100 search_mb">
				<input type="text" class="search__input" placeholder="Search images">
				<button class="search__btn">
					<svg class="search__btn-svg" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="SearchIcon">
						<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
					</svg>
				</button>
			</form>
			<h1 class="title title_fw400">Landscape Pictures, Images and PixBrowse Photos</h1>
			<div>Find & download the images from our curated list</div>

			<?php
			$terms = get_terms('tags', [
				'hide_empty' => false,
			]);
			if (!empty($terms)) {
				echo '<ul class="tag-list">';
				foreach ($terms as $term) { ?>
					<li class="tag-list__item <?php echo $gqo->term_id === $term->term_id ? 'active' : ''; ?>"><a href="<?php echo esc_html(get_term_link($term)); ?>" class="tag-list__item-link"><?php echo esc_html($term->name); ?></a></li>
			<?php
				}
				echo '</ul>';
			}
			?>
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
			<?php } ?>
		</div>
	</div>

	<div class="footer-block">Hold on to the high-quality images you have a fondness for.</div>
</main>

<?php get_footer(); ?>