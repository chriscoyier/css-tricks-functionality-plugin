<?php
/**
 * Custom auto renew Functionality
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_RCP_Auto_Renew {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'gpp_rcp_remove_auto_renew' ), 999 );
			add_filter( 'rcp_subscription_data', array( $this, 'rcp_force_auto_renew' ) );
	}

	/**
     * Remove the rcp_before_registration_submit_field action
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function gpp_rcp_remove_auto_renew() {
		remove_action( 'rcp_before_registration_submit_field', 'rcp_add_auto_renew' );
	}

	/**
     * Force Auto renew
     *
     * @since  1.0.0
     * @access public
     * @return array adjusted $data array
     */
	public function rcp_force_auto_renew( $data ) {
		$data['auto_renew'] = true;
		return $data;
	}
		
}