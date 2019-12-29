<?php
/**
 * Embed Post allows you to embed posts in other posts for easy reference.
 *
 * @link              https://paulglushak.com
 * @since             1.0.0
 * @package           HXII_Embed_Post
 *
 * @wordpress-plugin
 * Plugin Name:       HXII Embed Post
 * Plugin URI:        https://github.com/hxii/embed_post
 * Description:       Allows you to embed posts in other posts for easy reference.
 * Version:           1.0.2
 * Author:            hxii
 * Author URI:        https://paulglushak.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hxii-embed-post
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || die();

/**
 * Embed Post - [embed_post post_id=99 class="default" excerpt=true]
 */
class HXII_Embed_Post {

	/**
	 * Actions etc
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'embed_post', array( $this, 'embed_post' ) );
		add_action( 'wp_head', array( $this, 'style' ) );
	}

	/**
	 * Get post by ID and return content.
	 *
	 * @param array $args shortcode arguments.
	 * @since 1.0.0
	 * @return string
	 */
	public function embed_post( $args ) {
		$args = shortcode_atts( 
			[
				'post_id' => null,
				'class'   => 'default',
				'excerpt' => false,
			],
			$args,
			'embed_post'
		);
		if ( isset( $args['post_id'] ) ) {
			$post = get_post( $args['post_id'] );
			if ( ! is_null( $post ) ) {
				$title     = $post->post_title;
				$permalink = get_permalink( $post );
				$class     = ( isset( $args['class'] ) ) ? ' ' . $args['class'] : ' default';
				$author    = get_the_author_meta( 'user_nicename' , $post->post_author );
				$output    = ( ( true === $args['excerpt'] ) ) ? get_the_excerpt( $post ) : apply_filters( 'the_content', $post->post_content );
				return "<section class=\"embed_post{$class} {$post->post_type}\">
					<div class=\"embed_content\">$output</div>
					<div class=\"embed_meta\">
						<span class=\"embed_source\">From <a href=\"$permalink\">$title</a></span>
						<span class=\"embed_author\">By {$author}</span>
						<span class=\"embed_modified\">Modified {$post->post_modified}</span>
					</div>
					</section>";
			}
		}
	}

	/**
	 * Inline stylesheet.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function style() {
		echo '<style>
		.embed_post.default {
			display: flex;
			flex-direction: column;
			padding: .5em;
			border: 1px solid #eee;
			background: #eee;
		}
		.embed_post.default .embed_meta {
			align-self: flex-end;
			font-size: .75em;
			text-transform: uppercase;
			font-weight: 600;
		}
		.embed_post.default .embed_meta span:after {
			content: " \2013 "
		}
		.embed_post.default .embed_meta span:last-child:after {
			content: "";
		}
		.embed_post.seamless {
			background: transparent;
			border: none;
			padding: 0;
		}
		.embed_post.seamless .embed_meta {
			display: none;
		}
		</style>';
	}

}

new HXII_Embed_Post();
