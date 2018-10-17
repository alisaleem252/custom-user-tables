<?php
/*****
*. Class to Register Our AJAX Requests used by Angular JS in our Menu Page
******/
class UsersAngularAppAjax {
	function __construct(){
		// WP Ajax Hook to get users
		add_action( 'wp_ajax_mam_get_user_as_per_role', array($this,'mam_get_user_as_per_roleCBF' ));
		// WP Ajax hook to get pagination variables
		add_action( 'wp_ajax_mamcut_get_pagination', array($this,'mamcut_get_paginationCBF' ));
	}
	/*****
	*. Method to Get WP Users by Role with offset
	******/
	function mam_get_user_as_per_roleCBF() {
		if( !current_user_can('administrator') )
			exit;

		header('Content-Type:application/javascript');
		$user_role = isset($_REQUEST['user_role']) ? $_REQUEST['user_role'] : '';
		$order_asc_desc = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : '';
		$offset = isset($_REQUEST['pagenumber']) ? (($_REQUEST['pagenumber'] == 1) ? 0 : (($_REQUEST['pagenumber'] - 1) * 10  )) : 0;
		$users_as_per_role = get_users(array('role'=>$user_role,'number'=>10,'offset'=>$offset,'orderby'=>'login','order'=>$order_asc_desc));

		echo json_encode($users_as_per_role);
		exit;
	} // END  Function mam_get_user_as_per_role
	
	/*****
	*. Method to get total wp users without Offset
	******/
	function mamcut_get_paginationCBF() { 
		if( !current_user_can('administrator') )
			exit;

		header('Content-Type:application/javascript');
		$user_role = isset($_REQUEST['user_role']) ? $_REQUEST['user_role'] : '';
		$users_as_per_role = get_users(array('role'=>$user_role));
		echo json_encode($users_as_per_role);
		exit;
	}
}