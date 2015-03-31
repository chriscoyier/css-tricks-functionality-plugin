<?php
/**
 * Add email feed
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Add_Email_Feed {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'css_tricks_custom_feeds' ) );
	}

	/**
     * Add the email feed
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	public function css_tricks_custom_feeds() {
		add_feed( 'email', array( $this, 'get_me_the_email_feed_template' ) );
	}
	
	/**
     * Add filter to the feed's content
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	public function get_me_the_email_feed_template() {
		add_filter( 'the_content_feed', array( $this, 'css_tricks_super_awesome_feed_image_magic' ) );
		include( ABSPATH . '/wp-includes/feed-rss2.php' );
	}

	/**
     * css_tricks_super_awesome_feed_image_magic. Nuff' Said!
     *
     * @since  1.0.0
     * @access public
     * @return string the feed content
     */
	public function css_tricks_super_awesome_feed_image_magic( $content ) {
		// Weirdness we need to add to strip the doctype with later.
		$content = '<div>' . $content . '</div>';
		$doc = new DOMDocument();
		$doc->LoadHTML($content);

		$images = $doc->getElementsByTagName( 'img' );
		foreach( $images as $image ) {
		  	$image->removeAttribute( 'height' );
		  	$image->setAttribute( 'width', '320' );
		  	$image->setAttribute( 'style', 'display: block;' );
		}

		$figures = $doc->getElementsByTagName( 'figure' );
		foreach( $figures as $figure ) {
		  	$figure->setAttribute( 'style', 'display: block; margin: 0 0 10px 0;' );
		}

		$iframes = $doc->getElementsByTagName( 'iframe' );
		foreach( $iframes as $iframe ) {
		  	$iframe->parentNode->removeChild( $iframe );
		}

		// Strip weird DOCTYPE that DOMDocument() adds in
		$content = substr( $doc->saveXML( $doc->getElementsByTagName( 'div' )->item( 0 ) ), 5, -6 );

		return $content;
	}
}