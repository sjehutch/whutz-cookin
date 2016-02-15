// JavaScript Document

app.controller('whutz.admin.controller.survey', [
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
		 
		 
		 
		$scope.dataCollection = [];

		$scope.itemsByPage = 10;
				
		$scope.dataFn = function(){
			
			$http.get("/admin/dishs",$scope.user)
				.success(function (data) {
					if(data.status)
						$scope.dataCollection = data.data;
				})
				.error(function (data) {
					
				});	
		}
			
}]);
