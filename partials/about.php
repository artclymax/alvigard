<?php
$page = 'option';

$title = get_field('about_title', $page);
$descr = get_field('about_descr', $page);
$stats = get_field('about_stats', $page) ?? [];
$image = get_field('about_image', $page);
$image_mobile = get_field('about_image_mobile', $page);
?>
<section class="section about jarallax" id="about">
	<div class="container about__container">
		<?php if ($title): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
			]); ?>
		<?php endif; ?>
		<?php if ($descr): ?>
			<div class="about__descr descr title-3">
				<?php echo wp_kses_post($descr) ?>
			</div>
		<?php endif; ?>
		<?php if ($stats): ?>
			<div class="swiper about-stats-swiper"
				data-swiper="{'slidesPerView': 'auto', 'spaceBetween': 40, 'rewind': true, 'breakpoints': {'576': {'spaceBetween': 80}, '768': {'spaceBetween': 100}, '1024': {'spaceBetween': 120}} }">
				<div class="swiper-wrapper about-stats-swiper__wrapper">
					<?php foreach ($stats as $stat): ?>
						<div class="swiper-slide about-stat-slide">
							<div class="about-stat">
								<?php if (!empty($stat['about_stat_value'])): ?>
									<div class="about-stat__value title-1">
										<?php echo esc_html($stat['about_stat_value']) ?>
									</div>
								<?php endif; ?>
								<?php if (!empty($stat['about_stat_label'])): ?>
									<div class="about-stat__label descr title-5">
										<?php echo esc_html($stat['about_stat_label']) ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php if ($image): ?>
		<div class="about__image image-box section-bg jarallax-img">
			<?php echo wp_get_attachment_image(
				$image['ID'],
				'large',
				false,
				array(
					'class' => 'img hidden-tablet',
					'alt' => $image['alt'] ?: ''
				)
			); ?>
			<?php echo wp_get_attachment_image(
				$image_mobile['ID'],
				'large',
				false,
				array(
					'class' => 'img visible-tablet',
					'alt' => $image_mobile['alt'] ?: ''
				)
			); ?>
		</div>
	<?php endif; ?>
</section>