
var dish = angular.module('whutz.modules.cart', []);

dish.controller('whutz.modules.cart.index', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$filter',
	"whutz.security.auth",
	"Notification",
	 function ($scope, $http, $location, $window,$routeParams,$filter,auth,Notification) {
		 
		 $scope.carts = [];
		 $scope.total = 0;
		 
		$scope.index = function(){
			$http.get("/mycart")
				.success(function (data) {
                 	if(data.status){
						$scope.carts = data.data;
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.remove = function(id){
			$scope.id = id;
			$http.delete("/mycart/"+id)
				.success(function (data) {
                 	if(data.status){
						$scope.index();
						Notification.info("Item remove successfully your cart");
						//$scope.$apply(function(){
						 //	var found = $filter('filter')($scope.carts, { id: $scope.id }, true);
        					//	$scope.carts.splice($scope.carts.indexOf(found), 1);
							
							//$scope.total =0;
						//	for(var idx in $scope.carts){
						//		$scope.total += (parseInt($scope.carts[idx]["quantity"]) || 0) * (parseInt($scope.carts[idx]["dish"].price) || 0);
						//	}
						//});
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.$watch('carts',function(newVal,oldVal){
			
			$scope.total = 0;
			if(newVal != undefined && newVal != null){
				for(var idx in newVal){
					$scope.total += (parseInt($scope.carts[idx]["quantity"]) || 0) * (parseInt($scope.carts[idx]["dish"].price) || 0);
				} 	
			}
		});
		
		
		//init
		$scope.index(); 
				
	 }
	]);// JavaScript Document