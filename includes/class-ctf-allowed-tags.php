<?php
/**
 * Add additional html tag for the bbPress Forums
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */
class CTF_Allowed_Tags {

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
        add_filter( 'bbp_kses_allowed_tags', array( $this, 'allowed_tags_bbpress'), 999, 1);
        add_action( 'init', array($this, 'allowed_comment_tags' ) );
    }

    /**
     * Allower bbPress Tags
     *
     * @since  1.0.0
     * @access public
     * @return array the allowed tags array
     */
    public function allowed_tags_bbpress( $input ){
        return array_merge( $input, array(
              // paragraphs
              'p' => array(
                'style'     => array()
              ),
              'span' => array(
                'style'     => array()
              ),
              'div' => array(
                'style'     => array()
              ),

              // Links
              'a' => array(
                'href'     => array(),
                'title'    => array(),
                'rel'      => array()
              )
        ));
    }

    /**
     * Allower comment Tags
     *
     * @since  1.0.0
     * @access public
     * @return array the allowed tags array
     */
    public function allowed_comment_tags() {
        global $allowedtags;
        if( !array_key_exists( 'pre', $allowedtags ) ) {
            $allowedtags['pre'] = array();
        }
    }
}