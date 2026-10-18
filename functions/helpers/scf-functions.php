<?php
// ! Кнопки свернуть и развернуть повторитель
add_action('acf/input/admin_head', 'add_acf_collapse_buttons');
function add_acf_collapse_buttons()
{
	?>
	<script type="text/javascript">
		(function ($) {
			// Добавляем кнопки сворачивания
			acf.addAction('ready', function () {
				$('.acf-field-repeater').each(function () {
					var $field = $(this);
					var $label = $field.find('> .acf-label');
					var $repeater = $field.find('> .acf-input > .acf-repeater');

					// Проверяем, не добавлены ли уже кнопки
					if ($label.find('.acf-repeater-controls').length === 0) {
						// Создаем контейнер для кнопок
						var $controls = $('<div class="acf-repeater-controls"></div>');

						// Добавляем кнопки
						$controls.append('<a href="#" class="button button-small acf-expand-all">Развернуть все</a> ');
						$controls.append('<a href="#" class="button button-small acf-collapse-all">Свернуть все</a>');

						// Добавляем контейнер в label
						$label.append($controls);
					}
				});

				// Обработчик для сворачивания
				$(document).on('click', '.acf-collapse-all', function (e) {
					e.preventDefault();
					$(this).closest('.acf-field-repeater').find('.acf-row:not(.acf-clone)').addClass('-collapsed');
				});

				// Обработчик для разворачивания
				$(document).on('click', '.acf-expand-all', function (e) {
					e.preventDefault();
					$(this).closest('.acf-field-repeater').find('.acf-row:not(.acf-clone)').removeClass('-collapsed');
				});
			});
		})(jQuery);
	</script>
	<style>
		.acf-repeater-controls {
			display: inline-block;
			margin-right: 10px;
			vertical-align: middle;
		}

		.acf-repeater-controls .button {
			margin-right: 5px;
		}

		.acf-label>label {
			display: inline-block;
			vertical-align: middle;
		}
	</style>
	<?php
}

/**
 * create_options_page() — helper для ACF / SCF options pages
 *
 * Сигнатура:
 * create_options_page(
 *   string $page_title, // Заголовок страницы (и пункт меню)
 *   string $slug,       // Уникальный menu_slug (используется в location)
 *   array  $args = []   // Доп. аргументы ACF (необязательно)
 * );
 *
 * Минимальный пример:
 *
 * create_options_page('Настройки сайта', 'site-settings');
 *
 * Пример с доп. параметрами:
 *
 * create_options_page(
 *   'Хедер',
 *   'header-settings',
 *   [
 *     'menu_title' => 'Хедер',
 *     'parent_slug' => 'site-settings', // сделать дочерней страницей
 *     'capability' => 'manage_options',
 *     'position' => 20,
 *     'icon_url' => 'dashicons-admin-generic',
 *   ]
 * );
 *
 * Как привязать поля к options page:
 *
 * create_fields(
 *   'Поля хедера',
 *   'header-settings', // <-- menu_slug
 *   $fields
 * );
 *
 * Получение значений в шаблоне:
 *
 * get_field('field_name', 'option');
 * the_field('field_name', 'option');
 *
 * Важно:
 * - slug должен быть уникальным
 * - redirect = false → страница может иметь свои поля
 * - parent_slug позволяет строить иерархию меню
 */
