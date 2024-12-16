<?php
get_header();
$gqo = get_queried_object()
?>
<main>
	<div class="section section_photo">
		<div class="container">
			<?php echo get_template_part("template_parts/search", null, ['width' => 'w100']); ?>
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

	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>

<?php get_footer(); ?>