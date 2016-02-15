// JavaScript Document
var order = angular.module('whutz.modules.order', []);

order.controller('whutz.modules.order.user', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$timeout',
	'$route',
	'$routeParams',
	"whutz.security.auth",
	 function ($scope, $http, $location, $window, $timeout, $route, $routeParams, auth) {
		 
		$scope.orders = [];
		
		//$timeout(function(){
//			$route.reload();
//		},10000);
		
		$http.get("/my-orders")
			.success(function (data) {
				if(data.status){
					$scope.orders = data.orders;
				}else{
					
				}
			})
			.error(function (data) {
				console.log('Error: ' + data);
			}); 
}])

order.controller('whutz.modules.order.cook', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $http, $location, $window,$routeParams,auth,Notification) {
		 
		$scope.orders = [];
		$http.get("/cook/my-orders")
				.success(function (data) {
                 	if(data.status){
						$scope.orders = data.orders;
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		
		$scope.updateStatus = function(order){
			
			if(order.dish_status == ""){
				return false;	
			}

			var data = { "order_id" : order.id , "status"  : order.status };

			$http.post("update/dish/status",data)
					.success(function (data) {
						if(data.status){
							Notification.info(data.message);
						}else{
							Notification.error(data.message);
						}
					})
					.error(function (data) {
						console.log('Error: ' + data);
					});		
		}
						

		
}])

order.controller('whutz.modules.order.cook.booking', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	 function ($scope, $http, $location, $window,$routeParams,auth) {
		 $scope.bookings = [];
		 $http.get("/cook/booking")
				.success(function (data) {
                 	if(data.status){
						$scope.bookings = data.bookings;
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                }); 
}])

order.controller('whutz.modules.order.place',[
	'$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $http, $location, $window,$routeParams,auth,Notification) {
		 
	 $scope.methods= [
	 					{ name: "Standard" , rate : "10"},
						{ name: "XYZ" , rate : "12"}
					 ];
	 $scope.selectedDelivery = $scope.methods[0];
	 
	  $scope.carts = [];
	  $scope.total = 0;
		 
	$scope.index = function(){
		$http.get("/mycart")
			.success(function (data) {
				if(data.status){
					$scope.carts = data.data;
					for(var idx in $scope.carts){
						$scope.total += (parseInt($scope.carts[idx]["quantity"]) || 0) * (parseInt($scope.carts[idx]["dish"].price) || 0);
					} 
				}else{
					
				}
			})
			.error(function (data) {
				console.log('Error: ' + data);
			});
	}
	 $scope.index();
	 
	 $scope.setDelivery = function(method){
		 $scope.selectedDelivery = method;
	 }
	 
	 $scope.placeOrder = function(){
			console.log($scope.carts.length);
			if($scope.carts.length == 0){
				Notification.error("Please add items in cart");
				return false;
			}
				
			$http.post("/order/place", $scope.selectedDelivery)
				.success(function (data) {
                 	if(data.status){
						$scope.carts = [];
						Notification.info(data.message);
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
}]);