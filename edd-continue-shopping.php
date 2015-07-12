<?php
/*
 * Plugin Name: Easy Digital Downloads - Continue Shopping
 * Plugin URI: https://wordpress.org/plugins/easy-digital-downloads-continue-shopping/
 * Description: Adds a Continue Shopping link to the Easy Digital Downloads checkout cart.
 * Version: 1.0.1
 * Author: Sean Davis
 * Author URI: http://sdavismedia.com
 * Text Domain: edd-continue-shopping
 * Domain Path: /languages/
 *
 * @package         EDD\Continue Shopping
 * @author          Sean Davis
*/

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'EDD_Continue_Shopping' ) ) {

	/**
	 * Main plugin class
	 *
	 * @since 1.0.0
	 */
	class EDD_Continue_Shopping {

		/**
		 * @var         EDD_Continue_Shopping $instance The one true EDD_Continue_Shopping
		 * @since       1.0.0
		 */
		private static $instance;

		/**
		 * Get active instance
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      object self::$instance The one true EDD_Continue_Shopping
		 */
		public static function instance() {
			if( !self::$instance ) {
				self::$instance = new EDD_Continue_Shopping();
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->load_textdomain();
				self::$instance->hooks();
			}
			return self::$instance;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function setup_constants() {

			// Plugin version
			define( 'EDD_CONTINUE_SHOPPING_VER', '1.0.1' );

			// Plugin path
			define( 'EDD_CONTINUE_SHOPPING_DIR', plugin_dir_path( __FILE__ ) );

			// Plugin URL
			define( 'EDD_CONTINUE_SHOPPING_URL', plugin_dir_url( __FILE__ ) );
		}

		/**
		 * Include necessary files
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */ 
		private function includes() {

			// Include functions
			require_once EDD_CONTINUE_SHOPPING_DIR . 'includes/functions.php';
			if( is_admin() ) {
				require_once EDD_CONTINUE_SHOPPING_DIR . 'includes/settings.php';
			}
		}

		/**
		 * Run action and filter hooks
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function hooks() {

			// Handle licensing
			if( class_exists( 'EDD_License' ) ) {
			    $license = new EDD_License( __FILE__, 'Easy Digital Downloads - Continue Shopping', EDD_CONTINUE_SHOPPING_VER, 'Sean Davis' );
			}
		}

		/**
		 * Internationalization
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public function load_textdomain() {

			// Set filter for language directory
			$lang_dir = EDD_CONTINUE_SHOPPING_DIR . '/languages/';
			$lang_dir = apply_filters( 'edd_continue_shopping_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'edd-continue-shopping' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'edd-continue-shopping', $locale );

			// Setup paths to current locale file
			$mofile_local   = $lang_dir . $mofile;
			$mofile_global  = WP_LANG_DIR . '/edd-continue-shopping/' . $mofile;

			if( file_exists( $mofile_global ) ) {

				// Look in global /wp-content/languages/edd-continue-shopping/ folder
				load_textdomain( 'edd-continue-shopping', $mofile_global );
			} elseif( file_exists( $mofile_local ) ) {

				// Look in local /wp-content/plugins/edd-continue-shopping/languages/ folder
				load_textdomain( 'edd-continue-shopping', $mofile_local );
			} else {

				// Load the default language files
				load_plugin_textdomain( 'edd-continue-shopping', false, $lang_dir );
			}
		}
	}
}

/**
 * The main function responsible for returning the one true EDD_Continue_Shopping
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \EDD_Continue_Shopping The one true EDD_Continue_Shopping
 */
function EDD_Continue_Shopping_load() {
	if( !class_exists( 'Easy_Digital_Downloads' ) ) {
		if( !class_exists( 'EDD_Continue_Shopping_Activation' ) ) {
			require_once 'includes/class.edd-continue-shopping-activation.php';
		}
		$activation = new EDD_Continue_Shopping_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
		$activation = $activation->run();
		return EDD_Continue_Shopping::instance();
	} else {
		return EDD_Continue_Shopping::instance();
	}
}
add_action( 'plugins_loaded', 'EDD_Continue_Shopping_load' );