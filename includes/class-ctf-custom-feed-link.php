<?php
/**
 * Custom feed Link
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Custom_Feed_Link {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'feed_link', array( $this, 'custom_feed_link' ), 1, 2 );
	}

	/**
     * Remove WP generated content from the head
     *
     * @since  1.0.0
     * @access public
     * @return string return the output of th custom feed link
     */
	public function custom_feed_link( $output, $feed ) {
		$feed_url = 'http://feeds.feedburner.com/CssTricks';
		$feed_array = array(
			'rss'           => $feed_url,
			'rss2'          => $feed_url,
			'atom'          => $feed_url,
			'rdf'           => $feed_url,
			'comments_rss2' => ''
		);
		$feed_array[$feed] = $feed_url;
		$output = $feed_array[$feed];

		return $output;
	}
	
}