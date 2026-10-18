<?php
$page = 'options';

$title = get_field('page_404_title', $page) ?? get_the_title();
$descr = get_field('page_404_descr', $page) ?? '';
$btn = get_field('page_404_btn', $page) ?? '';
$image = get_field('page_404_image', $page) ?? '';
$image_mobile = get_field('page_404_image_mobile', $page) ?? '';

?>
<section class="hero-404 jarallax" id="hero-404">
	<div class="container hero-404__container">
		<div class="hero-404__wrapper">
			<h1 class="hero-404__title title-1">
				<?php echo esc_html($title) ?>
			</h1>
			<div class="hero-404__descr descr title-3">
				<?php echo wp_kses_post($descr) ?>
			</div>
			<a class="btn hero-404__btn" href="<?php echo esc_html($btn['url'] ?? '') ?>">
				<?php echo esc_html($btn['title'] ?? '') ?>
			</a>
		</div>
	</div>
	<div class="hero-404__image image-box jarallax-img">
		<?php echo wp_get_attachment_image(
			$image_mobile['ID'],
			'large',
			false,
			array(
				'class' => 'img visible-mobile',
				'alt' => $image_mobile['alt'] ?: ''
			)
		); ?>
		<?php echo wp_get_attachment_image(
			$image['ID'],
			'large',
			false,
			array(
				'class' => 'img hidden-mobile',
				'alt' => $image['alt'] ?: ''
			)
		); ?>
	</div>
</section>