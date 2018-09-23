<?php
/**
 * Remove Special Characters From Permalinks - Core Class
 *
 * @version 1.0.1
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
		 * @version 1.0.1
		 * @since 1.0.0
		 *
		 * @return Core
		 */
		public function init() {
			$this->set_admin();
			$this->handle_localization();

			// It's important to keep priority as 1
			add_filter( 'sanitize_title', array( $this, 'remove_non_ascii_characters' ), 1 );
		}

		/**
		 * Removes nos ASCII characters
		 *
		 * Excludes white spaces because WordPress handles it later replacing it with dashes
		 *
		 * @version 1.0.0
		 * @since 1.0.0
		 *
		 * @return Core
		 */
		public function remove_non_ascii_characters( $title ) {
			if(!is_admin()){
				return $title;
			}
			$title = preg_replace( "/[^\sa-zA-Z0-9-_.]/", "", $title );
			return $title;
		}

		/**
		 * Sets admin
		 * @version 1.0.0
		 * @since 1.0.0
		 */
		private function set_admin() {
			// Add settings link on plugins page
			//$path = $this->plugin_info['path'];
			//add_filter( 'plugin_action_links_' . plugin_basename( $path ), array( $this, 'add_action_links' ) );
		}

		/**
		 * Handle Localization
		 *
		 * @version 1.0.1
		 * @since   1.0.1
		 */
		public function handle_localization(){
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
		 * @version 1.0.0
		 * @since 1.0.0
		 *
		 * @param $links
		 *
		 * @return array
		 */
		/*public function add_action_links( $links ) {
			$mylinks = array(
				'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=trswc' ) . '">Settings</a>',
			);
			return array_merge( $mylinks, $links );
		}*/

	}
}