<?php
$post_type = get_query_var('post_type');

$title = '';
$descr = '';

// Для отдельного проекта
if (is_singular()) {
	$title = get_field('hero_title') ?: get_the_title();
	$descr = get_field('hero_descr') ?: '';

	// Для архива CPT
} elseif (is_post_type_archive()) {
	$post_type_obj = get_post_type_object($post_type);
	$slug = $post_type_obj->rewrite['slug'] ?? $post_type;
	$page = get_page_by_path($slug);

	if (!empty($page)) {
		$title = get_field('hero_title', $page->ID) ?: $page->post_title;
		$descr = get_field('hero_descr', $page->ID) ?: $page->post_content;
	}

	// Для архива категории / таксономии
} elseif (is_tax('projects_category')) {
	$term = get_queried_object();
	if ($term) {
		$title = $term->name;
		$descr = term_description($term); // или get_field('hero_descr', $term) если ACF поле
	}
}
?>
<section class="hero-page" id="hero-page">
	<div class="container hero-page__container">
		<div class="hero-page__breadcrumbs breadcrumbs">
			<?php if (function_exists('bcn_display')) {
				bcn_display();
			} ?>
		</div>
		<h1 class="hero-page__title title-1">
			<?php echo esc_html($title) ?>
		</h1>
		<div class="hero-page__descr descr">
			<?php echo wp_kses_post($descr) ?>
		</div>
	</div>
</section>