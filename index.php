<?php
/**********************
* Plugin Name: Custom User Table
* Description: Display Sortable User Table in Dashboard, Filter Users as Per Role or Sort Username Alphabtically
* Author: Alisaleem252
* Version: 1.0
* Author URI: http://gigsix.com
* License: GPLv2
***********************/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Define some Constants to use later
define('MASTEXTDOMAIN','mascut');
define('MASCUTURL',plugin_dir_url(__FILE__));
define('MASCUTPATH', dirname(__FILE__) );

// Require WP AJAX CALLBACKS
require_once(MASCUTPATH.'/admin/direct_ajaxcallback.php');
// Require some custom functions
require_once(MASCUTPATH.'/admin/functions.php');


class CustomUserTable {

	function __construct(){
		// Hook to enqueue admin scripts
		add_action("admin_enqueue_scripts", array($this,"enqueue"));		
		// Hook for adding admin menus
		add_action('admin_menu', array($this,'mamcut_add_pages'));
	}
	/******************************
	* Enqueue Scripts Callback Function
	******************************/
	function enqueue()
	{
	     //Only Enqueue the script if we are on our menu page
	    if($_GET["page"] == "mamcut-handle")
	    {
	    	// Enqueue Scripts
	        wp_enqueue_script("masangular", "//code.angularjs.org/1.3.0-rc.1/angular.min.js");
	        wp_enqueue_script("masangularapp", MASCUTURL .'admin/js/app.js?v=1',array('jquery','masangular'));
	        wp_enqueue_script("masbootstrap", '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',array('jquery','masangularapp'));
	        // Enqueue Styles
	        wp_enqueue_style( 'masadmin', MASCUTURL .'admin/css/admin.css' );
	        wp_enqueue_style( 'masbootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );       
	    }
	}

	/******************************
	*. Adding Admin Menu Callback Function
	******************************/
	function mamcut_add_pages(){
		 add_menu_page(__('Users Table','mascut'), __('Users Table','mascut'), 'manage_options', 'mamcut-handle', array(&$this,'mamcut_toplevel_page') ,'dashicons-admin-users');		
	}

	/******************************
	*. Admin Menu Page Callback Function
	******************************/
	function mamcut_toplevel_page(){
		require_once('admin/menu-page.php');
	}

}

// Initialize Plugin
new UsersAngularAppAjax;
new CustomUserTable;