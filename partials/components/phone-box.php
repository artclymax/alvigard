<?php
$phones = get_field('contacts_phones', 'option') ?? '';

if ($phones): ?>
	<div class="phone-box">
		<?php foreach ($phones as $phone):
			$number = correct_phone($phone['contacts_phones_phone']);
			?>
			<div class="phone-box__item">
				<?php if ($phone['contacts_phones_messengers']): ?>
					<div class="phone-box__messengers">
						<?php
						foreach ($phone['contacts_phones_messengers'] as $messenger):
							if ($messenger == 'whatsapp') {
								$url = 'https://wa.me/' . $number;
								$icon = get_template_directory_uri() . '/assets/images/icons/wh.svg';
							} elseif ($messenger == 'telegram') {
								$url = 'https://t.me/+' . $number;
								$icon = get_template_directory_uri() . '/assets/images/icons/tg.svg';
							} elseif ($messenger == 'viber') {
								$url = 'viber://chat?number=' . $number;
								$icon = get_template_directory_uri() . '/assets/images/icons/viber.svg';
							}
							?>
							<a class="phone-box__link-icon link-icon" href="<?= esc_attr($url) ?>" arial-label="<?= esc_attr($messenger) ?>">
								<img src="<?= esc_url($icon) ?>" alt="">
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<a class="link phone-box__link" href="tel:+<?= esc_attr($number) ?>">
					<?= esc_html($phone['contacts_phones_phone']) ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>