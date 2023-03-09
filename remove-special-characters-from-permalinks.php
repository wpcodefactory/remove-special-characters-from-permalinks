<?php
/**
 * Plugin Name: Remove Special Characters From Permalinks
 * Plugin URI: https://wordpress.org/plugins/remove-special-characters-from-permalinks/
 * Description: Removes special characters from permalinks.
 * Version: 1.0.6
 * Author: WPFactory
 * Author URI: https://wpfactory.com
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: remove-special-characters-from-permalinks
 * Domain Path: /src/languages
 * Copyright: © 2023 WPFactory
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! function_exists( 'trscfp_is_plugin_active' ) ) {
	/**
	 * trscfp_is_plugin_active.
	 *
	 * @version 1.0.6
	 * @since   1.0.6
	 */
	function trscfp_is_plugin_active( $plugin ) {
		return ( function_exists( 'is_plugin_active' ) ? is_plugin_active( $plugin ) :
			(
				in_array( $plugin, apply_filters( 'active_plugins', ( array ) get_option( 'active_plugins', array() ) ) ) ||
				( is_multisite() && array_key_exists( $plugin, ( array ) get_site_option( 'active_sitewide_plugins', array() ) ) )
			)
		);
	}
}

// Check for active plugins
if (
	! trscfp_is_plugin_active( 'woocommerce/woocommerce.php' ) ||
	( 'remove-special-characters-from-permalinks' === basename( __FILE__ ) && trscfp_is_plugin_active( 'remove-special-characters-from-permalinks-pro/remove-special-characters-from-permalinks-pro.php' ) )
) {
	return;
}

// Composer autoload
if ( ! class_exists( '\WPFactory\RSCFP\Core' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
}

$plugin = \WPFactory\RSCFP\Core::instance();
$plugin->setup( array(
	'path' => __FILE__
) );
if ( true === apply_filters( 'trscfp_init', true ) ) {
	$plugin->init();
}

// Custom deactivation/activation hooks.
$activation_hook   = 'trscfp_on_activation';
$deactivation_hook = 'trscfp_on_deactivation';
register_activation_hook( __FILE__, function () use ( $activation_hook ) {
	add_option( $activation_hook, 'yes' );
} );
register_deactivation_hook( __FILE__, function () use ( $deactivation_hook ) {
	do_action( $deactivation_hook );
} );
add_action( 'admin_init', function () use ( $activation_hook ) {
	if ( is_admin() && get_option( $activation_hook ) === 'yes' ) {
		delete_option( $activation_hook );
		do_action( $activation_hook );
	}
} );