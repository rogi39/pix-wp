<div class="cabinet-menu">
	<ul class="cabinet-menu__list">
		<?php
		wp_nav_menu([
			'menu' => 'cabinet_menu',
			'theme_location' => 'cabinet_menu',
			'items_wrap' => '%3$s',
			'container' => false,
			'walker' => new cabinet_menu_Walker
		]);
		?>
	</ul>
</div>