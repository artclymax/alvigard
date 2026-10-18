<?php

create_options_page(
	'Модальное окно',
	'opt-modal'
);

create_fields(
	'Модальное окно',
	'opt-modal',
	[
		add_field_text(
			'modal_title',
			'Заголовок',
		),
		add_field_text('modal_shortcode', 'Шорткод формы (CF7)'),
		add_field_image(
			'modal_image',
			'Картинка',
		),
	]
);