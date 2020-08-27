<?php
/**
 * THESPA_Requests Class.
 *
 * @package THESPA_waterTesting\Classes
 * @version 1.0.8
 */
defined( 'ABSPATH' ) || exit;

/**
 * Class THESPA_Requests
 */
class THESPA_Requests {

	/**
	 * Save form.
	 */
	public static function save() {
		if ( !empty( $_POST ) AND isset( $_POST['data'] ) AND wp_verify_nonce( $_POST['nonce'], 'thespashoppe' ) ) {
			global $wpdb;

			$data = $_POST['data'];
			$js_id = $data['id'];
			$user_id = get_current_user_id();

			if( !$js_id ) {
				echo json_encode( ['data' => $data, 'error' => 'empty JS ID'] );
				die;
			}

			$exist_id = $wpdb->get_var(
				$wpdb->prepare( "
						SELECT `id` FROM `{$wpdb->prefix}spa_sessions`
						WHERE `user_id` = '%d' AND `js_id` = '%s'
					", $user_id, $js_id ) );

			if( !$exist_id ) {
				$q = $wpdb->query(
					$wpdb->prepare( "
						INSERT INTO `{$wpdb->prefix}spa_sessions` SET
						`user_id` = '%d',
						`js_id` = '%s',
						`data` = '%s'
					", $user_id, $js_id, json_encode( $data ) ) );

				if ( $q ) {
					echo json_encode( ['html' => THESPA_shortcodes::getSaves(), 'data' => $data, 'success' => '1'] );
					die;
				}
			} else {
				$q = $wpdb->query(
					$wpdb->prepare( "
					UPDATE `{$wpdb->prefix}spa_sessions` SET
						`data` = '%s'
						WHERE `id` = '%d' 
					", json_encode( $data ), $exist_id ) );

				if ( $q ) {
					echo json_encode( ['html' => THESPA_shortcodes::getSaves(), 'data' => $data, 'success' => '2'] );
				} else {
					echo json_encode( ['data' => $data, 'error' => 'already exist'] );
				}
				die;
			}

			echo json_encode( ['data' => $data, 'error' => 'data base error'] );
			die;
		}

		echo json_encode( ['error' => 'nonce error'] );
		die;
	}

	/**
	 * Remove test.
	 */
	public static function remove_test() {
		if ( !empty( $_POST ) AND isset( $_POST['js_id'] ) AND wp_verify_nonce( $_POST['nonce'], 'thespashoppe' ) ) {
			global $wpdb;

			$js_id = $_POST['js_id'];
			$user_id = get_current_user_id();

			if( !$js_id ) {
				echo json_encode( ['error' => 'empty JS ID'] );
				die;
			}

			$q = $wpdb->query(
				$wpdb->prepare( "
					UPDATE `{$wpdb->prefix}spa_sessions` SET
						`is_remove` = '1'
						WHERE `user_id` = '%d' AND `js_id` = '%s'
					", $user_id, $js_id ) );

			if ( $q ) {
				echo json_encode( ['success' => 'remove 1'] );
				die;
			}

			echo json_encode( ['error' => 'not remove'] );
			die;
		}

		echo json_encode( ['error' => 'nonce error'] );
		die;
	}
}