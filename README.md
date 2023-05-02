# Video Player Shortcode

A robust and secure WordPress plugin that adds a shortcode for embedding YouTube videos with lazy loading using a PHP class. The plugin supports both unencoded and base64 encoded URLs.

## Description

Video Player Shortcode is a simple yet secure WordPress plugin that allows you to easily embed YouTube videos into your posts or pages using a shortcode. The plugin handles various YouTube URL formats, properly validates and sanitizes input data, supports lazy loading for better performance, and accepts both unencoded and base64 encoded URLs.

## Installation

1. Download the plugin files from the GitHub repository.
2. Upload the plugin files to the `/wp-content/plugins/video-player-shortcode` directory, or install the plugin through the WordPress plugins screen directly.
3. Activate the plugin through the 'Plugins' screen in WordPress.

## Usage

To embed a YouTube video, use the `video_player` shortcode with the full YouTube URL (unencoded or base64 encoded) as its content:

Unencoded URL example:

[video_player type="youtube" style="1" dimensions="853x480" width="853" height="480" align="center" margin_top="0" margin_bottom="20" ipad_color="black"]https://youtu.be/dQw4w9WgXcQ [/video_player]


Base64 encoded URL example:

[video_player type="youtube" style="1" dimensions="853x480" width="853" height="480" align="center" margin_top="0" margin_bottom="20" ipad_color="black"]aHR0cHM6Ly95b3V0dS5iZS9kUXc0dzlXZ1hjUQ==[/video_player]


The shortcode supports the following attributes:

- `type` (default: "youtube"): The video provider (currently only supports "youtube").
- `style` (default: "1"): The style of the video player (currently only supports "1").
- `dimensions` (default: "853x480"): The dimensions of the video player (format: "widthxheight").
- `width` (default: "853"): The width of the video player in pixels.
- `height` (default: "480"): The height of the video player in pixels.
- `align` (default: "center"): The alignment of the video player ("left", "center", "right").
- `margin_top` (default: "0"): The top margin of the video player in pixels.
- `margin_bottom` (default: "20"): The bottom margin of the video player in pixels.
- `ipad_color` (default: "black"): The color of the video player on iPad (currently only supports "black").

## License

This project is licensed under the [GPLv2 or later License](LICENSE.md).
