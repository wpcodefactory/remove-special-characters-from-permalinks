<?php
/**
 * Remove Special Characters From Permalinks - Core Class
 *
 * @version 1.0.4
 * @since   1.0.0
 * @author  Thanks to IT
 */

namespace ThanksToIT\RSCFP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'ThanksToIT\RSCFP\Core' ) ) {

	class Core {

		public $plugin_info = array();

		/**
		 * Call this method to get singleton
		 * @return Core
		 */
		public static function instance() {
			static $instance = false;
			if ( $instance === false ) {
				$instance = new static();
			}

			return $instance;
		}

		/**
		 * Setups plugin
		 *
		 * @version 1.0.0
		 * @since 1.0.0
		 *
		 * @param $args
		 */
		public function setup( $args ) {
			$args = wp_parse_args( $args, array(
				'path' => '' // __FILE__
			) );

			$this->plugin_info = $args;
		}

		/**
		 * Gets plugin url
		 *
		 * @version 1.0.0
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_plugin_url() {
			$path = $this->plugin_info['path'];

			return plugin_dir_url( $path );
		}

		/**
		 * Gets plugins dir
		 *
		 * @version 1.0.0
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_plugin_dir() {
			$path = $this->plugin_info['path'];

			return untrailingslashit( plugin_dir_path( $path ) ) . DIRECTORY_SEPARATOR;;
		}

		/**
		 * Initializes
		 *
		 * @version 1.0.3
		 * @since 1.0.0
		 * @todo Take a look at utf8_uri_encode() on formatting.php
		 *
		 * @return Core
		 */
		public function init() {
			$this->set_admin();
			$this->handle_localization();
			$this->set_wp_admin_notices();

			add_action( 'save_post', array( $this, 'remove_non_ascii_characters' ), 10, 2 );
		}

		/**
		 * Sets admin
		 * @version 1.0.3
		 * @since 1.0.3
		 */
		private function set_wp_admin_notices() {
			$notices = new Notices();
			$notices->init();
		}

		/**
		 * Removes non ASCII characters
		 *
		 * @version 1.0.4
		 * @since 1.0.0
		 *
		 * @return Core
		 */
		public function remove_non_ascii_characters( $post_id, $post ) {
			if ( preg_match( "/a-zA-Z0-9-_./i", urldecode( $post->post_name ) ) ) {
				return;
			};
			// unhook this function to prevent infinite looping
			remove_action( 'save_post', array( $this, 'remove_non_ascii_characters' ) );
			$site_url            = trailingslashit( get_home_url() );
			$post_permalink_full = get_permalink( $post_id );
			$post_permalink      = untrailingslashit( str_replace( $site_url, '', $post_permalink_full ) );
			update_post_meta( $post_id, '_trscfp_original_post_name', $post_permalink );
			$url_decoded   = urldecode( $post->post_name );
			$new_post_name = remove_accents( $url_decoded );
			$new_post_name = preg_replace( "/[^a-zA-Z0-9-_.]/", "", $new_post_name );
			$new_post_name = sanitize_title_with_dashes( $new_post_name );
			wp_update_post( array(
				'ID'        => $post_id,
				'post_name' => $new_post_name
			) );
			// re-hook this function
			add_action( 'save_post', array( $this, 'remove_non_ascii_characters' ), 10, 2 );
		}

		/**
		 * Sets admin
		 * @version 1.0.3
		 * @since 1.0.3
		 */
		private function set_admin() {
			// Add settings link on plugins page
			$path = $this->plugin_info['path'];
			add_filter( 'plugin_action_links_' . plugin_basename( $path ), array( $this, 'add_action_links' ) );
		}

		/**
		 * Handle Localization
		 *
		 * @version 1.0.1
		 * @since   1.0.1
		 */
		public function handle_localization() {
			$domain = 'remove-special-characters-from-permalinks';
			$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
			if ( $loaded = load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . 'plugins' . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' ) ) {
				return $loaded;
			} else {
				load_plugin_textdomain( $domain, false, dirname( plugin_basename( $this->plugin_info['path'] ) ) . '/src/languages/' );
			}
		}

		/**
		 * Adds action links
		 *
		 * @version 1.0.3
		 * @since 1.0.3
		 *
		 * @param $links
		 *
		 * @return array
		 */
		public function add_action_links( $links ) {
			$mylinks = array(
				'<a target="_blank" href="https://wpfactory.com/item/remove-special-characters-from-permalinks-wordpress-plugin/">' . __( 'Pro Version', 'remove-special-characters-from-permalinks' ) . '</a>',
			);
			return array_merge( $mylinks, $links );
		}

	}
}