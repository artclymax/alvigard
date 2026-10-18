<?php 
$title = $args['title'] ?? '';
$descr = $args['descr'] ?? '';
?>
<div class="section-header">
	<?php if ($title): ?>
		<h2 class="section-header__title title-1">
			<?= esc_html($title) ?>
		</h2>
	<?php endif; ?>
	<?php if ($descr): ?>
		<div class="descr section-header__descr">
			<?= wp_kses_post($descr) ?>
		</div>
	<?php endif; ?>
</div>