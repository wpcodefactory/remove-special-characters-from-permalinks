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

require_once "vendor/autoload.php";

$plugin = \WPFactory\RSCFP\Core::instance();
$plugin->setup( array(
	'path' => __FILE__
) );
if ( true === apply_filters( 'trscfp_init', true ) ) {
	$plugin->init();
}