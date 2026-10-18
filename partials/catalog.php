<?php
$page = 'option';

$title = get_field('catalog_title', $page);
$descr = get_field('catalog_descr', $page);
$btn = get_field('catalog_btn', $page) ?? [];

$args = [
	'post_type' => 'catalog',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
];

$query = new WP_Query($args);
?>




<section class="section catalog" id="catalog">
	<div class="container catalog__container">
		<?php if ($title || $descr): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
		<?php endif; ?>

		<?php if ($query->have_posts()): ?>
			<ul class="catalog__list grid">
				<?php while ($query->have_posts()):
					$query->the_post(); ?>
					<?php
					$gallery = get_field('catalog_gallery');
					$image_id = get_post_thumbnail_id();
					$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
					$custom_title = get_field('catalog_item_title') ?: get_the_title();
					$permalink = get_the_post_thumbnail_url();

					// Первое изображение для превью
					$preview_image_id = $image_id;
					$preview_image_alt = $image_alt;
					if ($gallery && is_array($gallery) && count($gallery) > 0) {
						$preview_image_id = $gallery[0]['ID'];
						$preview_image_alt = $gallery[0]['alt'] ?: '';
					}
					?>
					<li class="catalog__item catalog-item">
						<?php if ($gallery && is_array($gallery) && count($gallery) > 0): ?>
							<a class="catalog-item__link image-box-icon" href="<?= esc_url($permalink) ?>"
								data-fancybox="gallery-<?= get_the_ID() ?>">
								<?php if ($preview_image_id): ?>
									<div class="catalog-item__image image-box">
										<?php echo wp_get_attachment_image(
											$preview_image_id,
											'medium_large',
											false,
											['class' => 'img', 'alt' => esc_attr($preview_image_alt)]
										); ?>
									</div>
								<?php endif; ?>
								<?php if ($custom_title): ?>
									<h3 class="catalog-item__title title-3"><?= esc_html($custom_title) ?></h3>
								<?php endif; ?>
							</a>
							<?php foreach ($gallery as $image): ?>
								<a class="hidden" href="<?= esc_url($image['url']) ?>" data-fancybox="gallery-<?= get_the_ID() ?>"
									data-caption="<?= esc_attr($image['caption'] ?: $custom_title) ?>">
									<img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt'] ?: $custom_title) ?>"
										style="display: none;">
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<a class="catalog-item__link image-box-icon" href="<?= esc_url($permalink) ?>" data-fancybox>
								<?php if ($preview_image_id): ?>
									<div class="catalog-item__image image-box">
										<?php echo wp_get_attachment_image(
											$preview_image_id,
											'medium_large',
											false,
											['class' => 'img', 'alt' => esc_attr($preview_image_alt)]
										); ?>
									</div>
								<?php endif; ?>
								<?php if ($custom_title): ?>
									<h3 class="catalog-item__title title-5"><?= esc_html($custom_title) ?></h3>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		<?php endif; ?>

		<?php if ($btn): ?>
			<a class="catalog__btn btn" href="<?= esc_url($btn['url']) ?>">
				<?= esc_html($btn['title']) ?>
			</a>
		<?php endif; ?>
	</div>
</section>