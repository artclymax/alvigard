<?php
$page = 'option';

$title = get_field('projects_title', $page) ?? '';
$descr = get_field('projects_descr', $page) ?? '';
$btn = get_field('projects_btn', $page);
$args = [
	'post_type' => 'projects',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
];

$query = new WP_Query($args);
$posts = [];
if ($query->have_posts()):
	while ($query->have_posts()):
		$query->the_post();

		$posts[] = [
			'title' => get_the_title(),
			'content' => get_the_content(),
			'img' => get_the_post_thumbnail_url(null, 'large') ?: '',
		];
	endwhile;
	wp_reset_postdata();
endif;

$chunks = array_chunk($posts, 5);
?>

<section class="projects" id="projects">
	<div class="container projects__container">
		<?php get_template_part('partials/section-header', null, [
			'title' => $title,
			'descr' => $descr
		]); ?>
		<div class="projects__slider-wrapper">
			<div class="swiper projects-swiper hidden-mobile"
				data-swiper="{'slidesPerView': 1, 'spaceBetween': 24, 'rewind': true }">
				<div class="swiper-wrapper projects-swiper__wrapper">
					<?php foreach ($chunks as $chunk): ?>
						<div class="swiper-slide projects-slide">
							<div class="projects-slide__grid">
								<?php foreach ($chunk as $item): ?>
									<a class="projects-slide__item" data-fancybox href="<?php echo esc_url($item['img']); ?>">
										<div class="projects-slide__image image-box section-bg">
											<img src="<?php echo esc_url($item['img']); ?>"
												alt="<?php echo esc_attr($item['title']); ?>">
										</div>
										<div class="projects-slide__content">
											<h3 class="projects-slide__title ">
												<?php echo esc_html($item['title']); ?>
											</h3>
											<div class="projects-slide__descr descr">
												<?php echo wp_kses_post($item['content']); ?>
											</div>
										</div>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
			<div class="projects__btn-box swiper-btn-box hidden-mobile">
				<button class="swiper-btn swiper-btn__prev projects-swiper__btn projects-swiper__btn-prev" type="button"
					aria-label="Назад" data-swiper-btn-prev=".projects-swiper">
				</button>
				<button class="swiper-btn swiper-btn__next projects-swiper__btn projects-swiper__btn-next" type="button"
					aria-label="Вперёд" data-swiper-btn-next=".projects-swiper">
				</button>
			</div>
			<div class="swiper projects-swiper-mobile visible-mobile"
				data-swiper="{'slidesPerView': 1, 'spaceBetween': 24, 'rewind': true }">
				<div class="swiper-wrapper projects-swiper__wrapper">
					<?php foreach ($posts as $item): ?>
						<div class="swiper-slide projects-slide">
							<a class="projects-slide__item" data-fancybox href="<?php echo esc_url($item['img']); ?>">
								<div class="projects-slide__image image-box section-bg">
									<img src="<?php echo esc_url($item['img']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
								</div>
								<div class="projects-slide__content">
									<h3 class="projects-slide__title ">
										<?php echo esc_html($item['title']); ?>
									</h3>
									<div class="projects-slide__descr descr">
										<?php echo wp_kses_post($item['content']); ?>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="projects__btn-box swiper-btn-box visible-mobile">
				<button class="swiper-btn swiper-btn__prev projects-swiper__btn projects-swiper__btn-prev" type="button"
					aria-label="Назад" data-swiper-btn-prev=".projects-swiper-mobile">
				</button>
				<button class="swiper-btn swiper-btn__next projects-swiper__btn projects-swiper__btn-next" type="button"
					aria-label="Вперёд" data-swiper-btn-next=".projects-swiper-mobile">
				</button>
			</div>
		</div>
		<?php if ($btn && !empty($btn['url'])): ?>
			<a class="projects__btn btn" href="<?php echo esc_url($btn['url']) ?>">
				<?php echo esc_html($btn['title']) ?>
			</a>
		<?php endif; ?>
	</div>
</section>