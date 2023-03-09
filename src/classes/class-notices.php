<?php
/**
 * Remove Special Characters From Permalinks - Notices.
 *
 * @version 1.0.6
 * @since   1.0.3
 * @author  WPFactory
 */

namespace WPFactory\RSCFP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'WPFactory\RSCFP\Notices' ) ) {

	class Notices {
		/**
		 * init.
		 *
		 * @version 1.0.6
		 * @since   1.0.0
		 */
		public function init() {
			add_action( 'trscfp_on_activation', array( $this, 'add_promoting_notice' ) );
		}

		/**
		 * add_promoting_notice.
		 *
		 * @version 1.0.6
		 * @since   1.0.6
		 */
		function add_promoting_notice() {
			$promoting_notice = wpfactory_promoting_notice();
			$promoting_notice->set_args( array(
				'url_requirements'              => array(
					'page_filename' => 'plugins.php',
					//'params'        => array( 'plugin' => 'remove-special-characters-from-permalinks' ),
				),
				//'enable'                        => true === apply_filters( 'alg_wc_cog_settings', true ),
				'enable'                        => true,
				'optimize_plugin_icon_contrast' => true,
				'template_variables'            => array(
					'%notice_class%'       => 'wpfactory-promoting-notice notice notice-info',
					'%pro_version_url%'    => 'https://wpfactory.com/item/remove-special-characters-from-permalinks-wordpress-plugin/',
					'%plugin_icon_url%'    => 'https://ps.w.org/remove-special-characters-from-permalinks/assets/icon-128x128.png?rev=1884298',
					'%pro_version_title%'  => __( 'Remove Special Characters From Permalinks Pro', 'remove-special-characters-from-permalinks' ),
					'%main_text%'          => __( 'Upgrade to <a href="%pro_version_url%" target="_blank"><strong>%pro_version_title%</strong></a> to remove special characters from all permalinks at once.', 'remove-special-characters-from-permalinks' ),
					'%btn_call_to_action%' => __( 'Upgrade to Pro version', 'remove-special-characters-from-permalinks' ),
				),
			) );
			$promoting_notice->init();
		}
	}
}