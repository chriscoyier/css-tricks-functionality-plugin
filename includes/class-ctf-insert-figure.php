<?php
/**
 * Insert the figure tag to attched images in posts
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Insert_Figure {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'image_send_to_editor', array( $this, 'insert_figure' ), 10, 9 );
	}
	
	/**
     * Insert the figure tag to attched images in posts
     *
     * @since  1.0.0
     * @access public
     * @return string return custom output for inserted images in posts
     */
	public function insert_figure($html, $id, $caption, $title, $align, $url) {
		// remove protocol
		$url = str_replace(array('http://','https://'), '//', $url);
		$html5 = "<figure id='post-$id' class='align-$align media-$id'>";
		$html5 .= "<img src='$url' alt='$title' />";
		if ($caption) {
		  	$html5 .= "<figcaption>$caption</figcaption>";
		}
		$html5 .= "</figure>";
		return $html5;
	}
}