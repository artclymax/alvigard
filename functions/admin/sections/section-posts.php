<?php
/**
 * Секция: Записи и кастомные типы
 * 
 * Автоматическое обнаружение всех post_type
 * Показывает количество записей, быстрые ссылки
 * Кеширование через transients API
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Получить все кастомные типы записей с кешированием
 */
function verda_get_cached_post_types() {
    $cache = get_transient('verda_admin_post_types');
    
    if ($cache === false) {
        $post_types = get_post_types(
            ['public' => true, '_builtin' => false],
            'objects'
        );
        
        // Исключаем системные
        $excluded = ['flamingo_inbound', 'flamingo_contact', 'attachment'];
        foreach ($excluded as $exclude) {
            unset($post_types[$exclude]);
        }
        
        $timeout = verda_get_config('settings.cache_timeout', 3600);
        set_transient('verda_admin_post_types', $post_types, $timeout);
        
        $cache = $post_types;
    }
    
    return $cache;
}

/**
 * Получить количество записей для типа
 */
function verda_get_post_count($post_type) {
    $count = wp_count_posts($post_type);
    return $count->publish ?? 0;
}

/**
 * Очистить кеш при сохранении/удалении/регистрации записи
 */
add_action('save_post', function() {
    delete_transient('verda_admin_post_types');
});
add_action('registered_post_type', function() {
    delete_transient('verda_admin_post_types');
});
add_action('unregistered_post_type', function() {
    delete_transient('verda_admin_post_types');
});

function render_section_posts() {
    $post_types = verda_get_cached_post_types();
    
    if (empty($post_types)) {
        ?>
        <div class="verda-card">
            <h2 class="verda-card-title">Записи</h2>
            <p class="verda-card-description">Кастомные типы записей не найдены.</p>
        </div>
        <?php
        return;
    }
    ?>
    
    <div class="verda-card">
        <h2 class="verda-card-title">Записи</h2>
        <p class="verda-card-description">Все типы записей с быстрым доступом.</p>
        
        <table class="widefat striped verda-table">
            <thead>
                <tr>
                    <th>Тип записей</th>
                    <th>Количество</th>
                    <th class="verda-table-actions">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($post_types as $post_type): ?>
                    <?php
                    $count = verda_get_post_count($post_type->name);
                    $edit_link = admin_url('edit.php?post_type=' . $post_type->name);
                    $add_link = admin_url('post-new.php?post_type=' . $post_type->name);
                    $singular_name = $post_type->labels->singular_name ?? 'Запись';
                    ?>
                    <tr>
                        <td>
                            <a href="<?= esc_url($edit_link); ?>">
                                <?= esc_html($post_type->labels->name); ?>
                            </a>
                        </td>
                        <td>
                            <span class="verda-count-badge"><?= $count; ?></span>
                        </td>
                        <td class="verda-table-actions">
                            <a class="button button-small" href="<?= esc_url($edit_link); ?>">
                                Все записи
                            </a>
                            <a class="button button-small button-primary" href="<?= esc_url($add_link); ?>">
                                Добавить <?= esc_html(mb_strtolower($singular_name)); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}
