<?php
/**
 * Increase the post meta form limit
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Increase_Postmeta_Form_Limit {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'postmeta_form_limit', array( $this, 'customfield_limit_increase' ) );
	}

	/**
     * Increase the filed limit
     *
     * @since  1.0.0
     * @access public
     * @return int the field limit
     */
	public function customfield_limit_increase( $limit ) {
		$limit = 100;
		return $limit;
	}

}