<?php
$page = 'option';

$title = get_field('steps_title', $page);
$descr = get_field('steps_descr', $page);
$items = get_field('steps_items', $page) ?? [];
$image = get_field('steps_image', $page);
?>
<section class="section steps jarallax" id="steps">
	<div class="steps__image image-box section-bg jarallax-img">
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
	<div class="container steps__container">
		<?php if ($title || $descr): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
		<?php endif; ?>

		<?php if ($items): ?>
			<ul class="steps__list grid hidden-mobile">
				<?php foreach ($items as $item): ?>
					<li class="steps__item step-item" style="--bg-decor: url('<?= esc_url($item['steps_item_image']['url']) ?>');">
						<div class="step-item__content">
							<?php if (!empty($item['steps_item_title'])): ?>
								<h3 class="step-item__title title-5"><?= esc_html($item['steps_item_title']) ?></h3>
							<?php endif; ?>
							<?php if (!empty($item['steps_item_descr'])): ?>
								<div class="step-item__descr descr"><?= wp_kses_post($item['steps_item_descr']) ?></div>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="swiper steps-swiper visible-mobile" data-swiper="{'slidesPerView': 1.2, 'spaceBetween': 10 }">
				<div class="swiper-wrapper steps-swiper__wrapper">
					<?php foreach ($items as $index => $item): ?>
						<div class="swiper-slide steps-slide">
							<div class="steps-slide__wrapper step-item"
								style="--bg-decor: url('<?= esc_url($item['steps_item_image']['url']) ?>');"
								data-step-index="<?= ++$index > 9 ? $index : '0' . $index ?>">
								<?php if (!empty($item['steps_item_title'])): ?>
									<h3 class="step-item__title title-5"><?= esc_html($item['steps_item_title']) ?></h3>
								<?php endif; ?>
								<?php if (!empty($item['steps_item_descr'])): ?>
									<div class="step-item__descr descr"><?= wp_kses_post($item['steps_item_descr']) ?></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-btn-box">
					<button class="swiper-btn swiper-btn__prev steps-swiper__btn steps-swiper__btn-prev" type="button"
						aria-label="Назад" data-swiper-btn-prev=".steps-swiper"></button>
					<button class="swiper-btn swiper-btn__next steps-swiper__btn steps-swiper__btn-next" type="button"
						aria-label="Вперёд" data-swiper-btn-next=".steps-swiper"></button>
				</div>
			</div>
		<?php endif; ?>
	</div>

</section>