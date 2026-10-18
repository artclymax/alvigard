<?php


create_fields_new(
	'flds-single-projects',
	'Дополнительная информация',
	'projects',
	[
		add_field_text(
			'single_projects_square',
			'Площадь',
		),
		add_field_text(
			'single_projects_year',
			'Год',
		),
	],
	'post_type'
);
