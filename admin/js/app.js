var CustomUsersTable = angular.module('CustomUsersTable',[]);

// Setup Angular Controller
CustomUsersTable.controller('MyOptions', function($scope,$http){
	
	// Set default Values
	paginations_arr = [];
	$scope.currentpage = 1;
	$scope.filter = '';
	$scope.orderby = 'ASC';
	$scope.users = [{'data':{"user_login":"Loading..."}}];
	// Get initial Values with Ajax
	$http.get(ajaxurl+'?action=mam_get_user_as_per_role').then(function(response){
		// define users from response
		$scope.users = response.data;
		
	}); // $http.get(ajaxurl+'?action=mam_get_user_as_per_role').then
	
	// Get Values without offset
	$http.get(ajaxurl+'?action=mamcut_get_pagination&user_role='+$scope.filter).then(function(response){
		// Set Total Users
		TotalUsers = response.data;
		// Round the value and ceil it for pagination
		rounded_pagination_counter = Math.ceil(TotalUsers.length/10);
		$scope.totalpages = rounded_pagination_counter;
		// Append Array
		for(var i=1;i<=rounded_pagination_counter;i++)
			paginations_arr.push({'key':i});
		// Set Paginations
		$scope.paginations = paginations_arr;
	});
	
	// Function to update the Users
	$scope.updateusers = function(pageclicked=null){
		// Chaeck Value of current Page
		$scope.currentpage = pageclicked ? pageclicked : $scope.currentpage;
		// empty pagination array
		paginations_arr = [];
		// Empty users array
		$scope.users = [{'data':{"user_login":"Loading..."}}];
		// Get Users with AJAX
		$http.get(ajaxurl+'?action=mam_get_user_as_per_role&user_role='+$scope.filter+'&pagenumber='+$scope.currentpage+'&orderby='+$scope.orderby).then(function(response){
			$scope.users = response.data;
			// Set Order By and toggle it
			$scope.orderby = ($scope.orderby == 'ASC' ? 'DESC' : 'ASC');
			
		});
		
		// Get Total Users without offset for pagination
		$http.get(ajaxurl+'?action=mamcut_get_pagination&user_role='+$scope.filter).then(function(response){
			// Set Total Users
			TotalUsers = response.data;
			// Round the value and ceil it for pagination
			rounded_pagination_counter = Math.ceil(TotalUsers.length/10);
			$scope.totalpages = rounded_pagination_counter;
			for(var i=1;i<=rounded_pagination_counter;i++)
				paginations_arr.push({'key':i});
		
			// Set Paginations
			$scope.paginations = paginations_arr;
			
		});
		
		
	}; // $scope.updateusers = function
	

	
}); //CustomUsersTable.controller('MyOptions', function($scope,$http){