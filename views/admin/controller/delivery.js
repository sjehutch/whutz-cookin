// JavaScript Document

app.controller('whutz.admin.controller.payments.done', [
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
			
			$http.get("/admin/payments",$scope.user)
				.success(function (data) {
					if(data.status)
						$scope.dataCollection = data.data;
				})
				.error(function (data) {
					
				});	
		}
		$scope.dataFn();
		
		$scope.removeRow = function removeRow(row) {
			var index = $scope.dataCollection.indexOf(row);
			if (index !== -1) {
				$http.delete("/admin/payment/"+row.id)
				.success(function (data) {
					
				})
				.error(function (data) {
					
				});	
				$scope.dataCollection.splice(index, 1);
			}
   		}
			
}]);

app.controller('whutz.admin.controller.payments.sales', [
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
			
			$http.get("/admin/sales",$scope.user)
				.success(function (data) {
					if(data.status)
						$scope.dataCollection = data.data;
				})
				.error(function (data) {
					
				});	
		}
		$scope.dataFn();
		
		$scope.showTemplate = function(data){
			 var newScope = $scope.$new();
     		 newScope.data = data;
		
			ngDialog.open({ 
							template : 'template',
							 scope : newScope,
							// controller: 'whutz.admin.controller.users.edit',
						});
		}
		
		
		/*$scope.removeRow = function removeRow(row) {
			var index = $scope.dataCollection.indexOf(row);
			if (index !== -1) {
				$http.delete("/admin/payment/"+row.id)
				.success(function (data) {
					
				})
				.error(function (data) {
					
				});	
				$scope.dataCollection.splice(index, 1);
			}
   		}*/
			
}]);

app.controller('whutz.admin.controller.payments.cook', [
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
			
			$http.get("/admin/cookPayments",$scope.user)
				.success(function (data) {
					if(data.status)
						$scope.dataCollection = data.data;
				})
				.error(function (data) {
					
				});	
		}
		$scope.dataFn();
		
		$scope.showTemplate = function(data){
			 var newScope = $scope.$new();
     		 newScope.data = data;
		
			ngDialog.open({ 
							template : 'template',
							 scope : newScope,
							 controller: 'whutz.admin.controller.cook.pay',
						});
		}
		
		
		/*$scope.removeRow = function removeRow(row) {
			var index = $scope.dataCollection.indexOf(row);
			if (index !== -1) {
				$http.delete("/admin/payment/"+row.id)
				.success(function (data) {
					
				})
				.error(function (data) {
					
				});	
				$scope.dataCollection.splice(index, 1);
			}
   		}*/
			
}]);

app.controller('whutz.admin.controller.cook.pay', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$q',
	'Notification',
	'ngDialog',
	'Upload',
	 function ($scope,$rootScope, $http, $location, $window, $routeParams,$q,notification,ngDialog,Upload) {
		 
		
		 
		 $scope.update = function(){
			 
				$http.post("/admin/cookPayNow",$scope.data)
					.success(function (data) {
						if(data.status){
							notification.info(data.message);
							$scope.closeThisDialog();	
						}else{
							notification.error(data.message);	
						}
					})
					.error(function (data) {
						
					});	
		}
}]);