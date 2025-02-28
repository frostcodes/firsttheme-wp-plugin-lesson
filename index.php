<?php
/*
Plugin Name: _THEME_NAME _PLUGIN_NAME
Plugin URI:
Description: Adding Metaboxes for _THEME_NAME
Version: 1.0.0
Author: Punchline Technologies
Author URI: http://punchlinetech.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: _THEME_NAME-_PLUGIN_NAME
Domain Path: /languages
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    exit;
}

define("_UPPERCASED_THEME_NAME__UPPERCASED_PLUGIN_NAME_VERSION", "_PLUGIN_VERSION");

require_once 'includes/metaboxes.php';
require_once 'includes/enqueue-assets.php';

// Custom post types
require_once 'includes/custom-post-types/portfolio-post-type.php';
require_once 'includes/custom-post-types/project-type-taxonomy.php';
require_once 'includes/custom-post-types/skills-taxonomy.php';

// Called when the plugin is newly activated
function _THEME_NAME__PLUGIN_NAME_activate()
{
    _PLUGIN_NAME_setup_portfolio_post_type();
    _THEME_NAME__PLUGIN_NAME_register_project_type_taxonomy();
    _THEME_NAME__PLUGIN_NAME_register_skills_taxonomy();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, '_THEME_NAME__PLUGIN_NAME_activate');
register_deactivation_hook(__FILE__, '_THEME_NAME__PLUGIN_NAME_deactivate');

// Called when the plugin is deactivated
function _THEME_NAME__PLUGIN_NAME_deactivate()
{
    unregister_post_type('_tsn_portfolio');
    unregister_taxonomy('_tsn_project_type');
    unregister_taxonomy('_tsn_skills');
    flush_rewrite_rules();
}

function _THEME_NAME__PLUGIN_NAME_init()
{
    // Register shortcodes

    // TODO: i feel this can be re-organized into like:  includes/shortcodes/button.php
    include_once 'includes/shortcodes/button/button.php';
    include_once 'includes/shortcodes/slider/slider.php';
}

add_action('init', '_THEME_NAME__PLUGIN_NAME_init');
