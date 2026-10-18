<?php

create_fields_new(
	'flds-single-reviews',
	'Данные отзыва',
	'reviews',
	[
		add_field_text(
			'reviews_city',
			'Город',
		),
		add_field_select(
			'reviews_rating',
			'Рейтинг',
			[
				'1' => '1 звезда',
				'2' => '2 звезды',
				'3' => '3 звезды',
				'4' => '4 звезды',
				'5' => '5 звёзд',
			],
			'5'
		),
	],
	'post_type'
);
