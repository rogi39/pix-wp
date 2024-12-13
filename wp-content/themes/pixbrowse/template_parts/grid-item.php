<a href="<?php the_permalink(); ?>" class="grid__item">
	<?php the_post_thumbnail("large", array("alt" => get_the_title(), "class" => "grid__img")); ?>
</a>