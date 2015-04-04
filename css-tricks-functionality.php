<?php
/**
 * @package     CTF
 * @link      	https://github.com/jawittdesigns/
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 *
 * @wordpress-plugin
 * Plugin Name:       CSS-Tricks Functionality
 * Plugin URI:        https://github.com/jawittdesigns/
 * Description:       Custom functionality plugin for css-tricks.com
 * Version:           1.0.0
 * Author:            Jason Witt
 * Author URI:        http://jawittdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}
if( !class_exists( 'CTF' ) ) {
	class CTF {

		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of CTF class
		 */
		private static $instance;

		/**
		 * Instance of the plugin
		 *
		 * @since 1.0.0
		 * @static
		 * @staticvar array $instance
		 * @return Instance
		 */
		public static function instance() {
			if ( !isset( self::$instance ) && ! ( self::$instance instanceof CTF ) ) {
				self::$instance = new CTF;
				self::$instance->define_constants();
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				self::$instance->includes();
				self::$instance->init = new CTF_Init();
			}
		return self::$instance;
		}

		/**
		 * Define the plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function define_constants() {
			// Plugin Version
			if ( ! defined( 'CTF_VERSION' ) ) {
				define( 'CTF_VERSION', '1.0.0' );
			}
			// Prefix
			if ( ! defined( 'CTF_PREFIX' ) ) {
				define( 'CTF_PREFIX', 'ctf_' );
			}
			// Textdomain
			if ( ! defined( 'CTF_TEXTDOMAIN' ) ) {
				define( 'CTF_TEXTDOMAIN', 'ctf' );
			}
			// Plugin Options
			if ( ! defined( 'CTF_OPTIONS' ) ) {
				define( 'CTF_OPTIONS', 'ctf-options' );
			}
			// Plugin Directory
			if ( ! defined( 'CTF_PLUGIN_DIR' ) ) {
				define( 'CTF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			// Plugin URL
			if ( ! defined( 'CTF_PLUGIN_URL' ) ) {
				define( 'CTF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			// Plugin Root File
			if ( ! defined( 'CTF_PLUGIN_FILE' ) ) {
				define( 'CTF_PLUGIN_FILE', __FILE__ );
			}
		}

		/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-register-post-types.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-register-taxonomies.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-remove-admin-bar.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-clean-up-head.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-close-comments.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-custom-feed-link.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-insert-figure.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-rcp-auto-renew.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-long-url-spam.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-remove-jetpack-bar.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-add-mime-types.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-remove-markdown-support.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-add-email-feed.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-increase-postmeta-form-limit.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-limit-users-delete.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-remove-unwanted-assets.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-remove-post-author-url.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-custom-pagi.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-allowed-tags.php';


			require_once CTF_PLUGIN_DIR . 'includes/template-functions.php';
			require_once CTF_PLUGIN_DIR . 'includes/class-ctf-init.php';
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function load_textdomain() {
			$ctf_lang_dir = dirname( plugin_basename( CTF_PLUGIN_FILE ) ) . '/languages/';
			$ctf_lang_dir = apply_filters( 'CTF_lang_dir', $ctf_lang_dir );

			$locale = apply_filters( 'plugin_locale',  get_locale(), CTF_TEXTDOMAIN );
			$mofile = sprintf( '%1$s-%2$s.mo', CTF_TEXTDOMAIN, $locale );

			$mofile_local  = $ctf_lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/edd/' . $mofile;

			if ( file_exists( $mofile_local ) ) {
				load_textdomain( CTF_TEXTDOMAIN, $mofile_local );
			} else {
				load_plugin_textdomain( CTF_TEXTDOMAIN, false, $ctf_lang_dir );
			}
		}

		/**
		 * Throw error on object clone
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', CTF_TEXTDOMAIN ), '1.6' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', CTF_TEXTDOMAIN ), '1.6' );
		}

	}
}
/**
 * Return the instance
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function CTF_Run() {
	return CTF::instance();
}
CTF_Run();
