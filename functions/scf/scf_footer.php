<?php

create_options_page(
	'Подвал / Футер',
	'opt-footer'
);

create_fields(
	'Подвал / Футер',
	'opt-footer',
	[
		add_field_hint(
			'footer_hint',
			'<b>Логотип</b> — Настройки сайта > Основные настройки > Логотип сайта.<br/>
			<b>Меню</b> — Внешний вид > Меню > «Меню футера».<br/>
			<b>Контакты</b> — Настройки сайта > Контактные данные.',
		),
		add_field_text(
			'footer_copy',
			'Название компании / Копирайт',
		),
		add_field_tab(
			'footer_tab_bottom_links',
			'Нижние ссылки',
		),
		add_field_repeater(
			'footer_bottom_links',
			'Ссылки',
			[
				add_field_link(
					'footer_bottom_link',
					'Ссылка',
				),
			],
			null,
			['layout' => 'block']
		),
	]
);