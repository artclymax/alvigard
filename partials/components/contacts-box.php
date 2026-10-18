<?php

$page = 'option';
$phones = get_field('contacts_phones', $page) ?? [];
$messengers = get_field('contacts_messengers', $page) ?? [];
$emails = get_field('contacts_emails', $page) ?? [];
$address = get_field('contacts_address', $page);
$time = get_field('contacts_time', $page);

$class = $args['class'] ?? '';
$is_footer = $args['is_footer'] ?? 0;

?>
<ul class="contacts-box <?= esc_attr($class) ?>">
	<?php if ($phones): ?>
		<li class="contacts-box__item">
			<ul class="contacts-box__list">
				<?php foreach ($phones as $item): ?>
					<li class="contacts-box__sub-item icon icon--phone">
						<a class="contacts-box__link link"
							href="tel:+<?= esc_attr(correct_phone($item['contacts_phones_phone'])) ?>">
							<?php echo esc_html($item['contacts_phones_phone']) ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	<?php endif; ?>
	<?php if ($messengers): ?>
		<li class="contacts-box__item">
			<ul class="contacts-box__messengers messengers">
				<?php foreach ($messengers as $item): ?>
					<li class="messengers__item">
						<a class="messengers__link link-icon" href="<?php echo esc_attr($item['contacts_messengers_link']) ?>"
							aria-label="Перейти в мессенджер / соцсеть">
							<?php echo wp_get_attachment_image(
								$item['contacts_messengers_image']['ID'],
								'large',
								false,
								array(
									'class' => 'img',
									'alt' => $item['contacts_messengers_image']['alt'] ?: ''
								)
							); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	<?php endif; ?>
	<?php if ($emails): ?>
		<li class="contacts-box__item">
			<ul class="contacts-box__list">
				<?php foreach ($emails as $item): ?>
					<li class="contacts-box__sub-item icon icon--email">
						<a class="contacts-box__link link"
							href="tel:+<?= esc_attr(correct_phone($item['contacts_emails_email'])) ?>">
							<?php echo esc_html($item['contacts_emails_email']) ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	<?php endif; ?>
	<?php if (!$is_footer): ?>
		<?php if ($address): ?>
			<li class="contacts-box__item icon icon--address">
				<address class="contacts-box__address descr">
					<?php echo wp_kses_post($address) ?>
				</address>
			</li>
		<?php endif; ?>
		<?php if ($time || $is_footer): ?>
			<li class="contacts-box__item icon icon--time">
				<div class="contacts-box__time descr">
					<?php echo wp_kses_post($time) ?>
				</div>
			</li>
		<?php endif; ?>
	<?php endif; ?>
</ul>