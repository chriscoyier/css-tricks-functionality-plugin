<?php
/**
 * Limit Users Delete
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Limit_Users_Delete {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'pre_user_query', array( $this, 'rkv_limit_users_delete' ) );
	}

	/**
     * Limit users delete
     *
     * @since  1.0.0
     * @access public
     * @return obj the query
     */
	public function rkv_limit_users_delete( $query ) {

		// call the global DB class
		global $wpdb;
		// first fetch the screen
		$screen = get_current_screen();
		// bail if we aren't on our user screen
		if ( ! is_object( $screen ) || empty( $screen->base ) || ! empty( $screen->base ) && $screen->base != 'users' ) {
		  	return $query;
		}
		// check that we are on our delete call
		if ( ! isset( $_REQUEST['action'] ) || ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] != 'delete' ) {
		  	return $query;
		}
		// get our current user
		$user_id  = get_current_user_id();
		// modify our where clause to include the user ID
		$query->query_where .= $wpdb->prepare( " AND $wpdb->users.ID = %d ", absint( $user_id ) );
		// send it back
		return $query;
	}

}