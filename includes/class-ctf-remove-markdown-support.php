<?php
/**
 * Remove Jetpack Markdwon Support
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Remove_Markdown_Support {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'remove_markdown_support' ), 12 );
	}

	/**
     * Remove Jetpack Markdwon Support
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	public function remove_markdown_support() {
		if (class_exists('WPCom_Markdown')) {
			remove_post_type_support( 'post'    , WPCom_Markdown::POST_TYPE_SUPPORT );
			remove_post_type_support( 'page'    , WPCom_Markdown::POST_TYPE_SUPPORT );
			remove_post_type_support( 'revision', WPCom_Markdown::POST_TYPE_SUPPORT );
		}
	}
}