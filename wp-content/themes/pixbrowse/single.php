<?php get_header(); ?>
<main>
	<div class="section section_photo">
		<div class="container">
			<h1 class="title title_fw400"><?php the_title(); ?></h1>
			<div class="content"><?php the_content(); ?></div>
		</div>
	</div>
	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>
<?php get_footer(); ?>