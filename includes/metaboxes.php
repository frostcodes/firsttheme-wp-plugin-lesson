<?php
function _THEME_NAME_add_metabox()
{
    add_meta_box(
        '_THEME_NAME_post_metabox',
        'Post Settings',
        '_THEME_NAME_post_metabox_html',
        'post',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', '_THEME_NAME_add_metabox');

function _THEME_NAME_post_metabox_html($post)
{
    // NOTE: Css class "widefat" is a wp inbuilt class

    $subtitle = get_post_meta($post->ID, '__THEME_NAME_post_subtitle', true);
    $layout = get_post_meta($post->ID, '__THEME_NAME_post_layout', true);
    wp_nonce_field('_THEME_NAME_update_post_metabox', '_THEME_NAME_update_post_nonce')
        ?>

    <p>
        <label for="_THEME_NAME_post_metabox_html"><?php esc_html_e('Post Subtitle', '_THEME_NAME-_PLUGIN_NAME'); ?></label>
        <br>
        <input type="text" class="widefat" name="_THEME_NAME_post_subtitle_field" id="_THEME_NAME_post_metabox_html"
            value="<?php echo esc_attr($subtitle) ?>">
    </p>
    <p>
        <label for="_THEME_NAME_post_layout_field"><?php esc_html_e('Layout', '_THEME_NAME-_PLUGIN_NAME'); ?></label>
        <select name="_THEME_NAME_post_layout_field" id="_THEME_NAME_post_layout_field" class="widefat">
            <option <?php selected($layout, 'full'); ?> value="full"><?php esc_html_e('Full Width', '_THEME_NAME-_PLUGIN_NAME'); ?></option>
            <option <?php selected($layout, 'sidebar'); ?> value="sidebar"><?php esc_html_e('Post With Sidebar', '_THEME_NAME-_PLUGIN_NAME'); ?></option>
        </select>
    </p>

    <?php
}

function _THEME_NAME_save_post_metabox($post_id, $post)
{
    if (!isset($_POST['_THEME_NAME_update_post_nonce']) || !wp_verify_nonce($_POST['_THEME_NAME_update_post_nonce'], '_THEME_NAME_update_post_metabox')) {
        return false;
    }

    $edit_capability = get_post_type_object($post->post_type)->cap->edit_post;
    if (!current_user_can($edit_capability, $post_id)) {
        return false;
    }

    if (array_key_exists('_THEME_NAME_post_subtitle_field', $_POST)) {
        // NOTE: 2 underscores is not a bug, it is to hide the field name from the custom field dropdown in the post edit page
        update_post_meta(
            $post_id,
            '__THEME_NAME_post_subtitle',
            sanitize_text_field($_POST['_THEME_NAME_post_subtitle_field'])
        );
    }

    if (array_key_exists('_THEME_NAME_post_layout_field', $_POST)) {
        // NOTE: 2 underscores is not a bug, it is to hide the field name from the custom field dropdown in the post edit page
        update_post_meta(
            $post_id,
            '__THEME_NAME_post_layout',
            sanitize_text_field($_POST['_THEME_NAME_post_layout_field']) // TODO: create a better validator using in_array
        );
    }
}

add_action('save_post', '_THEME_NAME_save_post_metabox', 10, 2);