<?php
$page = 'option';
$title = get_field('form_title', $page);
$descr = get_field('form_descr', $page);
$content_descr = get_field('form_content_descr', $page);
$shortcode = get_field('form_shortcode', $page);
$image = get_field('form_image', $page);
?>
<section class="section-form jarallax" id="section-form">
	<div class="container section-form__container">
		<div class="section-form__content">
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
			<?php if ($content_descr): ?>
				<div class="section-form__descr descr">
					<?php echo wp_kses_post($content_descr); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="section-form__form">
			<?php if ($shortcode): ?>
				<?= do_shortcode($shortcode) ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="section-form__image image-box section-bg jarallax-img">
		<?php echo wp_get_attachment_image(
			$image['ID'],
			'large',
			false,
			array(
				'class' => 'img',
				'alt' => $image['alt'] ?: ''
			)
		); ?>
	</div>
</section>