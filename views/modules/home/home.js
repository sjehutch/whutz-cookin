var homes = angular.module('whutz.modules.home', []);

homes.controller('whutz.modules.home.index', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	'ngDialog',
	 function ($scope,$rootScope, $http, $location, $window, $routeParams, auth, Notification,ngDialog) {
		 
	$scope.forgot = {};
	$scope.register = {};
	$scope.login  = {};
	$scope.vreset = {};
	$scope.s = {};
	$scope.isResetPassShow = false;
	$scope.myInterval = 5000;
	$scope.noWrapSlides = false;
	$scope.active = 0;
	$scope.isHideLoginSignupWhenReset= false;

	$scope.slides = [];

	$scope.slides.push({
      image: '/views/images/slider/veggies.jpg',
      text: '',
      id: 1
    });
	$scope.slides.push({
      image: '/views/images/slider/tomato.jpg',
      text: '',
      id: 2
    });
	$scope. slides.push({
		 image: '/views/images/slider/berries.jpg',
		 text: '',
		 id: 3
	});
	$scope.slides.push({
		 image: '/views/images/slider/ribs.jpg',
		 text: '',
		 id: 4
	});

	
	 
	$scope.map = {center: {latitude: 51.219053, longitude: 4.404418 }, zoom: 12 };
	
	$scope.reset = $location.search().reset;
	if($scope.reset != undefined){
		$scope.vreset.reset = $scope.reset;
		$scope.isResetPassShow = true;
		$scope.isHideLoginSignupWhenReset=true;
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
		ngDialog.open({template : 'menuPopup.html' });
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
						$rootScope.isOverLayShow=true;
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
							
							$scope.save = function(invalid){
								if(invalid)
									return false;

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
											Notification.error(data.message);
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
						if(data.serviceNotAvailable){
							ngDialog.open({
								template: 'serviceNotAvailable.html',
							});
						}
						else{
							Notification.error(data.message)
							var errors = data.errors;
							for(var idx in errors){
								Notification.error(errors[idx].toString());
							}
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
						$location.path("/home");
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
						$scope.isResetPassShow=false;
						Notification.info(data.message);
						$location.path("/home");
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
	}
	
	
}]);