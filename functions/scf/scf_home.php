<?php

create_options_page(
	'Главная',
	'opt-home'
);

create_options_page(
	'Первый экран',
	'opt-hero',
	'opt-home'
);

create_fields_new(
	'flds-hero',
	'Первый экран',
	['opt-hero', 'opt-home'],
	[
		add_field_tab('hero_tab_content', 'Основной контент'),
		add_field_text('hero_title', 'Заголовок', null, 'Кухни ЗОВ Малиновка'),
		add_field_redactor_wysiwyg('hero_descr', 'Описание', null, '<p>Изготовим кухню под размеры вашего помещения, подберём материалы и фурнитуру, подготовим 3D-проект и выполним монтаж.</p>'),
		add_field_link('hero_btn', 'Кнопка'),
		add_field_link('hero_btn_stroke', 'Кнопка вторая'),
		add_field_image('hero_image', 'Фоновое изображение (десктоп)'),
		add_field_image('hero_image_mobile', 'Фоновое изображение (мобильное)'),
		add_field_repeater(
			'hero_list',
			'Список преимуществ',
			[
				add_field_image('hero_list_image', 'Иконка'),
				add_field_text('hero_list_title', 'Заголовок'),
			],
			null,
			['layout' => 'block', 'collapse' => 'hero_list_title']
		),
	]
);

create_options_page(
	'Каталог кухонь',
	'opt-catalog',
	'opt-home'
);

create_fields_new(
	'flds-catalog',
	'Каталог кухонь',
	['opt-catalog', 'opt-home'],
	[
		add_field_text('catalog_title', 'Заголовок', null, 'Каталог кухонь от производителя ЗОВ'),
		add_field_redactor_wysiwyg('catalog_descr', 'Описание'),
		add_field_hint(
			'catalog_cpt_notice',
			'Элементы каталога создаются через раздел <strong>Каталог</strong> в админке. Каждый элемент поддерживает галерею изображений.',
			'Информация'
		),
		add_field_link('catalog_btn', 'Кнопка'),
	]
);


create_options_page(
	'Стоимость',
	'opt-price',
	'opt-home'
);

create_fields_new(
	'flds-price',
	'Стоимость',
	['opt-price', 'opt-home'],
	[
		add_field_text('price_title', 'Заголовок', null, 'Ориентировочная стоимость кухонь'),
		add_field_redactor_wysiwyg('price_descr', 'Описание'),
		add_field_repeater(
			'price_items',
			'Тарифы',
			[
				add_field_toggle('price_item_accent', 'Акцентная цена', false),
				add_field_text('price_item_title', 'Название тарифа'),
				add_field_text('price_item_subtitle', 'Подзаголовок'),
				add_field_text('price_item_price', 'Цена'),
				add_field_image('price_item_image', 'Изображение'),
				add_field_redactor_wysiwyg('price_item_descr', 'Описание'),
				add_field_link('price_item_btn', 'Кнопка'),
			],
			null,
			['layout' => 'block', 'collapse' => 'price_item_title']
		),
		add_field_redactor_wysiwyg('price_footer_descr', 'Описание под списком'),
	]
);

create_options_page(
	'Акции',
	'opt-promotions',
	'opt-home'
);

create_fields_new(
	'flds-promotions',
	'Акции и специальные предложения',
	['opt-promotions', 'opt-home'],
	[
		add_field_text('promotions_title', 'Заголовок', null, 'Акции и специальные предложения'),
		add_field_redactor_wysiwyg('promotions_descr', 'Описание'),
		add_field_group(
			'promotions_banner',
			'Баннер',
			[
				add_field_image('promotions_banner_logo', 'Логотип 1'),
				add_field_text('promotions_banner_title', 'Заголовок баннера'),
				add_field_image('promotions_banner_logo_2', 'Логотип 2'),
				add_field_redactor_wysiwyg('promotions_banner_descr', 'Описание баннера'),
				add_field_link('promotions_banner_link', 'Ссылка баннера'),
				add_field_image('promotions_banner_image', 'Фоновое изображение баннера'),
			]
		),
		add_field_repeater(
			'promotions_items',
			'Акции',
			[
				add_field_text('promotions_items_title', 'Заголовок'),
				add_field_redactor_wysiwyg('promotions_items_descr', 'Описание'),
			],
			null,
			['layout' => 'block', 'collapse' => 'promotions_items_title']
		),
	]
);

create_options_page(
	'Этапы заказа',
	'opt-steps',
	'opt-home'
);

create_fields_new(
	'flds-steps',
	'Как происходит заказ',
	['opt-steps', 'opt-home'],
	[
		add_field_text('steps_title', 'Заголовок', null, 'Как происходит заказ кухни'),
		add_field_redactor_wysiwyg('steps_descr', 'Описание'),
		add_field_repeater(
			'steps_items',
			'Этапы',
			[
				add_field_image('steps_item_image', 'Изображение'),
				add_field_text('steps_item_title', 'Заголовок'),
				add_field_redactor_wysiwyg('steps_item_descr', 'Описание'),
			],
			null,
			['layout' => 'block', 'collapse' => 'steps_item_title']
		),
		add_field_image('steps_image', 'Фоновое изображение секции'),
	]
);

