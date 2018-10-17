<?php
/**********************
* Plugin Name: Custom User Table
* Description: Display Sortable User Table in Dashboard, Filter Users as Per Role or Sort Username Alphabtically
* Author: Alisaleem252
* Version: 1.0
* Author URI: http://gigsix.com
* Textdomain: mascut
***********************/

define('MASTEXTDOMAIN','mascut');
define('MASCUTURL',plugin_dir_url(__FILE__));
define('MASCUTPATH', dirname(__FILE__) );

require_once(MASCUTPATH.'/admin/direct_ajaxcallback.php');
require_once(MASCUTPATH.'/admin/functions.php');


class CustomUserTable {

	function __construct(){
		add_action("admin_enqueue_scripts", array($this,"enqueue"));		
		// Hook for adding admin menus
		add_action('admin_menu', array($this,'mamcut_add_pages'));

		add_action( 'plugins_loaded', array($this,'mamcut_load_textdomain' ));
	}

	function enqueue()
	{
	        //replace with your page "id"
	    if($_GET["page"] == "mamcut-handle")
	    {
	        wp_enqueue_script("masangular", "//code.angularjs.org/1.3.0-rc.1/angular.min.js");
	        wp_enqueue_script("masangularapp", MASCUTURL .'admin/js/app.js',array('jquery','masangular'));
	        wp_enqueue_script("masbootstrap", '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',array('jquery','masangularapp'));

	        wp_enqueue_style( 'masadmin', MASCUTURL .'admin/css/admin.css' );
	        wp_enqueue_style( 'masbootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );       
	    }
	}
	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	function mamcut_load_textdomain() {
	  load_plugin_textdomain( 'mascut', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}
	function mamcut_add_pages(){
		 add_menu_page(__('Users Table','mascut'), __('Users Table','mascut'), 'manage_options', 'mamcut-handle', array(&$this,'mamcut_toplevel_page') ,'dashicons-admin-users');		
	}
	function mamcut_toplevel_page(){
		require_once('admin/menu-page.php');
	}

}

// Initialize Plugin
new UsersAngularAppAjax;
new CustomUserTable;