<?php
/**
 * Plugin Name: Video Player Shortcode
 * Description: A simple plugin that adds a shortcode for embedding YouTube videos with lazy loading.
 * Version: 1.0
 * Author: Your Name
 */

function extract_youtube_video_id($url) {
    $parsed_url = parse_url($url);

    if ($parsed_url['host'] == 'youtu.be') {
        return ltrim($parsed_url['path'], '/');
    }

    if ($parsed_url['host'] == 'www.youtube.com' || $parsed_url['host'] == 'youtube.com') {
        if ($parsed_url['path'] == '/watch') {
            parse_str($parsed_url['query'], $query_params);
            return $query_params['v'];
        } elseif ($parsed_url['path'] == '/embed' || $parsed_url['path'] == '/v') {
            return ltrim($parsed_url['path'], '/');
        }
    }

    return null;
}

function video_player_shortcode($atts, $content = null) {
    $atts = shortcode_atts(
        array(
            'type' => 'youtube',
            'style' => '1',
            'dimensions' => '853x480',
            'width' => '853',
            'height' => '480',
            'align' => 'center',
            'margin_top' => '0',
            'margin_bottom' => '20',
            'ipad_color' => 'black'
        ),
        $atts,
        'video_player'
    );

    $video_url = base64_decode($content);
    $video_id = extract_youtube_video_id($video_url);
    $width = $atts['width'];
    $height = $atts['height'];
    $align = $atts['align'];
    $margin_top = $atts['margin_top'];
    $margin_bottom = $atts['margin_bottom'];

    return "
        <div style=\"text-align: {$align}; margin-top: {$margin_top}px; margin-bottom: {$margin_bottom}px;\">
            <iframe width=\"{$width}\" height=\"{$height}\" src=\"https://www.youtube.com/embed/{$video_id}\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen loading=\"lazy\"></iframe>
        </div>
    ";
}

add_shortcode('video_player', 'video_player_shortcode');

