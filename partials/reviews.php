<?php
$page = 'option';

$title = get_field('reviews_title', $page) ?? '';
$descr = get_field('reviews_descr', $page) ?? '';
$btn = get_field('reviews_btn', $page);
$args = [
	'post_type' => 'reviews',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
];

$query = new WP_Query($args);
?>
<section class="section reviews" id="reviews">
	<div class="container reviews__container">
		<?php get_template_part('partials/section-header', null, [
			'title' => $title,
			'descr' => $descr
		]); ?>
		<div class="reviews__slider-wrapper">
			<div class="swiper reviews-swiper"
				data-swiper="{'slidesPerView': 1, 'spaceBetween': 20, 'rewind': true, 'breakpoints': {'768': {'slidesPerView': 2}, '1024': {'slidesPerView': 3}} }">
				<div class="swiper-wrapper reviews-swiper__wrapper">
					<?php
					if ($query->have_posts()):
						while ($query->have_posts()):
							$query->the_post();
							?>

							<div class="swiper-slide reviews-slide">
								<div class="reviews-slide__wrapper">
									<div class="reviews-slide__image image-box">
										<?php the_post_thumbnail() ?>
									</div>
									<div class="reviews-slide__content">
										<div class="reviews-slide__header">
											<h3 class="reviews-slide__title">
												<?php the_title() ?>
											</h3>
											<div class="reviews-slide__rating">
												<?php
												$rating = round(get_field('reviews_rating')) ?: 5;
												$index = 1;
												while ($rating >= $index) {
													echo '<span class="icon-star"></span>';
													$index++;
												} ?>
											</div>
										</div>
										<?php if ($city = get_field('reviews_city') ?? ''): ?>
											<div class="reviews-slide__city">
												<?php echo esc_html($city); ?>
											</div>
										<?php endif; ?>
										<div class="reviews-slide__descr descr">
											<?php the_content(); ?>
										</div>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>

			</div>
			<div class="reviews__btn-box swiper-btn-box">
				<button class="swiper-btn swiper-btn__prev reviews-swiper__btn reviews-swiper__btn-prev" type="button"
					aria-label="Назад" data-swiper-btn-prev=".reviews-swiper">
				</button>
				<button class="swiper-btn swiper-btn__next reviews-swiper__btn reviews-swiper__btn-next" type="button"
					aria-label="Вперёд" data-swiper-btn-next=".reviews-swiper">
				</button>
			</div>
		</div>
	</div>
</section>