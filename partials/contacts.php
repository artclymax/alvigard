<?php
$page = 'option';

$title = get_field('contacts_section_title', $page);
$descr = get_field('contacts_section_descr', $page);
$shortcode = get_field('contacts_section_form_shortcode', $page);
$map = get_field('contacts_section_map', $page);
?>
<section class="section contacts" id="contacts">
	<div class="container contacts__container">
		<?php if ($title || $descr): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
		<?php endif; ?>

		<div class="contacts__body">
			<div class="contacts__info">
				<?php get_template_part('partials/components/contacts-box'); ?>
			</div>
			<div class="contacts__form">
				<?php if ($shortcode): ?>
					<?= do_shortcode($shortcode) ?>
				<?php endif; ?>
			</div>
		</div>

		<?php if ($map): ?>
			<div class="contacts__map map-scroll-lock" data-map-scroll-lock>
				<?php echo wp_kses($map, [
					'iframe' => [
						'src' => true,
						'width' => true,
						'height' => true,
						'style' => true,
						'allowfullscreen' => true,
						'loading' => true,
					],
				]) ?>
			</div>
		<?php endif; ?>
	</div>
</section>
