<?php
$page = 'option';

$title = get_field('hero_title', $page);
$descr = get_field('hero_descr', $page);
$btn = get_field('hero_btn', $page) ?? [];
$btn_stroke = get_field('hero_btn_stroke', $page) ?? [];
$image = get_field('hero_image', $page);
$image_mobile = get_field('hero_image_mobile', $page);
$list = get_field('hero_list', $page) ?? [];
?>
<section class="section hero jarallax" id="hero">
	<div class="container hero__container">
		<div class="hero__body">
			<div class="hero__header">
				<?php if ($title): ?>
					<h1 class="hero__title title-1"><?= esc_html($title) ?></h1>
				<?php endif; ?>
				<?php if ($descr): ?>
					<div class="hero__descr descr"><?= wp_kses_post($descr) ?></div>
				<?php endif; ?>
			</div>
			<?php if ($btn): ?>
				<div class="hero__btn-box">
					<a class="hero__btn btn" href="<?= esc_url($btn['url']) ?>">
						<?= esc_html($btn['title']) ?>
					</a>
					<a class="hero__btn btn btn--stroke" href="<?= esc_url($btn_stroke['url']) ?>">
						<?= esc_html($btn_stroke['title']) ?>
					</a>
				</div>
			<?php endif; ?>
			<?php if ($list): ?>
				<div class="swiper hero-swiper"
					data-swiper="{'slidesPerView': 'auto', 'spaceBetween': 20, 'rewind': true, 'breakpoints': { '769': { 'spaceBetween': 50 } }}">
					<div class="swiper-wrapper">
						<?php foreach ($list as $item): ?>
							<div class="swiper-slide hero-slide">
								<div class="hero-slide__wrapper">
									<div class="hero-slide__icon">
										<?php echo wp_get_attachment_image(
											$item['hero_list_image']['ID'],
											'large',
											false,
											array(
												'class' => 'img',
												'alt' => $item['hero_list_image']['alt'] ?: $item['hero_list_title']
											)
										); ?>
									</div>
									<span class="hero-slide__text">
										<?php echo esc_html($item['hero_list_title']) ?>
									</span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if ($image): ?>
		<div class="hero__bg-box image-box jarallax-img">
			<?php echo wp_get_attachment_image(
				$image['ID'],
				'full',
				false,
				['class' => 'hero__bg-big hidden-mobile', 'alt' => $image['alt'] ?: '']
			); ?>
			<?php echo wp_get_attachment_image(
				$image_mobile['ID'],
				'full',
				false,
				['class' => 'hero__bg-small visible-mobile', 'alt' => $image_mobile['alt'] ?: '']
			); ?>
		</div>
	<?php endif; ?>
</section>