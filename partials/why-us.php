<?php
$page = 'option';
$title = get_field('why_us_title', $page);
$descr = get_field('why_us_descr', $page);
$items = get_field('why_us_items', $page) ?? [];
$gallery = get_field('why_us_gallery', $page);
$image = get_field('why_us_image', $page);
$gallery = array_merge($gallery, $gallery);
?>
<section class="section why-us" id="why-us">
	<div class="container why-us__container">
		<?php if ($title || $descr): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
		<?php endif; ?>

		<?php if ($items): ?>
			<ul class="why-us__list grid hidden-mobile">
				<?php foreach ($items as $item): ?>
					<li class="why-us__item why-us-item icon"
						style="--icon-bg: url('<?= esc_url($item['why_us_list_image']['url']) ?>');">
						<div class="why-us-item__content">
							<h3 class="why-us-item__title title-5">
								<?php echo esc_html($item['why_us_list_title']) ?>
							</h3>
							<div class="why-us-item__descr descr">
								<?php echo wp_kses_post($item['why_us_list_descr']) ?>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="swiper why-us-swiper visible-mobile"
				data-swiper="{'slidesPerView': 1, 'spaceBetween': 24, 'rewind': true }">
				<div class="swiper-wrapper why-us-swiper__wrapper">
					<?php foreach ($items as $item): ?>
						<div class="swiper-slide why-us-slide">
							<div class="why-us-slide__wrapper why-us-item icon"
								style="--icon-bg: url('<?= esc_url($item['why_us_list_image']['url']) ?>');">
								<div class="why-us-item__content">
									<h3 class="why-us-item__title title-5">
										<?php echo esc_html($item['why_us_list_title']) ?>
									</h3>
									<div class="why-us-item__descr descr">
										<?php echo wp_kses_post($item['why_us_list_descr']) ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-btn-box">
					<button class="swiper-btn swiper-btn__prev why-us-swiper__btn why-us-swiper__btn-prev" type="button"
						aria-label="Назад" data-swiper-btn-prev=".why-us-swiper"></button>
					<button class="swiper-btn swiper-btn__next why-us-swiper__btn why-us-swiper__btn-next" type="button"
						aria-label="Вперёд" data-swiper-btn-next=".why-us-swiper"></button>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php if ($gallery): ?>
		<div class="swiper why-us-gallery"
			data-swiper="{'slidesPerView': 'auto', 'loop': true, 'autoplay': { 'delay': 1500 }}">
			<div class="swiper-wrapper why-us-gallery__wrapper">
				<?php foreach ($gallery as $item): ?>
					<div class="swiper-slide why-us-gallery-slide">
						<a class="why-us-gallery-slide__wrapper image-box" href="<?= esc_url($item['url']) ?>" data-fancybox>
							<?php echo wp_get_attachment_image(
								$item['ID'],
								'large',
								false,
								array(
									'class' => 'img',
									'alt' => $item['alt'] ?: $item['title']
								)
							); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($image): ?>
		<div class="why-us__image image-box section-bg">
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