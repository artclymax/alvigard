<?php
$page = 'option';

$title = get_field('promotions_title', $page);
$descr = get_field('promotions_descr', $page);
$banner = get_field('promotions_banner', $page);
$items = get_field('promotions_items', $page) ?? [];
?>
<section class="section promotions" id="promotions">
	<div class="container promotions__container">
		<?php if ($title || $descr): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
		<?php endif; ?>

		<div class="promotions__grid">
			<?php if ($banner): ?>
				<div class="promotions__big promotions-big">
					<div class="promotions-big__content">
						<?php if ($banner_logo = $banner['promotions_banner_logo']): ?>
							<?php echo wp_get_attachment_image(
								$banner_logo['ID'],
								'large',
								false,
								array(
									'class' => 'img',
									'alt' => $banner_logo['alt'] ?: ''
								)
							); ?>
						<?php endif; ?>
						<?php if ($banner_title = $banner['promotions_banner_title']): ?>
							<h3 class="promotions-big__title title-2">
								<?php echo esc_html($banner_title) ?>
							</h3>
						<?php endif; ?>
						<?php if ($banner_logo_2 = $banner['promotions_banner_logo_2']): ?>
							<?php echo wp_get_attachment_image(
								$banner_logo_2['ID'],
								'large',
								false,
								array(
									'class' => 'img',
									'alt' => $banner_logo_2['alt'] ?: ''
								)
							); ?>
						<?php endif; ?>
						<?php if ($banner_descr = $banner['promotions_banner_descr']): ?>
							<div class="promotions-big__descr descr">
								<?php echo wp_kses_post($banner_descr) ?>
							</div>
						<?php endif; ?>
						<?php if ($banner_link = $banner['promotions_banner_link']): ?>
							<a class="promotions-big__btn btn" href="<?php echo esc_attr($banner_link['url']) ?>">
								<?php echo esc_html($banner_link['title']) ?>
							</a>
						<?php endif; ?>
					</div>
					<div class="promotions-big__image image-box section-bg" aria-hidden="true">
						<?php echo wp_get_attachment_image(
							$banner['promotions_banner_image']['ID'],
							'large',
							false,
							array(
								'class' => '',
								'alt' => $banner['promotions_banner_image']['alt'] ?: ''
							)
						); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($items):
				foreach ($items as $item): ?>
					<div class="promotions__item promotion-item">
						<h3 class="promotion-item__title title-3">
							<?php echo esc_html($item['promotions_items_title'])?>
						</h3>
						<div class="promotion-item__descr descr">
							<?php echo wp_kses_post($item['promotions_items_descr'])?>
						</div>
					</div>
				<?php endforeach;
			endif; ?>
		</div>
	</div>
</section>