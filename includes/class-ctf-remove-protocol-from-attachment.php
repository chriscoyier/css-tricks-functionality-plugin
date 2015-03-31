<?php
/**
 * Remove the http/https protocols from attachments
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Remove_Protocol_From_Attachments {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'image_editor_save_pre', array( 'remove_protocol' ) );
	}

	/**
     * Remove the http/https protocols from attachments
     *
     * @since  1.0.0
     * @access public
     * @return string remove the http/https protocol
     */
	public function remove_protocol( $url ) {
	    $url = str_replace( array( 'http:', 'https:' ), '', $url );
	    return $url;
	}
}