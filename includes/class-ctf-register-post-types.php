<?php
/**
 * Register custom post types
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

class CFT_Register_Post_Types {

    /**
     * Initialize the class
     */
    public function __construct() {
       add_action( 'init', array( $this, 'register_screenshots_post_type' ) );
    }


    /**
     * Register Screenshots Post Type
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function register_screenshots_post_type() {
        register_post_type( 'screenshot',
            array(
                'labels'        => array(
                'name'          => __( 'Screenshots' ),
                'singular_name' => __( 'Screenshot' ),
                'add_new'       => __( 'Add Screenshot' ),
                'add_new_item'  => __( 'Add New Screenshot' ),
                'edit_item'     => __( 'Edit Screenshot' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'gallery' ),
            'supports'    => array( 'title', 'editor', 'custom-fields', 'comments' ),
            'taxonomies'  => array( 'gallerytags' )
            )
        );
    }
}
