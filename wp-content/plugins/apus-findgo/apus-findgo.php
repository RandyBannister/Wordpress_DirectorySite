<?php
/**
 * Plugin Name: Apus Findgo
 * Plugin URI: http://apusthemes.com/apus-findgo/
 * Description: Apus Findgo is a plugin for Findgo directory listing theme
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.1
 *
 * Text Domain: apus-findgo
 * Domain Path: /languages/
 *
 * @package apus-findgo
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusFindgo") ) {
	
	final class ApusFindgo {

		private static $instance;

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusFindgo ) ) {
				self::$instance = new ApusFindgo;
				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){
			
			// Plugin Folder Path
			if ( ! defined( 'APUSFINDGO_PLUGIN_DIR' ) ) {
				define( 'APUSFINDGO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSFINDGO_PLUGIN_URL' ) ) {
				define( 'APUSFINDGO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSFINDGO_PLUGIN_FILE' ) ) {
				define( 'APUSFINDGO_PLUGIN_FILE', __FILE__ );
			}

			// Prefix
			if ( ! defined( 'APUSFINDGO_PREFIX' ) ) {
				define( 'APUSFINDGO_PREFIX', 'apus_findgo_' );
			}
		}

		public function includes() {
			// cmb2 custom field
			if ( ! class_exists( 'Taxonomy_MetaData_CMB2' ) ) {
				require_once APUSFINDGO_PLUGIN_DIR . 'inc/vendors/cmb2/taxonomy/Taxonomy_MetaData_CMB2.php';
			}
			require_once APUSFINDGO_PLUGIN_DIR . 'inc/mixes-functions.php';
			
			require_once APUSFINDGO_PLUGIN_DIR . 'inc/class-template-loader.php';
			require_once APUSFINDGO_PLUGIN_DIR . 'inc/class-claim.php';
			

			apusfindgo_includes( APUSFINDGO_PLUGIN_DIR . 'inc/taxonomies/*.php' );
			apusfindgo_includes( APUSFINDGO_PLUGIN_DIR . 'inc/post-types/*.php' );

			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		}
		public function scripts() {
			wp_register_script( 'apusfindgo-scripts', APUSFINDGO_PLUGIN_URL . 'assets/scripts.js', array( 'jquery' ), '', true );

			wp_localize_script( 'apusfindgo-scripts', 'apusfindgo_vars', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			));
			wp_enqueue_script( 'apusfindgo-scripts' );
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusFindgo's languages directory
			$lang_dir = dirname( plugin_basename( APUSFINDGO_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apusfindgo_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-findgo' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-findgo', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-findgo/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apus-findgo folder
				load_textdomain( 'apus-findgo', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apus-findgo/languages/ folder
				load_textdomain( 'apus-findgo', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-findgo', false, $lang_dir );
			}
		}
	}
}

function ApusFindgo() {
	return ApusFindgo::getInstance();
}

ApusFindgo();
