<?php
$page = 'option';

$title = get_field('hero_title', $page);
$descr = get_field('hero_descr', $page);
$form_title = get_field('hero_form_title', $page);
$form_descr = get_field('hero_form_descr', $page);
$btn = get_field('hero_btn', $page);
$image = get_field('hero_image', $page);
?>
<section class="hero jarallax" id="hero">
	<div class="container hero__container">
		<div class="hero__content">
			<?php if ($title): ?>
				<h1 class="hero__title title-1"><?= esc_html($title) ?></h1>
			<?php endif; ?>
			<?php if ($descr): ?>
				<div class="hero__descr descr"><?= wp_kses_post($descr) ?></div>
			<?php endif; ?>
			<?php if ($btn): ?>
				<a class="btn hero__btn btn--light" href="<?= esc_attr($btn['url']) ?>"><?= $btn['title'] ?></a>
			<?php endif; ?>
		</div>
		<div class="hero__form hero-form">
			<?php if ($title): ?>
				<h3 class="hero-form__title title-2"><?php echo esc_html($form_title) ?></h3>
			<?php endif; ?>
			<?php if ($form_descr): ?>
				<div class="hero-form__descr descr">
					<?= wp_kses_post($form_descr) ?>
				</div>
			<?php endif; ?>
			<div class="hero-form__form">
				<?= do_shortcode('[contact-form-7 id="e456bae" title="Оставьте заявку"]') ?>
			</div>
		</div>
	</div>
	<?php if ($image): ?>
		<div class="hero__image section-bg image-box jarallax-img" aria-hidden="true">
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
	<?php endif; ?>
</section>
