<?php
/**
 * Remove Special Characters From Permalinks - Notices
 *
 * @version 1.0.3
 * @since   1.0.3
 * @author  WPFactory
 */

namespace WPFactory\RSCFP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'WPFactory\RSCFP\Notices' ) ) {

	class Notices {
		public function init() {
			// Initializes WP Admin Notices
			add_action( 'wp_ajax_' . 'tttwpan_dismiss_persist', array( 'ThanksToIT\WPAN\Notices_Manager', 'ajax_dismiss' ) );
			add_action( 'activated_plugin', array( 'ThanksToIT\WPAN\Notices_Manager', 'set_activated_plugin' ) );
			add_action( 'upgrader_process_complete', array( 'ThanksToIT\WPAN\Notices_Manager', 'set_upgrader_process' ), 10, 2 );

			// Manages notices conditions
			//add_action( 'admin_notices', array( $this, 'add_settings_page_notices' ) );
			add_action( 'admin_notices', array( $this, 'add_plugins_page_notices' ) );
		}

		public function get_feedback_notice_content() {
			return "<h3 class='title'>" . __( "Special Characters feedback", 'remove-special-characters-from-permalinks' ) . "</h3>"
			       . "<p style='margin-bottom:15px;'>" .
			       sprintf( __( "Enjoying <strong>Remove Special Characters from Permalinks</strong>? Would you mind <a href='%s' target='_blank'>writing a review</a>? I would really appreciate it :)", 'remove-special-characters-from-permalinks' ), 'https://wordpress.org/support/plugin/remove-special-characters-from-permalinks/reviews/#new-post' ) . ""
			       . "<br />" .
			       sprintf( __( "Feel free to submit your <a href='%s' target='_blank'>ideas and suggestions</a> too", 'remove-special-characters-from-permalinks' ), 'https://wordpress.org/support/plugin/remove-special-characters-from-permalinks/' )
			       . "</p>";
		}

		public function get_premium_notice_content() {
			return "<h3 class='title'>" . __( "Special Characters Premium", 'remove-special-characters-from-permalinks' ) . "</h3>"
			       . "<p>"
			       . __( "Do you like the free version of this plugin?", 'remove-special-characters-from-permalinks' )
			       . "<br />"
			       . sprintf( __( "Did you know we also have a <a href='%s' target='_blank'>Premium one</a>?", 'remove-special-characters-from-permalinks' ), 'https://wpfactory.com/item/remove-special-characters-from-permalinks/' )
			       . "</br>"
			       . "<h4>Check some of its features for now:</h4>"
			       . "<ul style='list-style:disc inside;'>"
			       . "<li>" . __( "Remove special characters from all permalinks at once", 'remove-special-characters-from-permalinks' ) . "</li>"
			       . "<li>" . __( "Support", 'remove-special-characters-from-permalinks' ) . "</li>"
			       . "<p style='margin-top:15px'>"
			       . __( "Buying it will allow you to remove special characters from all permalinks at once, helping maintaining the development of this plugin.", 'remove-special-characters-from-permalinks' )
			       . "</br>"
			       . __( "And besides you aren't going to see these annoying messages anymore :)", 'remove-special-characters-from-permalinks' )
			       . "</p>"
			       . sprintf( "<a style='display:inline-block;margin:15px 0 8px 0' target='_blank' class='button-primary' href='%s'>", 'https://wpfactory.com/item/remove-special-characters-from-permalinks/' ) . __( "Upgrade to Premium version", 'remove-special-characters-from-permalinks' ) . "</a>"
			       . "</ul>";
		}

		public function add_plugins_page_notices() {
			$notices_manager = \ThanksToIT\WPAN\get_notices_manager();

			// Feedback notice
			$notices_manager->create_notice( array(
				'id'                   => 'trscfp-free-notice-plugin-activation',
				'content'              => $this->get_feedback_notice_content(),
				'dismissal_expiration' => WEEK_IN_SECONDS,
				'display_on'           => array(
					'activated_plugin' => array( 'remove-special-characters-from-permalinks/remove-special-characters-from-permalinks.php' ),
					'screen_id'        => array( 'plugins' ),
				),
			) );
			$notices_manager->create_notice( array(
				'id'                   => 'trscfp-free-notice-plugin-update',
				'content'              => $this->get_feedback_notice_content(),
				'dismissal_expiration' => WEEK_IN_SECONDS,
				'display_on'           => array(
					'updated_plugin' => array( 'remove-special-characters-from-permalinks/remove-special-characters-from-permalinks.php' ),
					'screen_id'      => array( 'plugins' ),
				),
			) );

			// Premium notice
			$notices_manager->create_notice( array(
				'id'                   => 'trscfp-premium-info-plugin-activation',
				'content'              => $this->get_premium_notice_content(),
				'dismissal_expiration' => WEEK_IN_SECONDS,
				'display_on'           => array(
					'activated_plugin' => array( 'remove-special-characters-from-permalinks/remove-special-characters-from-permalinks.php' ),
					'screen_id'        => array( 'plugins' ),
				),
			) );
			$notices_manager->create_notice( array(
				'id'                   => 'trscfp-premium-info-plugin-update',
				'content'              => $this->get_premium_notice_content(),
				'dismissal_expiration' => WEEK_IN_SECONDS,
				'display_on'           => array(
					'updated_plugin' => array( 'remove-special-characters-from-permalinks/remove-special-characters-from-permalinks.php' ),
					'screen_id'      => array( 'plugins' ),
				),
			) );
		}

		/*public function add_settings_page_notices() {
			$notices_manager = \ThanksToIT\WPAN\get_notices_manager();

			// Feedback notice
			$notices_manager->create_notice( array(
				'id'          => 'trscfp-free-notice-settings-page',
				'content'     => $this->get_feedback_notice_content(),
				'display_on'  => array(
					'request' => array(
						array( 'key' => 'page', 'value' => 'wc-settings' ),
						array( 'key' => 'tab', 'value' => 'trscfp' ),
						array( 'key' => 'license', 'value' => 'free' ),
					)
				),
				'dismissible' => false
			) );

			// Premium notice
			$notices_manager->create_notice( array(
				'id'          => 'trscfp-premium-info-settings-page',
				'content'     => $this->get_premium_notice_content(),
				'display_on'  => array(
					'request' => array(
						array( 'key' => 'page', 'value' => 'wc-settings' ),
						array( 'key' => 'tab', 'value' => 'trscfp' ),
						array( 'key' => 'license', 'value' => 'free' ),
					)
				),
				'dismissible' => false
			) );
		}*/
	}
}