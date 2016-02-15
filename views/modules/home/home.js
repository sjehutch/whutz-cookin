var homes = angular.module('whutz.modules.home', []);

homes.controller('whutz.modules.home.index', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	'ngDialog',
	 function ($scope, $http, $location, $window, $routeParams, auth, Notification,ngDialog) {
		 
	$scope.forgot = {};
	$scope.register = {};
	$scope.login  = {};
	$scope.vreset = {};
	$scope.s = {};
	$scope.isResetPassShow = false;
	
	 var slides = $scope.slides = [];
	 
	 slides.push({
      image: 'views/images/slider/veggies.jpg',
      text: '',
      id: 1
    });
	slides.push({
      image: 'views/images/slider/tomato.jpg',
      text: '',
      id: 2
    });
	
	
	 
	$scope.map = {center: {latitude: 51.219053, longitude: 4.404418 }, zoom: 12 };
	
	$scope.reset = $location.search().reset;
	console.log($scope.reset);
	if($scope.reset != undefined){
		$scope.vreset.reset = $scope.reset;
		$scope.isResetPassShow = true;
		
		$location.hash("reset");
	}
	
	$(document).ready(function(e) {
		$(".datetimepicker").datetimepicker({
					 dateFormat: 'M dd yy',
					 timeFormat: 'hh:mm TT'
		});        
    });
	
	$scope.cookinSearch = function(){
		 $location.url("/search?s="+encodeURI($scope.s.item)+"&type="+$scope.s.type);
	 }
		 
	$scope.reserveFn = function (invalid) {
	     
	     if (invalid)
	         return false;

	     $http.post("/reservation", $scope.reserve)
             .success(function (data) {
                 // success
                 if (data.status) {
                     $scope.reserve = {};
                     Notification.info("Reservation Submitted!!");
                  }
                     // failed
                 else {
                     var errors = data.errors;
                     for (var idx in errors) {
                         Notification.error(errors[idx].toString());
                     }
                 }
             })
             .error(function (data) {
                 console.log('Error: ' + data);
             });
	 }

	$scope.contactFn = function (invalid) {
	     console.log("Contact Click");
	     if (invalid)
	         return false;

	     $http.post("/contact", $scope.contact)
             .success(function (data) {
                 // success
                 if (data.status) {
                     $scope.contact = {};
                     Notification.info("Contact Request Submitted!!");
                 }
                     // failed
                 else {
                     var errors = data.errors;
                     for (var idx in errors) {
                         Notification.error(errors[idx].toString());
                     }
                 }
             })
             .error(function (data) {
                 console.log('Error: ' + data);
             });
	 }

	if(JSON.parse(localStorage.getItem("menupopup"))){
		ngDialog.closeAll()
		ngDialog.open({template : 'menuPopup' });
		localStorage.removeItem("menupopup")
	}
	 
	$scope.loginFn = function(invalid){
			if(invalid)
				return false;
			
			$http.post("/login",$scope.login)
				.success(function (data) {
                 	if(data.status){
						var user = data.data;
						auth.authenticate(user);
						if(user.type== "cook")
							localStorage.setItem("menupopup", true);
							
						$window.location.reload();
						
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
	
	$scope.deliveryTemplateOpen= function(){	
		ngDialog.open({
						template:'deliveryTemplate',
						controller: ['$scope','$http','Notification', function($scope,$http,Notification) {
							$scope.delivery = {};
							
							$scope.save = function(){
								$scope.delivery.type="delivery";
								
								$http.post("/register",$scope.delivery)
									.success(function (data) {
										// success
										
										if(data.status){
											Notification.info("Your account is successfully created. please check your email and verify your whutz-cookin account.");
											$location.hash("login");
											$scope.closeThisDialog();
										}
										// failed
										else{
											var errors = data.errors;
											for(var idx in errors){
												Notification.error(errors[idx].toString());
											}
										}
									})
									.error(function (data) {
										console.log('Error: ' + data);
									});
							}
							
							// controller logic
						}]
					});
	}
		
		
	$scope.registerFn = function(invalid){
			if(invalid)
				return false;
				
			//if($scope.register.verify_password != $scope.register.password){
			//	Notification.error("Password not match");
			//	return false;
			//}
				
			$http.post("/register",$scope.register)
				.success(function (data) {
					// success
					if(data.status){
						Notification.info("Your account is successfully created. please check your email and verify your whutz-cookin account.");
						$location.hash("login");
					}
					// failed
					else{
						var errors = data.errors;
						for(var idx in errors){
							Notification.error(errors[idx].toString());
						}
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
	$scope.forgotFn = function(invalid){
		if(invalid)
			return false;
				
		$http.post("/forgotpassword",$scope.forgot)
				.success(function (data) {
					// success
					if(data.status){
						Notification.info("Please check your email and  reset Links send your email.");
						$location.path("/home#login");
					}else{
						//Notification.error("");
					}

                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
	}
	
	$scope.resetFn = function(invalid){
		if(invalid)
			return false;
			
		if($scope.vreset.password != $scope.vreset.confirm_password){
			Notification.error("Password not Match");
			return false;
		}
		
		$http.post("/resetpassword",$scope.vreset)
				.success(function (data) {
					// success
					if(data.status){
						Notification.info(data.message);
						$location.path("/home#login");
					}else{
						Notification.error(data.message);
					}

                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
	}
	
	
}]);