function create_options_page(
	string $page_title,
	string $slug,
	?string $parent_slug = null,
	array $args = []
) {
	if (!function_exists('acf_add_options_page')) {
		return;
	}

	$defaults = [
		'page_title' => $page_title,
		'menu_title' => $page_title,
		'menu_slug' => $slug,
		'capability' => 'manage_options',
		'redirect' => false,
	];

	// если parent_slug передан — добавляем его в массив
	if ($parent_slug) {
		$defaults['parent_slug'] = $parent_slug;
	}

	acf_add_options_page(array_merge($defaults, $args));
}
/**
 * ACF / SCF location cheatsheet
 *
 * Привязка полей через create_fields():
 *
 * create_fields(
 *   $title,          // Заголовок группы полей в админке
 *   $location_value, // Значение условия (slug, ID, template)
 *   $fields,         // Массив полей ACF
 *   $location_param  // Тип привязки (см. ниже)
 * );
 *
 * Основные варианты $location_param:
 *
 * 'options_page'  => options page (value = menu_slug)
 * 'post_type'     => тип записи (value = 'post', 'page', 'cars')
 * 'page'          => конкретная страница (value = page ID)
 * 'post'          => конкретная запись (value = post ID)
 * 'page_template' => шаблон страницы (value = 'page-home.php')
 * 'taxonomy'      => таксономия (value = 'category', 'car_brand')
 * 'user_role'     => роль пользователя (value = 'administrator')
 *
 * Примеры:
 *
 * // Поля для options page
 * create_fields('Настройки сайта', 'site-settings', $fields);
 *
 * // Поля для всех записей CPT cars
 * create_fields('Автомобили', 'cars', $fields, 'post_type');
 *
 * // Поля для шаблона страницы
 * create_fields('Главная', 'page-home.php', $fields, 'page_template');
 *
 * // Поля для конкретной страницы
 * create_fields('Контакты', 42, $fields, 'page');
 */
function create_fields(
	string $title,
	string|array $location_value,
	array $fields,
	string $location_param = 'options_page',
	array $extra = []
) {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	$locations = is_array($location_value) ? $location_value : [$location_value];
	$location_rules = [];
	
	// Каждое правило в отдельном подмассиве = логика OR
	foreach ($locations as $loc) {
		$location_rules[] = [
			[
				'param' => $location_param,
				'operator' => '==',
				'value' => $loc,
			],
		];
	}

	acf_add_local_field_group(array_merge([
		'key' => 'group_' . sanitize_title(is_array($location_value) ? $location_value[0] : $location_value),
		'title' => $title,
		'fields' => $fields,
		'location' => $location_rules,
	], $extra));
}
function create_fields_new(
	string $key,
	string $title,
	string|array $location_value,
	array $fields,
	string $location_param = 'options_page',
	array $extra = []
) {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	$locations = is_array($location_value) ? $location_value : [$location_value];
	$location_rules = [];
	
	// Каждое правило в отдельном подмассиве = логика OR
	foreach ($locations as $loc) {
		$location_rules[] = [
			[
				'param' => $location_param,
				'operator' => '==',
				'value' => $loc,
			],
		];
	}

	acf_add_local_field_group(array_merge([
		'key' => 'group_' . $key,
		'title' => $title,
		'fields' => $fields,
		'location' => $location_rules,
	], $extra));
}
/*
create_fields(
	 'Поля — Почему с нами удобно',
	 'opt-why',
	 [
		  add_field_text(
				'why_title',
				'Заголовок',
				'Основной заголовок блока',
				'Почему с нами удобно',
				true
		  ),
	 ]
);
*/
function add_field_text(
	string $name,
	string $label,
	?string $instructions = null,
	?string $default_value = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'text',
		'instructions' => $instructions ?? '',
		'default_value' => $default_value,
		'required' => $required ? 1 : 0,
	], $extra);
}
function add_field_textarea(
	string $name,
	string $label,
	?string $instructions = null,
	?string $default_value = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'textarea',
		'instructions' => $instructions ?? '',
		'default_value' => $default_value,
		'required' => $required ? 1 : 0,
		'rows' => 4,
	], $extra);
}
function add_field_toggle(
	string $name,
	string $label,
	?string $instructions = null,
	bool $default_value = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'true_false',
		'instructions' => $instructions ?? '',
		'default_value' => $default_value ? 1 : 0,
		'ui' => 1,
	], $extra);
}
function add_field_image(
	string $name,
	string $label,
	?string $instructions = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'image',
		'instructions' => $instructions ?? '',
		'return_format' => 'array',
		'preview_size' => 'medium',
		'required' => $required ? 1 : 0,
	], $extra);
}
/*
add_field_repeater(
		'advantages',
		'Преимущества',
		[
				add_field_text('title', 'Заголовок'),
				add_field_textarea('text', 'Описание'),
		],
		null,
		[
				'collapse' => 'title',	 // <-- ключ sub-поля (name)
				'layout' => 'block',		 // <-- отображение
		]
);

*/
/*
, null,
[
'layout' => 'block',
'collapsed' => 'field_hero_slider_title',
]
*/
function add_field_repeater(
	string $name,
	string $label,
	array $sub_fields,
	?string $instructions = null,
	array $extra = []
): array {

	// layout: table | row | block
	$layout = $extra['layout'] ?? 'table';
	$collapse = $extra['collapse'] ?? null;

	unset($extra['layout'], $extra['collapse']);

	// Генерируем ключи простым способом (без uniqid)
	$repeater_key = 'field_' . $name;

	foreach ($sub_fields as $index => $field) {

		// Если ключ уже есть — не трогаем
		if (empty($field['key'])) {

			$sub_name = $field['name'] ?? 'sub_' . $index;

			// Простое создание ключа для совместимости
			$sub_fields[$index]['key'] = 'field_' . $name . '_' . $sub_name;
		}
	}

	// Собираем массив поля
	return array_merge([
		'key' => $repeater_key,
		'label' => $label,
		'name' => $name,
		'type' => 'repeater',
		'instructions' => $instructions ?? '',
		'button_label' => 'Добавить',
		'layout' => $layout,
		'sub_fields' => $sub_fields,
		'collapsed' => $collapse,
	], $extra);
}


