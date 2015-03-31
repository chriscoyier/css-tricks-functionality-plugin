<?php
/**
 * Main Init Class
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class CTF_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$register_post_types     = new CFT_Register_Post_Types();
		$register_taxonomies     = new CTF_Register_Taxonomies();
		$remove_admin_bar 	     = new CTF_Remove_Admin_Bar();
		$clean_up_head		     = new CTF_Clean_Up_Head();
		$close_coments		     = new CTF_Close_Comments();
		$custom_feed_link	     = new CTF_Custom_Feed_Link();
		$insert_figure		     = new CTF_Insert_Figure();
		$auto_renew			     = new CTF_RCP_Auto_Renew();
		$long_url_spam		     = new CTF_Long_URL_Spam();
		$remove_jetpack_bar      = new CTF_Remove_Jetpack_Bar();
		$add_mime_types		     = new CTF_Add_Mime_Types();
		$remove_markdown_support = new CTF_Remove_Markdown_Support();
		$add_email_feed			 = new CTF_Add_Email_Feed();
		$increase_form_limit	 = new CTF_Increase_Postmeta_Form_Limit();
		$limit_users_delete		 = new CTF_Limit_Users_Delete();
		$remove_assets			 = new CTF_Remove_Unwated_Assets();
		$remove_post_author_url  = new CTF_Remove_Post_Author_Url();
		$allowed_tags			 = new CTF_Allowed_Tags();
		
	}

}