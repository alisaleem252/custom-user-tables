<?php

class UsersAngularAppAjax {
	function __construct(){
		add_action( 'wp_ajax_mam_get_user_as_per_role', array($this,'mam_get_user_as_per_roleCBF' ));
		add_action( 'wp_ajax_mamcut_get_pagination', array($this,'mamcut_get_paginationCBF' ));
	}
	function mam_get_user_as_per_roleCBF() {
		if( !current_user_can('administrator') )
			exit;
		

		header('Content-Type:application/javascript');
		$user_role = isset($_REQUEST['user_role']) ? $_REQUEST['user_role'] : '';
		$order_asc_desc = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : '';
		$offset = isset($_REQUEST['pagenumber']) ? (($_REQUEST['pagenumber'] == 1) ? 0 : (($_REQUEST['pagenumber'] - 1) * 10  )) : 0;
		$users_as_per_role = get_users(array('role'=>$user_role,'number'=>10,'offset'=>$offset,'orderby'=>'login','order'=>$order_asc_desc));

		

		if(isset($_REQUEST['print_r'])){
			echo '<pre>';
				print_r(($users_as_per_role));
			echo '</pre>';
		} // if(isset($_REQUEST['showarray'])

		echo json_encode($users_as_per_role);
		exit;
	} // END  Function mam_get_user_as_per_role




	
	//add_action( 'wp_ajax_nopriv_mam_get_user_as_per_role', 'mam_get_user_as_per_roleCBF' );
	function mamcut_get_paginationCBF() { 
		if( !current_user_can('administrator') )
			exit;
		header('Content-Type:application/javascript');
		$user_role = isset($_REQUEST['user_role']) ? $_REQUEST['user_role'] : '';
		
		$users_as_per_role = get_users(array('role'=>$user_role));

		if(isset($_REQUEST['print_r'])){
			echo '<pre>';
				print_r(($users_as_per_role));
			echo '</pre>';
		} // if(isset($_REQUEST['showarray'])

		echo json_encode($users_as_per_role);
		exit;
	}
}