function add_field_redactor_wysiwyg(
	string $name,
	string $label,
	?string $instructions = null,
	?string $default_value = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'wysiwyg',
		'instructions' => $instructions ?? '',
		'default_value' => $default_value,
		'required' => $required ? 1 : 0,

		// настройки редактора
		'tabs' => 'all',          // all | visual | text
		'toolbar' => 'full',      // full | basic
		'media_upload' => 1,      // разрешить загрузку медиа
		'delay' => 0,             // инициализировать сразу
	], $extra);
}

function add_field_link(
	string $name,
	string $label,
	?string $instructions = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'link',
		'instructions' => $instructions ?? '',
		'required' => $required ? 1 : 0,
	], $extra);
}
function add_field_file(
	string $name,
	string $label,
	?string $instructions = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'file',
		'instructions' => $instructions ?? '',
		'required' => $required ? 1 : 0,
		'return_format' => 'array', // array | url | id
		'library' => 'all', // all | uploadedTo
	], $extra);
}
function add_field_tab(
	string $name,
	string $label,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'tab',
	], $extra);
}
function add_field_checkbox(
	string $name,
	string $label,
	array $choices = [],
	?string $instructions = null,
	?array $default_value = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'checkbox',
		'instructions' => $instructions ?? '',
		'choices' => $choices,
		'default_value' => $default_value ?? [],
		'required' => $required ? 1 : 0,
	], $extra);
}
function add_field_hint(
	string $name,
	string $message,
	?string $label = null,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label ?? '',
		'name' => $name,
		'type' => 'message',
		'message' => $message,
		'new_lines' => 'wpautop', // wpautop | br | ''
		'esc_html' => 0, // 0 = можно HTML
	], $extra);
}
function add_field_group(
	string $name,
	string $label,
	array $sub_fields = [],
	?string $instructions = null,
	bool $required = false,
	array $extra = []
): array {

	// Префиксуем sub_fields key
	foreach ($sub_fields as &$field) {
		$field['key'] = 'field_' . $name . '_' . $field['name'];
	}

	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'group',
		'instructions' => $instructions ?? '',
		'required' => $required ? 1 : 0,
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	], $extra);
}

function add_field_gallery(
	string $name,
	string $label,
	?string $instructions = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'gallery',
		'instructions' => $instructions ?? '',
		'required' => $required ? 1 : 0,
		'return_format' => 'array',
		'preview_size' => 'medium',
		'insert' => 'append',
		'library' => 'all',
		'min' => '',
		'max' => '',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	], $extra);
}

