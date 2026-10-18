<?php

create_fields_new(
	'flds-services-card',
	'Данные карточки услуги',
	'services',
	[
		add_field_repeater(
			'services_card_tags',
			'Теги',
			[
				add_field_text(
					'services_card_tags_text',
					'Текст тега',
				),
			]
		),
	],
	'post_type',
);
