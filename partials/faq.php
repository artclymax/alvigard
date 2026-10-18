<?php
$page = 'option';

$title = get_field('faq_title', $page);
$items = get_field('faq_items', $page) ?? [];
?>
<section class="section faq" id="faq">
	<div class="container faq__container">
		<?php if ($title): ?>
			<div class="section-header">
				<h2 class="section-header__title title-2"><?= esc_html($title) ?></h2>
			</div>
		<?php endif; ?>

		<?php if ($items): ?>
			<ul class="faq__list">
				<?php foreach ($items as $item): ?>
					<li class="faq__item spoiler">
						<?php if (!empty($item['faq_item_question'])): ?>
							<button class="spoiler__btn title-3">
								<span class="spoiler__btn-text"><?= esc_html($item['faq_item_question']) ?></span>
								<span class="spoiler__icon"></span>
							</button>
						<?php endif; ?>
						<?php if (!empty($item['faq_item_answer'])): ?>
							<div class="spoiler__body descr">
								<?= wp_kses_post($item['faq_item_answer']) ?>
							</div>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</section>
