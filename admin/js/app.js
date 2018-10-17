var CustomUsersTable = angular.module('CustomUsersTable',[]);


CustomUsersTable.controller('MyOptions', function($scope,$http){

	
	
	paginations_arr = [];
	$scope.currentpage = 1;
	$scope.filter = '';
	$scope.orderby = 'ASC';
	$http.get(ajaxurl+'?action=mam_get_user_as_per_role').then(function(response){
		$scope.users = response.data;
		
		
	}); // $http.get(ajaxurl+'?action=mam_get_user_as_per_role').then
	
	
	$http.get(ajaxurl+'?action=mamcut_get_pagination&user_role='+$scope.filter).then(function(response){
		TotalUsers = response.data;
	rounded_pagination_counter = Math.ceil(TotalUsers.length/10);
		$scope.totalpages = rounded_pagination_counter;
		for(var i=1;i<=rounded_pagination_counter;i++)
			paginations_arr.push({'key':i});
		
		
		$scope.paginations = paginations_arr;
	});
	
	
	$scope.updateusers = function(pageclicked=null){
		$scope.currentpage = pageclicked ? pageclicked : $scope.currentpage;
		paginations_arr = [];
		$http.get(ajaxurl+'?action=mam_get_user_as_per_role&user_role='+$scope.filter+'&pagenumber='+$scope.currentpage+'&orderby='+$scope.orderby).then(function(response){
			$scope.users = response.data;
			
			$scope.orderby = ($scope.orderby == 'ASC' ? 'DESC' : 'ASC');
			
		});
		
		
		$http.get(ajaxurl+'?action=mamcut_get_pagination&user_role='+$scope.filter).then(function(response){
			TotalUsers = response.data;
			rounded_pagination_counter = Math.ceil(TotalUsers.length/10);
			$scope.totalpages = rounded_pagination_counter;
			for(var i=1;i<=rounded_pagination_counter;i++)
				paginations_arr.push({'key':i});
		
//		
		
			$scope.paginations = paginations_arr;
			
		});
		
		
	}; // $scope.updateusers = function
	

	
}); //CustomUsersTable.controller('MyOptions', function($scope,$http){