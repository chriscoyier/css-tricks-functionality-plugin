<?php
/**
 * Remove unwanted assets
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Remove_Unwated_Assets {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		
		add_action( 'wp_enqueue_scripts', array( $this, 'turn_off_stuff' ), 9999 );
		// Make sure Jetpack doesn't concatenate all its CSS
		add_filter( 'jetpack_implode_frontend_css', '__return_false' );
		add_action( 'wp_print_styles', array( $this, 'jeherve_remove_all_jp_css' ) );
	}

	/**
     * Cleaning up assets loaded
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	function turn_off_stuff() {
		wp_dequeue_style('bbp-child-bbpress');
		wp_dequeue_style('wp-polls');
		wp_dequeue_script('devicepx');
	}
	
	/**
     * Remove each Jetpack CSS file, one at a time
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	function jeherve_remove_all_jp_css() {
		wp_deregister_style( 'AtD_style' ); // After the Deadline
		wp_deregister_style( 'jetpack_likes' ); // Likes
		wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
		wp_deregister_style( 'jetpack-carousel' ); // Carousel
		wp_deregister_style( 'grunion.css' ); // Grunion contact form
		wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
		wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
		wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
		wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
		wp_deregister_style( 'noticons' ); // Notes
		wp_deregister_style( 'post-by-email' ); // Post by Email
		wp_deregister_style( 'publicize' ); // Publicize
		wp_deregister_style( 'sharedaddy' ); // Sharedaddy
		wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
		wp_deregister_style( 'stats_reports_css' ); // Stats
		wp_deregister_style( 'jetpack-widgets' ); // Widgets
		wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
		wp_deregister_style( 'presentations' ); // Presentation shortcode
		wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
		wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
		wp_deregister_style( 'widget-conditions' ); // Widget Visibility
		wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
		wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
		wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
		wp_deregister_style( 'jetpack-widgets' ); // Widgets
	}
	
}