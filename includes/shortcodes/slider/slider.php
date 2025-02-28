<?php

function _THEME_NAME_slider($attribs = [], $content = null, $tag = '')
{
    // Set default attribute values
    $attribs = shortcode_atts(
        [
            'arrows' => false,
            'autoplay' => false
        ],
        $attribs,
        $tag
    );

    $arrows = $attribs['arrows'] ? 'true' : 'false';
    $autoplay = $attribs['autoplay'] ? 'true' : 'false';

    $output = '<div class="_THEME_NAME-slider" data-slick=\'{"autoplay": ' . $autoplay . ', "arrows": ' . $arrows . '}\'>';

    if (!is_null($content)) {
        $output .= do_shortcode($content);
    }

    $output .= '</div>';

    return $output;
}

add_shortcode('_THEME_NAME_slider', '_THEME_NAME_slider');


function _THEME_NAME_slide($attribs = [], $content = null, $tag = '')
{
    // Set default attribute values
    $attribs = shortcode_atts(
        [
            'image' => null,
            'caption' => ''
        ],
        $attribs,
        $tag
    );

    $output = '<div class="_THEME_NAME_slide">';

    if ($attribs['image']) {
        $output .= wp_get_attachment_image($attribs['image'], 'large');
    }

    if ($attribs['caption']) {
        $output .= '<div class="_THEME_NAME-slide-caption">' . esc_html($attribs['caption']) . '</div>';
    }

    $output .= '</div>';

    return $output;
}

add_shortcode('_THEME_NAME_slide', '_THEME_NAME_slide');
