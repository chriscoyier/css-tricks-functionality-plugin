<?php
/**
 * Mark long urls as spam
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Long_URL_Spam {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'pre_comment_approved', array( $this, 'url_spamcheck' ), 99, 2 );
	}

	/**
     * Mark posts with long URL's as spam
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function url_spamcheck( $approved , $commentdata ) {
		return ( strlen( $commentdata['comment_author_url'] ) > 50 ) ? 'spam' : $approved;
	}
}