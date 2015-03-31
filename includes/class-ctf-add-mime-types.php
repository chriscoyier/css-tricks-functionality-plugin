<?php
/**
 * Add new mime types
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Add_Mime_Types {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'upload_mimes', array( $this, 'add_svg' ) );
	}

	/**
     * Add SVG mime type
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function add_svg( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	
}