app.controller('whutz.admin.controller.home', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$q',
	'Notification',
	'ngDialog',
	 function ($scope,$rootScope, $http, $location, $window, $routeParams,$q,notification,ngDialog) {
		 
		$scope.grand = {};	
		$scope.grandDetails = function(){
			$http.post("/admin/grandInfo",$scope.user)
				.success(function (data) {
					if(data.status)
						$scope.grand = data.data;
				})
				.error(function (data) {
					
				});	
		}
		
		$scope.grandDetails();
			
	 }
 ]);