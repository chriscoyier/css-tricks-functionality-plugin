<?php
/**
 * Remove Jetpack menu bar
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Remove_Jetpack_Bar {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'jp_rm_menu' ) );
	}

	/**
     * Remove Jetpack menu bar
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	function jp_rm_menu() {
		if( class_exists( 'Jetpack' ) && !current_user_can( 'manage_options' ) ) {
			remove_menu_page( 'jetpack' );
		}
	}
}