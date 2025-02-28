<?php
// Frontend assets
function _THEME_NAME__PLUGIN_NAME_assets()
{
    wp_enqueue_style('_THEME_NAME-_PLUGIN_NAME-stylesheet', plugins_url('_THEME_NAME-metaboxes/dist/assets/css/frontend.css'), array(), _UPPERCASED_THEME_NAME__UPPERCASED_PLUGIN_NAME_VERSION);

    wp_enqueue_script('_THEME_NAME-_PLUGIN_NAME-scripts', plugins_url('_THEME_NAME-metaboxes/dist/assets/js/frontend.js'), array('jquery'), _UPPERCASED_THEME_NAME__UPPERCASED_PLUGIN_NAME_VERSION, true);
}

add_action('wp_enqueue_scripts', '_THEME_NAME__PLUGIN_NAME_assets');

// Admin area/dashboard assets
function _THEME_NAME__PLUGIN_NAME_admin_area_assets()
{
    global $pagenow;

    if ($pagenow !== 'post.php') {
        return false;
    }

    wp_enqueue_style('_THEME_NAME-_PLUGIN_NAME-admin-stylesheet', plugins_url('_THEME_NAME-metaboxes/dist/assets/css/admin-area.css'), array(), _UPPERCASED_THEME_NAME__UPPERCASED_PLUGIN_NAME_VERSION);

    wp_enqueue_script('_THEME_NAME-_PLUGIN_NAME-admin-scripts', plugins_url('_THEME_NAME-metaboxes/dist/assets/js/admin-area.js'), array('jquery'), _UPPERCASED_THEME_NAME__UPPERCASED_PLUGIN_NAME_VERSION, true);
}

add_action('admin_enqueue_scripts', '_THEME_NAME__PLUGIN_NAME_admin_area_assets');
