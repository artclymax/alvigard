<?php
// === Helpers ===
require_once get_template_directory() . '/functions/helpers/theme_asset_version.php';
require_once get_template_directory() . '/functions/helpers/print_dump.php';
require_once get_template_directory() . '/functions/helpers/mx_logo.php';
require_once get_template_directory() . '/functions/helpers/scf-functions.php';
//require_once get_template_directory() . '/functions/helpers/trim_text.php';
require_once get_template_directory() . '/functions/helpers/correct_phone.php';
require_once get_template_directory() . '/functions/helpers/get_titles_from_query_to_json.php';

/** Добавление картинки для кастомных полей в таблице админки
 * add_admin_thumbnail_column('castom-post-slug'); // projects
 */
require_once get_template_directory() . '/functions/helpers/add_admin_thumbnail_column.php';
add_admin_thumbnail_column('catalog');
add_admin_thumbnail_column('projects');
add_admin_thumbnail_column('reviews');

//require_once get_template_directory() . '/functions/helpers/get_prev_post_slug.php';
//require_once get_template_directory() . '/functions/helpers/get_next_post_slug.php';
//require_once get_template_directory() . '/functions/helpers/custom_product_category.php';
//require_once get_template_directory() . '/functions/helpers/get_product_attributes_array.php';

// === BASE ====
// Общая настройка темы (лого, название и т.п.)
require_once get_template_directory() . '/functions/default_settings.php';

// Подключение стилей
require_once get_template_directory() . '/functions/connect_styles.php';

// Подключение скриптов
require_once get_template_directory() . '/functions/connect_scripts.php';

// Отключение стилей Woocommerce
//add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Поддержка темы на Woocommerce
//add_action('after_setup_theme', function () {
//	add_theme_support('woocommerce');
//});
// Создание меню
require_once get_template_directory() . '/functions/register_nav_menus.php';

// Регистрация новых записей
require_once get_template_directory() . '/functions/register_post_type.php';

// Кастомная админка (новая версия)
require_once get_template_directory() . '/functions/admin/admin-page.php';

// Установка плагинов из админки (хуки должны грузиться всегда)
require_once get_template_directory() . '/functions/admin/plugin-installer.php';


// Создание SCF-полей
require_once get_template_directory() . '/functions/scf_data.php';


//!
//add_action('wp_head', function () {
//	if (defined('WP_DEBUG')) {
//		$vite_server = 'http://localhost:5173';
//		echo "<!-- VITE DEV INJECT: start -->\n";
//		echo '<script type="module" src="' . esc_url($vite_server) . '/@vite/client"></script>';
//		echo '<script type="module" src="' . esc_url($vite_server) . '/main.js"></script>';
//		echo "<!-- VITE DEV INJECT: end -->\n";
//	};
//});

function mx_fix_orphans($text)
{
	if (is_admin())
		return $text;
	if (!is_string($text))
		return $text;

	return preg_replace('/(\s|&nbsp;)([а-яА-Яa-zA-Z]{1,2})\s/u', '$1$2&nbsp;', $text); //return preg_replace('/\s([а-яА-Яa-zA-Z]{1,2})\s/u', ' $1&nbsp;', $text);
}
// ACF
add_filter('acf/format_value', 'mx_fix_orphans', 20);
add_filter('the_content', 'mx_fix_orphans', 20);
add_filter('the_title', 'mx_fix_orphans', 20);
add_filter('the_excerpt', 'mx_fix_orphans', 20);
add_filter('nav_menu_item_title', 'mx_fix_orphans', 20);

// Внимание: навигация и ACF требуют осторожности
// add_filter('nav_menu_item_title', 'mx_fix_orphans', 20); 
// add_filter('acf/format_value', 'mx_fix_orphans', 20); 

add_action('admin_head', function () {
	echo '<style>
        #postexcerpt p {
            display: none !important;
        }
    </style>';
});
//add_filter('big_image_size_threshold', '__return_false');

add_filter('bcn_breadcrumb_title', function ($title, $type, $id) {

	$front_page_id = get_option('page_on_front');

	// Если это крошка главной
	if (in_array('home', $type) && $front_page_id) {
		return get_the_title($front_page_id);
	}

	return $title;

}, 10, 3);

// Убираем разделитель
add_filter('bcn_display_separator', '__return_empty_string');

// === CF7 Redirect: Редирект после отправки формы ===
require_once get_template_directory() . '/functions/cf7-redirect.php';

// === CF7 Leads: Собственная система хранения заявок ===
require_once get_template_directory() . '/functions/cf7-leads.php';

// === CF7: переопределение email получателя через настройки сайта ===
add_filter('wpcf7_mail_components', function ($components, $form) {
	$custom_email = get_option('form_email_to');

	if (!empty($custom_email) && is_email($custom_email)) {
		$components['recipient'] = $custom_email;
	}

	return $components;
}, 10, 2);

add_filter('wpcf7_autop', '__return_false', 20);
add_filter('wpcf7_form_elements', function ($content) {
	//$content = preg_replace('/<span class="wpcf7-form-control-wrap.*?">(.*?)<\/span>/is', '$1', $content);
	$content = str_replace('<br />', '', $content);
	return $content;
});

//add_filter('wpcf7_form_elements', 'clean_cf7_acceptance_wrappers');
//function clean_cf7_acceptance_wrappers($content)
//{
//	return preg_replace_callback(
//		'/<span\b[^>]*class="[^"]*wpcf7-acceptance[^"]*"[^>]*>\s*<span\b[^>]*class="[^"]*wpcf7-list-item[^"]*"[^>]*>(.*?)<\/span>\s*<\/span>/isu',
//		function ($matches) {
//			$html = $matches[1];
//			if (preg_match('/<label\b[^>]*class="/i', $html)) {
//				$html = preg_replace('/(<label\b[^>]*class=")([^"]*)/i', '$1$2 wpcf7-acceptance-label', $html, 1);
//			} else {
//				$html = preg_replace('/<label\b/i', '<label class="wpcf7-acceptance-label"', $html, 1);
//			}
//			return $html;
//		},
//		$content
//	);
//}
