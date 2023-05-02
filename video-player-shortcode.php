<?php
/**
 * Plugin Name: Video Player Shortcode
 * Description: A simple plugin that reimplements a simplified video_player shortcode from old Optimizepress plugin. Use for migrating old pages to new theme.
 * Version: 1.0.0
 * Author: Gabe Herbert, Kitestring Studio
 */

class Video_Player_Shortcode {
	public function __construct() {
		add_shortcode('video_player', array($this, 'render_shortcode'));
	}

	private function extract_youtube_video_id($url) {
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

	public function render_shortcode($atts, $content = null) {
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

		if (strpos($content, '://') === false) {
			$video_url = base64_decode($content);
		} else {
			$video_url = $content;
		}

		if (!filter_var($video_url, FILTER_VALIDATE_URL)) {
			return 'Invalid YouTube URL';
		}

		$video_id = $this->extract_youtube_video_id($video_url);
		if (empty($video_id)) {
			return 'Invalid YouTube URL';
		}

		$width = esc_attr($atts['width']);
		$height = esc_attr($atts['height']);
		$align = esc_attr($atts['align']);
		$margin_top = esc_attr($atts['margin_top']);
		$margin_bottom = esc_attr($atts['margin_bottom']);

		return "
        <div style=\"text-align: {$align}; margin-top: {$margin_top}px; margin-bottom: {$margin_bottom}px;\">
            <iframe width=\"{$width}\" height=\"{$height}\" src=\"https://www.youtube.com/embed/{$video_id}\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen loading=\"lazy\"></iframe>
        </div>
    ";
	}
}

new Video_Player_Shortcode();
