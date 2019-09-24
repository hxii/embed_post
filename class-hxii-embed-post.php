<?php
/**
 * @link              https://paulglushak.com
 * @since             1.0.0
 * @package           HXII_Embed_Post
 *
 * @wordpress-plugin
 * Plugin Name:       HXII Embed Post
 * Plugin URI:        https://github.com/hxii/embed_post
 * Description:       Allows you to embed posts in other posts for easy reference.
 * Version:           1.0.0
 * Author:            hxii
 * Author URI:        https://paulglushak.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hxii-embed-post
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || die();

class HXII_Embed_Post {

	/**
	 * Actions etc
	 */
	public function __construct() {
		add_shortcode( 'embed_post', array( $this, 'embed_post' ) );
		add_action( 'wp_head', array( $this, 'style' ) );
	}

	/**
	 * Get post by ID and return content.
	 *
	 * @param array $args shortcode arguments.
	 * @return string
	 */
	public function embed_post( $args ) {
		if ( isset( $args['post_id'] ) ) {
			$post = get_post( $args['post_id'] );
			if ( ! is_null( $post ) ) {
				$title     = $post->post_title;
				$permalink = get_permalink( $post );
				$output    = apply_filters( 'the_content', $post->post_content );
				return "<div class=\"embed_post\"><div class=\"embed_content\">$output</div>
				<div class=\"embed_meta\">From <a href=\"$permalink\">$title</a> &ndash; Modified {$post->post_modified}</div>
				</div>";
			}
		}
	}

	/**
	 * Inline stylesheet.
	 */
	public function style() {
		echo '<style>
		.embed_post {
			display: flex;
			flex-direction: column;
			padding: .5em;
			border: 1px solid #eee;
			background: #fdfdfd;
		}
		.embed_meta {
			align-self: flex-end;
			font-size: .75em;
			text-transform: uppercase;
			font-weight: 600;
		}
		</style>';
	}

}

new HXII_Embed_Post();
