<?php

create_fields_new(
	'flds-single-catalog',
	'Галерея каталога',
	'catalog',
	[
		add_field_gallery(
			'catalog_gallery',
		 'Галерея изображений',
			'Загрузите изображения для элемента каталога'
		),
	],
	'post_type'
);
