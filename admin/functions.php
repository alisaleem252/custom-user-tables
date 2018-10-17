<?php
function mamcut_users_role_select_options(){
	$users = get_users();
	$users_role = array();
	foreach($users as $user)
		$users_role[$user->roles[0]] = $user->roles[0];
	foreach($users_role as $role){?>
		<option value="<?php echo $role ?>"><?php _e(ucfirst($role),MASTEXTDOMAIN) ?></option>
<?php
	} // foreach($users as $user){
} // mamcut_users_role_select_options