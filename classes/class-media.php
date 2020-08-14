<?php
/**
 * Media management Class.
 *
 * @package THESPA_waterTesting\Classes
 * @version 1.0.5
 */
defined( 'ABSPATH' ) || exit;

/**
 * THESPA_Media Class.
 */
class THESPA_Media {

	/**
	 * Register Media.
	 */
	public static function register() {
		wp_register_style( 'thespashoppe-water-testing-style', plugins_url( '/assets/css/thespashoppe-water-testing.css', THESPA_ASSETS_DIR ), null, THESPA_VERSION );
		wp_register_style( 'select2-style', plugins_url( '/assets/css/select2.min.css', THESPA_ASSETS_DIR ), null, THESPA_VERSION );
		wp_register_script( 'thespashoppe-water-testing', plugins_url( '/assets/js/thespashoppe-water-testing.js', THESPA_ASSETS_DIR ), null, THESPA_VERSION );
		wp_register_script( 'thespashoppe-template', plugins_url( '/assets/js/thespashoppe-template.js', THESPA_ASSETS_DIR ), null, THESPA_VERSION );
		wp_register_script( 'select2', plugins_url( '/assets/js/select2.min.js', THESPA_ASSETS_DIR ), null, THESPA_VERSION );
	}

	/**
	 * Resources.
	 */
	public static function resources() {
		wp_enqueue_style('select2-style');
		wp_enqueue_style('thespashoppe-water-testing-style');
		wp_enqueue_script('select2');
		wp_enqueue_script('thespashoppe-template');
		wp_enqueue_script('thespashoppe-water-testing');
	}
}