create_options_page(
	'Проекты',
	'opt-projects',
	'opt-home'
);

create_fields_new(
	'flds-projects',
	'Проекты',
	['opt-projects', 'opt-home'],
	[
		add_field_text('projects_title', 'Заголовок', null, 'Наши проекты'),
		add_field_redactor_wysiwyg('projects_descr', 'Описание'),
		add_field_link('projects_btn', 'Кнопка'),
		add_field_hint(
			'projects_cpt_notice',
			'Элементы проектов создаются через раздел <strong>Проекты</strong> в админке. Обязательно задайте изображение записи (миниатюру) для каждого элемента.',
			'Информация'
		),
	]
);

create_options_page(
	'Форма',
	'opt-form',
	'opt-home'
);

create_fields_new(
	'flds-form',
	'Форма обратной связи',
	['opt-form', 'opt-home'],
	[
		add_field_text('form_title', 'Заголовок'),
		add_field_redactor_wysiwyg('form_descr', 'Описание'),
		add_field_redactor_wysiwyg('form_content_descr', 'Дополнительное описание'),
		add_field_text('form_shortcode', 'Шорткод формы'),
		add_field_image('form_image', 'Фоновое изображение секции'),
	]
);
create_options_page(
	'Почему мы',
	'opt-why-us',
	'opt-home'
);

create_fields_new(
	'flds-why-us',
	'Почему выбирают нас',
	['opt-why-us', 'opt-home'],
	[
		add_field_text('why_us_title', 'Заголовок'),
		add_field_redactor_wysiwyg('why_us_descr', 'Описание'),
		add_field_repeater(
			'why_us_items',
			'Преимущества',
			[
				add_field_image('why_us_list_image', 'Иконка'),
				add_field_text('why_us_list_title', 'Заголовок'),
				add_field_redactor_wysiwyg('why_us_list_descr', 'Описание'),
			],
			null,
			['layout' => 'block', 'collapse' => 'why_us_list_title']
		),
		add_field_gallery(
			'why_us_gallery',
			'Галерея',
		),
		add_field_image('why_us_image', 'Фоновое изображение секции'),
	]
);


create_options_page(
	'Отзывы',
	'opt-reviews',
	'opt-home'
);

create_fields_new(
	'flds-reviews',
	'Отзывы клиентов',
	['opt-reviews', 'opt-home'],
	[
		add_field_text('reviews_title', 'Заголовок', null, 'Отзывы наших клиентов'),
		add_field_redactor_wysiwyg('reviews_descr', 'Описание'),
		add_field_hint(
			'reviews_cpt_notice',
			'Элементы отзывов создаются через раздел <strong>Отзывы</strong> в админке. Обязательно задайте изображение записи (миниатюру) для каждого отзыва. В контенте отзыва можно использовать текст и дополнительные поля: рейтинг и город.',
			'Информация'
		),
	]
);


create_options_page(
	'Контакты',
	'opt-contacts-home',
	'opt-home'
);

create_fields_new(
	'flds-contacts',
	'Секция контактов',
	['opt-contacts-home', 'opt-home'],
	[
		add_field_text('contacts_section_title', 'Заголовок', null, 'Готовы обсудить вашу кухню?'),
		add_field_redactor_wysiwyg('contacts_section_descr', 'Описание'),
		add_field_hint(
			'contacts_section_notice',
			'Контактные данные (телефоны, адрес, время работы, мессенджеры) задаются в разделе <strong>Контактные данные</strong>.',
			'Информация'
		),
		add_field_text('contacts_section_form_shortcode', 'Шорткод формы (CF7)'),
		add_field_textarea('contacts_section_map', 'Карта (iframe код)', null, null, false, ['rows' => 5]),
	]
);


create_options_page(
	'О компании',
	'opt-about',
	'opt-home'
);

create_fields_new(
	'flds-about',
	'О компании',
	['opt-about', 'opt-home'],
	[
		add_field_text('about_title', 'Заголовок', null, 'О компании АЛВИгард'),
		add_field_redactor_wysiwyg('about_descr', 'Описание'),
		add_field_repeater(
			'about_stats',
			'Статистика / преимущества',
			[
				add_field_text('about_stat_value', 'Значение'),
				add_field_text('about_stat_label', 'Подпись'),
			],
			null,
			['layout' => 'block', 'collapse' => 'about_stat_value']
		),
		add_field_image('about_image', 'Фоновое изображение секции'),
		add_field_image('about_image_mobile', 'Фоновое изображение мобильная версия'),
	]
);