function add_field_select(
	string $name,
	string $label,
	array $choices = [],
	?string $instructions = null,
	bool $required = false,
	array $extra = []
): array {

	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'select',
		'instructions' => $instructions ?? '',
		'required' => $required ? 1 : 0,
		'choices' => $choices,
		'default_value' => '',
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 1,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',
	], $extra);
}
/*
add_field_select(
	 'animal_type',
	 'Тип животного',
	 [
		  'cow' => 'Коровы',
		  'pig' => 'Свиньи',
		  'chicken' => 'Куры',
	 ],
	 null,
	 false,
	 [
		  'multiple' => 1,
		  'allow_null' => 1,
	 ]
);
*/
function add_field_oembed(
	string $name,
	string $label,
	?string $instructions = null,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'oembed',
		'instructions' => $instructions ?? '',
		'width' => '',
		'height' => '',
	], $extra);
}
function add_field_url(
	string $name,
	string $label,
	?string $instructions = null,
	?string $default_value = null,
	bool $required = false,
	array $extra = []
): array {
	return array_merge([
		'key' => 'field_' . $name,
		'label' => $label,
		'name' => $name,
		'type' => 'url',
		'instructions' => $instructions ?? '',
		'default_value' => $default_value,
		'required' => $required ? 1 : 0,
	], $extra);
}
/**
 * Конвертирует ссылку Яндекс.Карт или Google Maps в iframe-код.
 *
 * Поддерживаемые форматы:
 * - Google Maps: обычные ссылки (конвертирует /maps/ → /maps/embed?)
 * - Яндекс.Карты: shortened (/maps/-/XXX), org (/maps/org/...), search (/maps/?text=), widget (/maps/?ll=)
 * - Любые iframe: вставляет как есть
 *
 * @param string $url  Ссылка или iframe-код
 * @param string $width  Ширина iframe (по умолчанию 100%)
 * @param string $height Высота iframe (по умолчанию 450px)
 * @return string HTML iframe или пустая строка
 */
function convert_map_url_to_iframe(string $url, string $width = '100%', string $height = '450px'): string
{
	if (empty($url)) {
		return '';
	}

	// Если это уже iframe — вставляем как есть
	if (stripos($url, '<iframe') !== false) {
		return $url;
	}

	// Google Maps: конвертируем обычную ссылку в embed
	if (strpos($url, 'google.com/maps') !== false) {
		$embed_url = str_replace('/maps/', '/maps/embed?', $url);
		return '<iframe src="' . esc_url($embed_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
	}

	// Яндекс.Карты
	if (strpos($url, 'yandex.ru/maps') !== false || strpos($url, 'yandex.by/maps') !== false) {
		$embed_url = '';

		// Формат 1: shortened link (https://yandex.ru/maps/-/CDa~qYpA)
		// Конвертируем через map-constructor виджет
		if (preg_match('#yandex\.[a-z]+/maps/-/([A-Za-z0-9~]+)#', $url, $matches)) {
			$hash = $matches[1];
			$embed_url = 'https://yandex.ru/map-widget/v1/?um=constructor%3A' . urlencode($hash) . '&source=constructor';
		}
		// Формат 2: org page (https://yandex.ru/maps/org/name/123456789/)
		elseif (preg_match('#yandex\.[a-z]+/maps/org/[^/]+/(\d+)/?#', $url, $matches)) {
			$oid = $matches[1];
			$embed_url = 'https://yandex.ru/map-widget/v1/?oid=' . $oid . '&ol=org';
		}
		// Формат 3: search по тексту (https://yandex.ru/maps/?text=...)
		elseif (strpos($url, 'text=') !== false) {
			parse_str(parse_url($url, PHP_URL_QUERY), $params);
			$embed_url = 'https://yandex.ru/map-widget/v1/?text=' . urlencode($params['text'] ?? '');
		}
		// Формат 4: координаты (https://yandex.ru/maps/?ll=27.561524,53.904539&z=12)
		elseif (strpos($url, 'll=') !== false) {
			parse_str(parse_url($url, PHP_URL_QUERY), $params);
			$ll = $params['ll'] ?? '';
			$z = $params['z'] ?? '12';
			$embed_url = 'https://yandex.ru/map-widget/v1/?ll=' . urlencode($ll) . '&z=' . urlencode($z);
		}

		if ($embed_url) {
			return '<iframe src="' . esc_url($embed_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
		}
	}

	// Fallback: обычный oEmbed для YouTube, Vimeo и т.д.
	$oembed = wp_oembed_get(esc_url($url));
	if ($oembed) {
		return $oembed;
	}

	// Если ничего не подошло — вставляем ссылку как есть
	return '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer">' . esc_html($url) . '</a>';
}