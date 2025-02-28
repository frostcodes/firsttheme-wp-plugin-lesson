<?php

function _THEME_NAME__PLUGIN_NAME_register_project_type_taxonomy()
{
    $labels = [
        'name' => esc_html_x('Project Type', 'taxonomy general name', '_THEME_NAME-_PLUGIN_NAME'),
        'singular_name' => esc_html_x('Project Type', 'taxonomy singular name', '_THEME_NAME-_PLUGIN_NAME'),
        'search_items' => esc_html__('Search Project Types', '_THEME_NAME-_PLUGIN_NAME'),

        'all_items' => esc_html__('All Project Types', '_THEME_NAME-_PLUGIN_NAME'),
        'parent_item' => esc_html__('Parent Project Type', '_THEME_NAME-_PLUGIN_NAME'),
        'parent_item_colon' => esc_html__('Parent Project Type:', '_THEME_NAME-_PLUGIN_NAME'),

        'edit_item' => esc_html__('Edit Project Type', '_THEME_NAME-_PLUGIN_NAME'),
        'update_item' => esc_html__('Update Project Type', '_THEME_NAME-_PLUGIN_NAME'),
        'add_new_item' => esc_html__('Add New Project Type', '_THEME_NAME-_PLUGIN_NAME'),
        
        'new_item_name' => esc_html__('New Project Type Name', '_THEME_NAME-_PLUGIN_NAME'),
        'menu_name' => esc_html__('Project Types', '_THEME_NAME-_PLUGIN_NAME')
    ];

    $args = [
        'labels' => $labels,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'project_type'],
    ];

    // Taxonomy Name: must not exceed 32 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
    register_taxonomy('_tsn_project_type', ['_tsn_portfolio'], $args);
}

add_action('init', '_THEME_NAME__PLUGIN_NAME_register_project_type_taxonomy');
