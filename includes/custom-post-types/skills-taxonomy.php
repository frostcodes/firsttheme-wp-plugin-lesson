<?php
function _THEME_NAME__PLUGIN_NAME_register_skills_taxonomy()
{
    $labels = [
        'name' => esc_html_x('Skills', 'taxonomy general name', '_THEME_NAME-_PLUGIN_NAME'),
        'singular_name' => esc_html_x('Skill', 'taxonomy singular name', '_THEME_NAME-_PLUGIN_NAME'),
        'search_items' => esc_html__('Search Skills', '_THEME_NAME-_PLUGIN_NAME'),

        'all_items' => esc_html__('All Skills', '_THEME_NAME-_PLUGIN_NAME'),
        'parent_item' => esc_html__('Parent Skill', '_THEME_NAME-_PLUGIN_NAME'),
        'parent_item_colon' => esc_html__('Parent Skill:', '_THEME_NAME-_PLUGIN_NAME'),

        'edit_item' => esc_html__('Edit Skill', '_THEME_NAME-_PLUGIN_NAME'),
        'update_item' => esc_html__('Update Skill', '_THEME_NAME-_PLUGIN_NAME'),
        'add_new_item' => esc_html__('Add New Skill', '_THEME_NAME-_PLUGIN_NAME'),

        'new_item_name' => esc_html__('New Skill Name', '_THEME_NAME-_PLUGIN_NAME'),
        'menu_name' => esc_html__('Skills', '_THEME_NAME-_PLUGIN_NAME'),
    ];

    $args = [
        'hierarchical' => false,
        'labels' => $labels,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'skills'],
    ];

    // Taxonomy Name: must not exceed 32 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
    register_taxonomy('_tsn_skills', ['_tsn_portfolio'], $args);
}
add_action('init', '_THEME_NAME__PLUGIN_NAME_register_skills_taxonomy');