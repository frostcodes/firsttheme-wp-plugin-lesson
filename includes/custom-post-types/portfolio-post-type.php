<?php
function _PLUGIN_NAME_setup_portfolio_post_type()
{
    $labels = [
        'name' => esc_html_x('Portfolio', 'Post type general name', '_THEME_NAME-_PLUGIN_NAME'),
        'singular_name' => esc_html_x('Portfolio Item', 'Post type singular name', '_THEME_NAME-_PLUGIN_NAME'),
        'menu_name' => esc_html_x('Portfolio', 'Admin Menu text', '_THEME_NAME-_PLUGIN_NAME'),


        'name_admin_bar' => esc_html_x('Portfolio Item', 'Add New on Toolbar', '_THEME_NAME-_PLUGIN_NAME'),
        'add_new' => esc_html__('Add New', '_THEME_NAME-_PLUGIN_NAME'),
        'add_new_item' => esc_html__('Add New Portfolio Item', '_THEME_NAME-_PLUGIN_NAME'),


        'new_item' => esc_html__('New Portfolio Item', '_THEME_NAME-_PLUGIN_NAME'),
        'edit_item' => esc_html__('Edit Portfolio Item', '_THEME_NAME-_PLUGIN_NAME'),
        'view_item' => esc_html__('View Portfolio Item', '_THEME_NAME-_PLUGIN_NAME'),


        'view_items' => esc_html__('View Portfolio Items', '_THEME_NAME-_PLUGIN_NAME'),
        'all_items' => esc_html__('All Portfolio Items', '_THEME_NAME-_PLUGIN_NAME'),
        'search_items' => esc_html__('Search Portfolio Items', '_THEME_NAME-_PLUGIN_NAME'),


        'parent_item_colon' => esc_html__('Parent Portfolio Items:', '_THEME_NAME-_PLUGIN_NAME'),
        'not_found' => esc_html__('No Portfolio Items found.', '_THEME_NAME-_PLUGIN_NAME'),
        'not_found_in_trash' => esc_html__('No Portfolio Items found in Trash.', '_THEME_NAME-_PLUGIN_NAME'),


        'featured_image' => esc_html_x('Portfolio Item Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', '_THEME_NAME-_PLUGIN_NAME'),
        'set_featured_image' => esc_html_x('Set portfolio item image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', '_THEME_NAME-_PLUGIN_NAME'),


        'remove_featured_image' => esc_html_x('Remove portfolio item image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', '_THEME_NAME-_PLUGIN_NAME'),
        'use_featured_image' => esc_html_x('Use as portfolio item image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', '_THEME_NAME-_PLUGIN_NAME'),


        'archives' => esc_html_x('Portfolio archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', '_THEME_NAME-_PLUGIN_NAME'),
        'insert_into_item' => esc_html_x('Insert into portfolio item', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', '_THEME_NAME-_PLUGIN_NAME'),


        'uploaded_to_this_item' => esc_html_x('Uploaded to this portfolio item', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', '_THEME_NAME-_PLUGIN_NAME'),
        'filter_items_list' => esc_html_x('Filter portfolio items list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', '_THEME_NAME-_PLUGIN_NAME'),


        'items_list_navigation' => esc_html_x('Portfolio items list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', '_THEME_NAME-_PLUGIN_NAME'),
        'items_list' => esc_html_x('Portfolio items list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', '_THEME_NAME-_PLUGIN_NAME'),
    ];

    // READ MORE: https://developer.wordpress.org/reference/functions/register_post_type/
    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-gallery', // From dashicons (https://developer.wordpress.org/resource/dashicons)
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments',
        ],
        'rewrite' => ['slug' => 'portfolio'],
    ];

    //Post type name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
    register_post_type('_tsn_portfolio', $args);
}

add_action('init', '_PLUGIN_NAME_setup_portfolio_post_type');
