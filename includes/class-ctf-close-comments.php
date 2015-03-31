<?php
/**
 * Close comments for old posts
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Close_Comments {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'comments_open', array( $this, 'close_comments' ), 10, 2 );
		add_filter( 'pings_open',    array( $this, 'close_comments' ), 10, 2 );
	}

	/**
     * Remove WP generated content from the head
     *
     * @since  1.0.0
     * @access public
     * @return bool return true if post meets the conditions
     */
	function close_comments( $open, $post_id, $template = 'page-snippet.php' ) {
		global $wp_query;
		if ( !$post_id ) {
			$post_id = $wp_query->post->ID;
		}
		if ( get_post_meta($post_id, '_wp_page_template', true) == $template && get_option('close_comments_for_old_posts') ) {
			return true;
		}
		return $open;
	}
	
}