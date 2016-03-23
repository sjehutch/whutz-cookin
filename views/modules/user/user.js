
var user = angular.module('whutz.modules.user', []);

user.controller('whutz.modules.user.profile', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	 function ($scope, $http, $location, $window,$routeParams,auth) {
		 $scope.user ={};
		 
		 $http.get("/user")
				.success(function (data) {
                 	if(data.status){
						$scope.user = data.user;
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
}]);

user.controller('whutz.modules.user.message', [
	'$scope',
	'$http',
	'$location',
	'$window',
	'$routeParams',
	"whutz.security.auth",
	function ($scope, $http, $location, $window,$routeParams,auth) {
		$scope.messages = [];
		$scope.send = {};

		$scope.send.cook_id = $routeParams.id;

		$http.get("/message/"+$routeParams.id)
			.success(function (data) {

				if(data.status){
					$scope.messages = data.data;
				}else{

				}
			})
			.error(function (data) {
				console.log('Error: ' + data);
			});
		$scope.sender = function(){

			$http.post("/send",$scope.send)
				.success(function (data) {
					var msg2={text:$scope.send.text,time:"Now"};

					$scope.messages.push(msg2);
					Notification.info("Message send Successfully!!")
					$scope.send.text=null;
				})
				.error(function (data) {
					console.log('Error: ' + data);
				});
		}

	}]);
user.controller('whutz.modules.user.edit.profile', [
    '$scope',
	'$q',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Upload',
	'Notification',
	 function ($scope,$q,$http, $location, $window,$routeParams,auth,Upload,Notification) {
		 
		$scope.user ={};
		$scope.user.profile_photo = null;
		 
		$scope.$watch('profile_photo',function(newVal, oldVal){
			if(newVal != undefined && newVal != null){
				$scope.upload(newVal);	
			}
			
		});
		
		// Upload
		$scope.upload = function (file) {
			Upload.upload({
				url: '/files/upload',
				data: {file: file}
			}).then(function (resp) {
				$scope.user.profile_photo = resp.data.fileName;
			}, function (resp) {
				console.log('Error status: ' + resp.status);
			}, function (evt) {
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};
		
		 $http.get("/user")
			.success(function (data) {
				if(data.status){
					$scope.user = data.user;
					$scope.user.password = null;
				}else{
					
				}
			})
			.error(function (data) {
				console.log('Error: ' + data);
			});
	
		$scope.getCoords =  function(){
			var deferred = $q.defer();
			
			var geocoder = new google.maps.Geocoder(); 
			geocoder.geocode({
				address : $scope.user.address+' '+$scope.user.city+' '+$scope.user.state, 
				region: 'no' 
			},
			function(results, status) {
					if (status.toLowerCase() == 'ok') {
						// Get center
						var coords = new google.maps.LatLng(
							results[0]['geometry']['location'].lat(),
							results[0]['geometry']['location'].lng()
						);
						$scope.user.latitude = coords.lat();
						$scope.user.longitude = coords.lng();
						
						console.log('Latitute: ' + coords.lat() + '    Longitude: ' + coords.lng() );
						deferred.resolve("success");
						//map.setCenter(coords);
						//map.setZoom(18);
	 
						// Set marker also
						//marker = new google.maps.Marker({
						//	position: coords, 
						//	map: map, 
							//title: jQuery('input[name=address]').val(),
						//});
	 
					}
					deferred.reject(name);
				},
			function(){
				deferred.reject(name);
			});
			
			return deferred.promise;

		};	
			
		$scope.save = function(){
			$http.post("/user",$scope.user)
			.success(function (data) {
				if(data.status){
					Notification.info(data.message);
				}else{
					Notification.error(data.message);
				}
			})
			.error(function (data) {
				Notification.error('Error: ' + data);
				console.log('Error: ' + data);
			});
		}
		
		$scope.update = function(){
			$q.all([
           			$scope.getCoords()
				]).then(function(value) {
						$scope.save();	
						}, function(reason) {
							// Error callback where reason is the value of the first rejected promise
							console.log(reason);
						});
		}
}]);
user.controller('whutz.modules.user.login', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {

		$scope.errorsLogin='';
		$scope.isLogin = JSON.parse($routeParams.isLogin);
		
		$scope.query_string = $location.search();
		
		var email_verified = $scope.query_string.email_verified ;
		
		if(email_verified != undefined){
			$http.get("/verification/email/"+ email_verified)
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
		
		$scope.loginFn = function(invalid){
			if(invalid)
				return false;
			
			$http.post("/login",$scope.login)
				.success(function (data) {
                 	if(data.status){
						var user = data.data;
						auth.authenticate(user);
						
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.registerFn = function(invalid){
			if(invalid)
				return false;
				
			if($scope.register.verify_password != $scope.register.password){
				Notification.error("Password not match");
				return false;
			}
				
			$http.post("/register",$scope.register)
				.success(function (data) {
					// success
					debugger;
					if(data.status){
						Notification.info("Your account is successfully created. please check your email and verify your whutz-cookin account.");
						$location.path("/home#login");
					}
					// failed
					else{
						
						Notification.error(data.message);
						var errors = data.errors|| [];
						for(var idx in errors){
							Notification.error(errors[idx].toString());
						}
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
	 }
 ]);
user.controller('whutz.modules.user.near.dish', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {
		 
		 $scope.options = {scrollwheel: false};
		 
		 var setPosition = function(position){
			var map = {center: {latitude: 51.219053, longitude: 4.404418 }, zoom: 14 };
			map.center.latitude = position.coords.latitude;
			map.center.longitude = position.coords.longitude;
			
			$scope.$apply(function(){
				$scope.map = map;
			});
			
		}
		 $scope.position = function(){
			 if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(setPosition);
			} else {
				x.innerHTML = "Geolocation is not supported by this browser.";
			}
		 }
		 $scope.position();
		
}]);
user.controller('whutz.modules.user.plan', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {
		 
		$scope.plans = [];
		 
		$scope.getPlans = function(){
			
			$http.get("/cook/plans")
				.success(function (data) {
                 	if(data.status){
						$scope.plans = data.plans;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.getPlans();
		
		$scope.activePlan = function(id){
			
			$http.get("/cook/plan/"+id)
				.success(function (data) {
                 	if(data.status){
						auth.authenticate(data.user);
						Notification.info(data.message);
						$location.path('/cook/licence');
					}else{
						Notification.error(data.message);
					}
                })
                .error(function(data) {
                    console.log('Error: ' + data);
                });
		}
		
}]);
user.controller('whutz.modules.user.licence', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	'Upload',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification,Upload) {
		
		$scope.model = {}; 
		
		$scope.upload = function (file) {
			Upload.upload({
				url: '/files/upload',
				data: {file: file}
			}).then(function (resp) {
				$scope.model.licence_img = resp.data.fileName;
			}, function (resp) {
				console.log('Error status: ' + resp.status);
			}, function (evt) {
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};
		
		$scope.$watch('licence_img',function(newVal, oldVal){
			if(newVal != undefined && newVal != null){
				$scope.upload(newVal);	
			}
			
		});
		
		$scope.updateLicence = function(invalid){
			if(invalid)
				return false;
				
			var data = {"is_complete":1};
			data.licence_no = $scope.model.licence_no;
			data.licence_img = $scope.model.licence_img;
			
		    $http.post("/licenseUpdate", data)
				.success(function (data) {
					if(data.status){
						Notification.info(data.message);
						auth.authenticate();
					}else{
						Notification.error(data.message);
					}
				})
				.error(function (data) {
					Notification.error('Error: ' + data);
					console.log('Error:' + data);
				});
			
		}
		$scope.withOutLicence = function(){
			var data = {"is_complete":1};
		    $http.post("/licenseUpdate", data)
				.success(function (data) {
					if(data.status){
						Notification.info(data.message);
						auth.authenticate();
					}else{
						Notification.error(data.message);
					}
				})
				.error(function (data) {
					Notification.error('Error: ' + data);
					console.log('Error:' + data);
				});
		}
		

}]);
user.controller('whutz.modules.user.plan2', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {
		 
		$scope.plans = [];
		 
		$scope.getPlans = function(){
			
			$http.get("/cook/plans")
				.success(function (data) {
                 	if(data.status){
						$scope.plans = data.plans;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.getPlans();
		
		$scope.activePlan = function(id){
			
			$http.get("/cook/plan/"+id)
				.success(function (data) {
                 	if(data.status){
						auth.authenticate(data.user);
						Notification.info(data.message);
						$location.path('/cook/licence');
					}else{
						Notification.error(data.message);
					}
                })
                .error(function(data) {
                    console.log('Error: ' + data);
                });
		}
		
}]);

user.controller('whutz.modules.user.myaccount', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {
		 
		$scope.data = [];
		 
		$http.get("/payments")
				.success(function (data) {
					console.info(data.data[0]);
                 	if(data.status){
						$scope.data = data.data;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                }); 
		 
		 
	 }]);

user.controller('whutz.modules.user.dashboard', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {
		 
		$scope.payments = [];
		$scope.soldDish = [];
			
		$http.get("/cook/dishs")
				.success(function (data) {
                 	if(data.status){
						$scope.dishs = data.data;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                }); 
				
						
		$http.get("/cook/dishs?type=solddish")
				.success(function (data) {
                 	if(data.status){
						$scope.soldDish = data.data;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                }); 
				
		$http.get("/payments?type=recently")
				.success(function (data) {
                 	if(data.status){
						$scope.payments = data.data;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                }); 
		 
		 
	 }]);

user.controller('whutz.modules.user.dashboardUser', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification) {
		 
		$scope.dishs = [];
			
		$http.get("/likes/dish_favorite")
				.success(function (data) {
                 	if(data.status){
						$scope.dishs = data.data;
					}else{
						Notification.error(data.message);
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                }); 

		 
	 }]);


user.controller('whutz.modules.user.calendar', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	'$compile',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification,$compile) {
		 
		$scope.events = [];
		
		$http.get("cook/booking?type=calendar")
			.success(function (data) {
				$scope.events = data.bookings;
			})
			.error(function (data) {
				console.log('Error: ' + data);
			}); 
		 
}]);


//  whutz.modules.user.send.message

user.controller('whutz.modules.user.send.message', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$timeout',
	"whutz.security.auth",
	'Notification',
	'uiCalendarConfig',
	'$compile',
	 function ($scope, $rootScope, $http, $location, $window,$routeParams,$timeout,auth,Notification,uiCalendarConfig,$compile) {
		 
		
		$scope.cook_id = $routeParams.id;
		$scope.send = { "cook_id" : $scope.cook_id };
		
		$scope.cook_photo = null;
		
		
		$http.get("/user/photo/"+$scope.cook_id)
			.success(function (data) {
				if(data.status){
					$scope.cook_photo = data.data;
				}else{
					
				}
			})
			.error(function (data) {
				console.log('Error: ' + data);
			}); 
	
		
		$scope.sender = function(){
				
			$http.post("/send",$scope.send)
				.success(function (data) {
					Notification.info("Message send Successfully!!")
					$scope.send.text=null;
				})
				.error(function (data) {
					console.log('Error: ' + data);
				}); 	
		}
		

}]);
user.controller('whutz.modules.user.delivery',[ function($scope){

}]);



user.controller('whutz.modules.user.deliveryCompleted',[ function($scope){

}]);
