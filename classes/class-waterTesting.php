<?php
/**
 * THESPA_waterTesting Class.
 *
 * @package THESPA_waterTesting\Classes
 * @version 1.0.3
 */
defined( 'ABSPATH' ) || exit;

/**
 * Class THESPA_waterTesting
 */
class THESPA_waterTesting {

	/**
	 * THESPA_waterTesting version.
	 *
	 * @var string
	 */
	public $version = '1.0.3';

	/**
	 * The single instance of the class.
	 *
	 * @var THESPA_waterTesting
	 */
	protected static $_instance = null;

	/**
	 * THESPA_waterTesting Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
		$this->init_shortcodes();

		do_action( 'THESPA_waterTesting_loaded' );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		if ( $this->is_request( 'admin' ) ) {
//			include_once THESPA_PLUGIN_DIR . 'classes/admin/class-epme-admin.php';
		}

		/**
		 * Core classes.
		 */
		include_once THESPA_PLUGIN_DIR . 'classes/class-shortCodes.php';
		include_once THESPA_PLUGIN_DIR . 'classes/class-media.php';
		include_once THESPA_PLUGIN_DIR . 'classes/class-data.php';
	}

	/**
	 * Main THESPA_waterTesting Instance.
	 *
	 * Ensures only one instance of THESPA_waterTesting is loaded or can be loaded.
	 *
	 * @static
	 * @see THESPA_EP()
	 * @return THESPA_waterTesting - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Init shortcodes.
	 */
	public function init_shortcodes () {
		add_shortcode( 'waterTesting', array( 'THESPA_shortCodes', 'waterTesting' ) );
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
//		add_action( 'wp_ajax_nopriv_easyping_sign_in', array( 'THESPA_Requests', 'sign_in_easyping' ), 10 );
//		add_action( 'wp_ajax_nopriv_easyping_add_funds', array( 'THESPA_Requests', 'add_funds' ), 20 );
//		add_action( 'wp_ajax_nopriv_easyping_oauth_url', array( 'THESPA_Requests', 'easyping_oauth_url' ), 30 );

		add_action( 'wp_enqueue_scripts', array( 'THESPA_media', 'register' ), 10 );

//		add_action( 'admin_enqueue_scripts', array( 'THESPA_Media', 'register' ), 10 );
//		add_action( 'admin_enqueue_scripts', array( 'THESPA_Admin_Output', 'register' ), 20 );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Define THESPA_waterTesting Constants.
	 */
	private function define_constants() {
		$this->define( 'THESPA_ASSETS_DIR', THESPA_PLUGIN_DIR . 'assets' );
		$this->define( 'THESPA_ASSETS_URL', get_option( 'siteurl' ) . str_replace( str_replace( '\\', '/', ABSPATH ), '/', THESPA_ASSETS_DIR ) );
		$this->define( 'THESPA_VERSION', $this->version );
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! defined( 'REST_REQUEST' );
		}
		return false;
	}
}