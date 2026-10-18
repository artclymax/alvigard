<?php
add_action('init', function () {
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => 'Портфолио',
			'singular_name' => 'Проект',
			'menu_name' => 'Портфолио',
			'name_admin_bar' => 'Проект',
			'add_new' => 'Добавить проект',
			'add_new_item' => 'Добавить новый проект',
			'new_item' => 'Новый проект',
			'edit_item' => 'Редактировать проект',
			'view_item' => 'Посмотреть проект',
			'all_items' => 'Все проекты',
			'search_items' => 'Поиск проектов',
			'not_found' => 'Проекты не найдены',
			'not_found_in_trash' => 'Проекты не найдены в корзине',
		),
		'menu_icon' => 'dashicons-portfolio',
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => [
			'slug' => 'portfolio',
			'with_front' => false,
			'pages' => true,
			'feeds' => true
		],
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 5,
		'supports' => array('title', 'thumbnail', 'custom-fields', 'page-attributes'),
		'show_in_rest' => false,
	));
});

register_taxonomy('portfolio_category', ['portfolio'], [
	'labels' => [
		'name' => 'Категории портфолио',
		'singular_name' => 'Категория',
		'search_items' => 'Поиск категорий',
		'all_items' => 'Все категории',
		'edit_item' => 'Редактировать категорию',
		'update_item' => 'Обновить категорию',
		'add_new_item' => 'Добавить категорию',
		'new_item_name' => 'Название категории',
		'menu_name' => 'Категории',
	],
	'hierarchical' => true,
	'show_admin_column' => true,
	'show_in_rest' => true,
	'rewrite' => [
		'slug' => 'portfolio_category'
	],
]);

add_action('init', function () {
	register_post_type('reviews', array(
		'labels' => array(
			'name' => 'Отзывы',
			'singular_name' => 'Отзыв',
			'menu_name' => 'Отзывы',
			'name_admin_bar' => 'Отзыв',
			'add_new' => 'Добавить отзыв',
			'add_new_item' => 'Добавить новый отзыв',
			'new_item' => 'Новый отзыв',
			'edit_item' => 'Редактировать отзыв',
			'view_item' => 'Посмотреть отзыв',
			'all_items' => 'Все отзывы',
			'search_items' => 'Поиск отзывов',
			'not_found' => 'Отзывы не найдены',
			'not_found_in_trash' => 'Отзывы не найдены в корзине',
		),
		'menu_icon' => 'dashicons-format-chat',
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => [
			'slug' => 'reviews',
			'with_front' => false,
			'pages' => true,
			'feeds' => true
		],
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 6,
		'supports' => array('title', 'thumbnail', 'editor', 'custom-fields'),
		'show_in_rest' => false,
	));
});

add_action('init', function () {
	register_post_type('catalog', array(
		'labels' => array(
			'name' => 'Каталог',
			'singular_name' => 'Элемент каталога',
			'menu_name' => 'Каталог',
			'name_admin_bar' => 'Элемент каталога',
			'add_new' => 'Добавить элемент',
			'add_new_item' => 'Добавить новый элемент',
			'new_item' => 'Новый элемент',
			'edit_item' => 'Редактировать элемент',
			'view_item' => 'Посмотреть элемент',
			'all_items' => 'Все элементы',
			'search_items' => 'Поиск элементов',
			'not_found' => 'Элементы не найдены',
			'not_found_in_trash' => 'Элементы не найдены в корзине',
		),
		'menu_icon' => 'dashicons-store',
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => [
			'slug' => 'catalog',
			'with_front' => false,
			'pages' => true,
			'feeds' => true
		],
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 7,
		'supports' => array('title', 'thumbnail', 'custom-fields', 'page-attributes'),
		'show_in_rest' => false,
	));
});

add_action('init', function () {
	register_post_type('projects', array(
		'labels' => array(
			'name' => 'Проекты',
			'singular_name' => 'Проект',
			'menu_name' => 'Проекты',
			'name_admin_bar' => 'Проект',
			'add_new' => 'Добавить проект',
			'add_new_item' => 'Добавить новый проект',
			'new_item' => 'Новый проект',
			'edit_item' => 'Редактировать проект',
			'view_item' => 'Посмотреть проект',
			'all_items' => 'Все проекты',
			'search_items' => 'Поиск проектов',
			'not_found' => 'Проекты не найдены',
			'not_found_in_trash' => 'Проекты не найдены в корзине',
		),
		'menu_icon' => 'dashicons-images-alt2',
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => [
			'slug' => 'projects',
			'with_front' => false,
			'pages' => true,
			'feeds' => true
		],
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 8,
		'supports' => array('title', 'thumbnail', 'editor', 'custom-fields', 'page-attributes'),
		'show_in_rest' => false,
	));
});
