<?php
$page = 'option';

$title = get_field('price_title', $page);
$descr = get_field('price_descr', $page);
$items = get_field('price_items', $page) ?? [];
$footer_descr = get_field('price_footer_descr', $page);
$decor = get_template_directory_uri() . '/assets/images/decor-price-card.webp';

?>
<section class="section price" id="price">
	<div class="container price__container">
		<?php if ($title || $descr): ?>
			<?php get_template_part('partials/section-header', null, [
				'title' => $title,
				'descr' => $descr
			]); ?>
		<?php endif; ?>

		<?php if ($items): ?>
			<ul class="price__list grid">
				<?php foreach ($items as $item): ?>
					<li class="price__item price-item <?= $item['price_item_accent'] ? 'accent-price' : '' ?>"
						style="background-image: url('<?= $decor ?>');">
						<?php if (!empty($item['price_item_title'])): ?>
							<h3 class="price-item__title title-1"><?= esc_html($item['price_item_title']) ?></h3>
						<?php endif; ?>
						<?php if (!empty($item['price_item_subtitle'])): ?>
							<p class="price-item__subtitle"><?= esc_html($item['price_item_subtitle']) ?></p>
						<?php endif; ?>
						<?php if (!empty($item['price_item_price'])): ?>
							<p class="price-item__price title-4"><?= esc_html($item['price_item_price']) ?></p>
						<?php endif; ?>
						<?php if (!empty($item['price_item_image'])): ?>
							<div class="price-item__image image-box">
								<?php echo wp_get_attachment_image(
									$item['price_item_image']['ID'],
									'medium_large',
									false,
									['class' => 'img', 'alt' => $item['price_item_image']['alt'] ?: '']
								); ?>
							</div>
						<?php endif; ?>
						<?php if (!empty($item['price_item_descr'])): ?>
							<div class="price-item__descr descr"><?= wp_kses_post($item['price_item_descr']) ?></div>
						<?php endif; ?>
						<?php if (!empty($item['price_item_btn'])): ?>
							<a class="price-item__btn btn" href="<?= esc_url($item['price_item_btn']['url']) ?>">
								<?= esc_html($item['price_item_btn']['title']) ?>
							</a>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ($footer_descr): ?>
			<div class="price__descr descr title-5"><?= wp_kses_post($footer_descr) ?></div>
		<?php endif; ?>
	</div>
</section>