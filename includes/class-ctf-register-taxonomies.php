<?php
/**
 * Register Custom Taxonomies
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

class CTF_Register_Taxonomies {

    /**
     * Initialize the class
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_gallerytags_taxonomy' ) );
    }

    /**
     * Register Gallerytags Taxonomy
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function register_gallerytags_taxonomy() {
        $gallery_tag_labels = array(
            'name'                       => _x( 'Gallery Tags', 'taxonomy general name' ),
            'singular_name'              => _x( 'Gallery Tag', 'taxonomy singular name' ),
            'search_items'               => __( 'Search Gallery Tags' ),
            'popular_items'              => __( 'Popular Gallery Tags' ),
            'all_items'                  => __( 'All Gallery Tags' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Gallery Tag' ),
            'update_item'                => __( 'Update Gallery Tag' ),
            'add_new_item'               => __( 'Add New Gallery Tag' ),
            'new_item_name'              => __( 'New Gallery Tag' ),
            'separate_items_with_commas' => __( 'Separate gallery tags with commas' ),
            'add_or_remove_items'        => __( 'Add or remove gallery tags' ),
            'choose_from_most_used'      => __( 'Choose from the most used gallery tags' ),
            'menu_name'                  => __( 'Gallery Tags' ),
        );
        register_taxonomy( "gallerytags", array( "screenshot" ), array(
                'labels'       => $gallery_tag_labels,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array(
                'slug'         => 'gallery/tag',
                'with_front'   => true,
                'heirarchical' => false
                )
            )
        );
    }
}
