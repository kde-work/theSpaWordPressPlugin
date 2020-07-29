<?php
/**
 * THESPA_data Class.
 *
 * @package THESPA_data\Classes
 * @version 1.0.3
 */
defined( 'ABSPATH' ) || exit;

/**
 * Class THESPA_data
 */
class THESPA_data {

	/**
	 * Form data from database.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * List of devices.
	 *
	 * @var array
	 */
	private $devices = [];

	/**
	 * List of products.
	 *
	 * @var array
	 */
	private $products = [];

	/**
	 * THESPA_data Constructor.
	 */
	public function __construct() {
		$this->setup_data_from_db();
	}

	/**
	 * Data from data base into var $data.
	 *
	 * @return void
	 */
	private function setup_data_from_db() {
		global $wpdb;

		// get products
		$this->setup_products();

		// get 'devices'
		$this->devices = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}thespa_devices` as devices", ARRAY_A );

		// get 'volume'
		$this->data = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}thespa_volume` as volume", ARRAY_A );

		for ( $i = 0; $i < count( $this->data ); $i++ ) {
			// get 'chemical'
			$this->data[$i]['data'] = $wpdb->get_results(
				$wpdb->prepare( "
					SELECT * FROM `{$wpdb->prefix}thespa_chemical` as chemical
					WHERE chemical.`id_volume` = '%d'
				", $this->data[$i]['id'] ), ARRAY_A );

			for ( $j = 0; $j < count( $this->data[$i]['data'] ); $j++ ) {
				// get 'strip'
				$this->data[$i]['data'][$j]['data'] = $wpdb->get_results(
					$wpdb->prepare( "
					SELECT * FROM `{$wpdb->prefix}thespa_strip` as strip
					WHERE strip.`id_chemical` = '%d'
				", $this->data[$i]['data'][$j]['id'] ), ARRAY_A );

				for ( $k = 0; $k < count( $this->data[$i]['data'][$j]['data'] ); $k++ ) {
					// get 'data'
					$this->data[$i]['data'][$j]['data'][$k]['data'] = $wpdb->get_results(
						$wpdb->prepare( "
					SELECT * FROM `{$wpdb->prefix}thespa_data` as thespa_data
					WHERE thespa_data.`id_strip` = '%d'
				", $this->data[$i]['data'][$j]['data'][$k]['id'] ), ARRAY_A );
				}
			}
		}

		$this->add_test_type_level();
	}

	/**
	 * Fix $this->data. Add test_type level.
	 *
	 * @return void
	 */
	private function add_test_type_level() {
		for ( $i = 0; $i < count( $this->data ); $i++ ) {
			$bromine = [
				'id' => "1",
				'name' => 'AquaChek Bromine Test Strips',
				'data' => [],
			];
			$chlorine = [
				'id' => "2",
				'name' => 'AquaChek Chlorine Test Strips',
				'data' => [],
			];
			for ( $j = 0; $j < count( $this->data[$i]['data'] ); $j++ ) {
				$c = $this->data[$i]['data'][$j];
				if ( $c['test_type'] == 'bromine' OR $c['test_type'] == 'all' ) {
					array_push( $bromine['data'], $c );
				}
				if ( $c['test_type'] == 'chlorine' OR $c['test_type'] == 'all' ) {
					array_push( $chlorine['data'], $c );
				}
			}
			$this->data[$i]['data'] = [];
			if ( count( $bromine['data'] ) ) {
				array_push( $this->data[$i]['data'], $bromine );
			}
			if ( count( $chlorine['data'] ) ) {
				array_push( $this->data[$i]['data'], $chlorine );
			}
		}
	}

	/**
	 * Setup products list from `thespa_data`.`products`.
	 *
	 * @return void
	 */
	private function setup_products() {
		global $wpdb;

		$ids = [];
		$d = $wpdb->get_results( "SELECT distinct `products` FROM `{$wpdb->prefix}thespa_data`", ARRAY_A );
		foreach ( $d as $datum ) {
			$prs = explode( ",", $datum['products'] );
			foreach ( $prs as $pr ) {
				if ( !isset( $ids[$pr] ) ) {
					array_push($ids, $pr );
				}
			}
		}

		for ($i = 0; $i < count( $ids ); $i++ ) {
			$product = wc_get_product( $ids[$i] );
			$this->products[$i] = [
				'id' => $ids[$i],
				'name' => $product->get_title(),
				'url' => $product->get_permalink(),
				'img' => wp_get_attachment_image_src( get_post_thumbnail_id( $ids[$i] ), 'medium', true )[0],
				'cost' => $product->get_price_html(),
			];
		}
	}

	/**
	 * Return data.
	 *
	 * @return array
	 */
	public function get_data() {
		return apply_filters( 'THESPA_data', $this->data );
	}

	/**
	 * Return devices.
	 *
	 * @return array
	 */
	public function get_devices() {
		return apply_filters( 'THESPA_devices', $this->devices );
	}

	/**
	 * Return products.
	 *
	 * @return array
	 */
	public function get_products() {
		return apply_filters( 'THESPA_products', $this->products );
	}

	/**
	 * Return lit of 'type'.
	 *
	 * @param  string
	 * @return array
	 */
	public function get_list_of( $name ) {
		$data = [];
		switch ( $name ) {
			case 'volume':
				foreach ( $this->data as $datum ) {
					$data[] = [
						'id' => $datum['id'],
						'name' => $datum['name'],
					];
				}
				break;
			case 'devices':
			case 'device':
				$data = $this->get_devices();
				break;
			case 'products':
				$data = $this->get_products();
				break;
		}

		return apply_filters( 'THESPA_data_list_of', $data, $name );
	}
}