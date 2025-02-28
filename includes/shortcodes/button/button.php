<?php
function _THEME_NAME_button($attribs = [], $content = null, $tag = '')
{
    // Set default attribute values
    $attribs = shortcode_atts(
        [
            'color' => 'red',
            'text' => 'Button'
        ],
        $attribs,
        $tag 
    );

    return '<button style="background-color: ' . esc_attr($attribs['color']) . '">' . do_shortcode($content) . '</button>';
}

add_shortcode('_THEME_NAME_button', '_THEME_NAME_button');
