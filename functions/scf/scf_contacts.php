<?php

create_options_page(
	'Контактные данные',
	'opt-contacts'
);

create_fields(
	'Контактные данные',
	'opt-contacts',
	[
		add_field_tab(
			'contacts_tab_address',
			'Адрес',
		),
		add_field_redactor_wysiwyg(
			'contacts_address',
			'Адрес',
		),
		add_field_tab(
			'contacts_tab_time',
			'Время работы',
		),
		add_field_redactor_wysiwyg(
			'contacts_time',
			'Время работы',
		),
		add_field_tab(
			'contacts_tab_phones',
			'Телефон',
		),
		add_field_repeater(
			'contacts_phones',
			'Телефон',
			[
				add_field_text(
					'contacts_phones_phone',
					'Номер'
				)
			],
			'Первый номер будет отображаться в шапке',
		),
		add_field_tab(
			'contacts_tab_emails',
			'Email',
		),
		add_field_repeater(
			'contacts_emails',
			'Email',
			[
				add_field_text(
					'contacts_emails_email',
					'Email'
				)
			]
		),
		add_field_tab(
			'contacts_tab_messengers',
			'Мессенджеры и соцсети',
		),
		add_field_repeater(
			'contacts_messengers',
			'Мессенджеры',
			[
				add_field_image(
					'contacts_messengers_image',
					'Иконка'
				),
				add_field_text(
					'contacts_messengers_link',
					'Ссылка'
				),
			]
		),

	]
);