// JavaScript Document

var dish = angular.module('whutz.modules.dishs', []);

//whutz.modules.dish.all

dish.controller('whutz.modules.dish.all', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	'whutz.libraries.waitLoader',
	 function ($scope, $http, $location, $window,$routeParams,auth,Notification,waitLoader) {
		 
		////waitLoader.add("#center_column");
	
		$scope.dishs = [];
		 $http.get("/dish")
				.success(function (data) {
					if(data.status){
						$scope.dishs = data.data;
					}else{
						
					}
					////waitLoader.end("ng-view");
				})
				.error(function (data) {
					console.log('Error: ' + data);
				});
		 
		 
}]);

dish.controller('whutz.modules.dish.search', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	'whutz.libraries.waitLoader',
	 function ($scope, $http, $location, $window,$routeParams,auth,Notification,waitLoader) {
		 
		 
		$scope.dishs = [];
		$scope.cooks = [];
		
		$scope.favoriteCook = function(id){
			
			var data = {};
			
			data.id = id;
			data.type = "favoriteCook";
				
				
			$http.post("/likes", data)
				.success(function (data) {
                 	if(data.status){
						//data 
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
			
		}
		
		$scope.follow = function(id){
			
			var data = {};
			
			data.id = id;
			data.type = "follow";
				
				
			$http.post("/likes", data)
				.success(function (data) {
                 	if(data.status){
						//data 
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.favorite = function(id){
			
			var data = {};
			
			data.id = id;
			data.type = "favorite";
				
				
			$http.post("/likes", data)
				.success(function (data) {
                 	if(data.status){
						//data 
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		$scope.index = function (searchItem){
			
				var data = $location.search();
				
				if(!angular.isUndefined($scope.map)){
					var data = angular.extend({}, data,  $scope.map.center);
					console.log("$scope.map.center");
				console.log($scope.map.center);
				}
				
				console.log(data);
		 		$http.post("/search", data)
				.success(function (data) {
                 	if(data.status){
						$scope.dishs= [];
						$scope.cooks = [];
						if(data.type == "dish"){
							$scope.dishs = data.data;
						}
						else{
							$scope.cooks = data.data;
						}
					}else{
						$scope.map;
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		 }
		$scope.index();
		
		
		$scope.$watch('map',function(newVal,oldVal){
		
			if(newVal != undefined && newVal != null){
				if(angular.isUndefined($scope.searchDish)){
					$scope.index($routeParams.searchItem);
				}
				else{
					$scope.index($scope.searchItem);
				}
					
			}
			
		});
		
		$scope.$watch('dishs',function(newVal,oldVal){
		
			if(newVal != undefined && newVal != null){
				var markers = [];
				for(var idx in newVal){
					marker = {};
					marker["id"] = newVal[idx].id;
					marker["latitude"] = newVal[idx].user.latitude;
					marker["longitude"] = newVal[idx].user.longitude;
					marker["title"]  = newVal[idx].name;
					marker["cook"] = newVal[idx].user.name;
					marker["price"] = newVal[idx].price;
					
					markers.push(marker);
				}
				//$scope.$apply(function(){
					$scope.markers = markers;
					//console.log($scope.markers);
				//});
			}
						
		});
		
		
		$scope.$watch('searchDish',function(newVal,oldVal){
		
			if(newVal != undefined && newVal != null){
				$scope.index(newVal);
			}
			
		});
		
		$scope.addCart = function (id,quantity){
			
			var post_data = {};
			
			post_data.dish_id = id;
			post_data.quantity = quantity; //default
			
			$http.post("/mycart", post_data)
				.success(function (data) {
                 	if(data.status){
						Notification.info("Dish add your cart");
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
		
		 $scope.options = {scrollwheel: false};
		 
		 var setPosition = function(position){
			var map = {center: {latitude: 51.219053, longitude: 4.404418 }, zoom: 12 };
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

dish.controller('whutz.modules.dish.cook', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	'whutz.libraries.waitLoader',
	 function ($scope, $http, $location, $window,$routeParams,auth,Notification,waitLoader) {
		 
		 $scope.dishs = [];
		 
		 //waitLoader.add("#center_column");
		 
		 $http.get("/cook/dishs")
				.success(function (data) {
                 	if(data.status){
						$scope.dishs = data.dishs;
					}else{
						
					}
					 //waitLoader.end("#center_column");
                })
                .error(function (data) {
                    console.log('Error: ' + data);
					 //waitLoader.end("#center_column");
                });
				
}]);

dish.controller('whutz.modules.dish.show', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'whutz.libraries.waitLoader',
	'Notification',
	 function ($scope, $http, $location, $window,$routeParams,auth,waitLoader,Notification) {
		 
		 $scope.host = location.host;
		 
		 $scope.absUrl = $location.absUrl();
		
		 $scope.dish = {};
		 FB.init({appId: "1484351695206404", status: true, cookie: true});

		$scope.postToFeed = function(){
				var obj = {
					method: "feed",
					redirect_uri: $scope.host+"/#/dishs",
					link: $location.absUrl(),
					picture:  $scope.host+"/uploads/"+ $scope.dish.dish_img ,
					name: "Dish Name : "+ $scope.dish.name,
					caption: $scope.host,
					description: $scope.dish.description
				};
			
			 $scope.callback = function(response) {
				Notification.info("Post ID: " + response["post_id"]);
				//document.getElementById("msg").innerHTML = "Post ID: " + response["post_id"];
			}
			
			FB.ui(obj, $scope.callback);
			
		 }

		 $http.get("/cook/dish/"+$routeParams.id)
				.success(function (data) {
                 	if(data.status){
						$scope.dish = data.dishs;
						
						var special_notes = [];
						
						
						var contains = JSON.parse($scope.dish.special_notes);
						
						for (x in contains) {
							special_notes.push(contains[x]);
						}
						
						$scope.dish.contain = special_notes.join(', ');
						
						var delivery_method = [];
						var contains2 = JSON.parse($scope.dish.delivery_method);
						for (x in contains2) {
							delivery_method.push(contains2[x]);
						}
						
						$scope.dish.delivery_method = delivery_method.join(', ');
						
						$scope.dish.order_quantity=1;
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
				
		$scope.addCart = function (id,quantity){
			
			var post_data = {};
			
			post_data.dish_id = id;
			post_data.quantity = quantity; //default
			
			$http.post("/mycart", post_data)
				.success(function (data) {
                 	if(data.status){
						Notification.info("Dish add your cart");
					}else{
						
					}
                })
                .error(function (data) {
                    console.log('Error: ' + data);
                });
		}
				
}]);
dish.controller('whutz.modules.dish.addEdit', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Upload',
	'Notification',
	'whutz.libraries.waitLoader',
	'$anchorScroll',
	 function ($scope, $http, $location, $window,$routeParams,auth,Upload,Notification,waitLoader, $anchorScroll) {
		 
		$scope.id = parseInt($routeParams.id); 
		$scope.isEdit = false;
		$scope.dish = {};
		$scope.dish.dish_img = null;
		$scope.dish.dish_video = null;
		
		$scope.special_notes={};
		$scope.delivery_method={};
		
		$scope.$watch('file',function(newVal,oldVal){
			
			if(newVal !== undefined && newVal !== null)
				$scope.upload($scope.file);
			
		});
		$scope.$watch('video',function(newVal,oldVal){
			
			if(newVal !== undefined && newVal !== null)
				$scope.uploadVideo($scope.video);
			
		}); 
		
		$scope.upload = function (file) {
			Upload.upload({
				url: '/files/upload',
				data: {file: file}
			}).then(function (resp) {
				$scope.dish.dish_img = resp.data.fileName;
			}, function (resp) {
				console.log('Error status: ' + resp.status);
			}, function (evt) {
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};
		
		$scope.uploadVideo = function (file) {
			Upload.upload({
				url: '/files/upload',
				data: {file: file}
			}).then(function (resp) {
				$scope.dish.dish_video = resp.data.fileName;
			}, function (resp) {
				console.log('Error status: ' + resp.status);
			}, function (evt) {
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};
		  
		// add show
		$scope.show = function(){
		  $http.get("/dish/"+$scope.id)
				.success(function (data) {
					
					if(data.status){
						$scope.dish = data.dish;
						$scope.special_notes = JSON.parse($scope.dish.special_notes);
						$scope.delivery_method = JSON.parse($scope.dish.delivery_method);
					}else{
						
					}
				})
				.error(function (data) {
					console.log('Error: ' + data);
				});
		}
		
		if($scope.id != 0){
			$scope.show();  
		}
		
		// add dish
		$scope.store = function(invalid){
			if(invalid){
				$location.hash("create-account_form");
				return false;

			}
		  $scope.dish.special_notes=JSON.stringify($scope.special_notes);
		  $scope.dish.delivery_method = JSON.stringify($scope.delivery_method);
		  $http.post("/dish",$scope.dish)
				.success(function (data) {
					if(data.status){
						Notification.info("Dish Successfully added");
						$location.path("/dishs");
					}else{
						Notification.error("error"+ data.message);
					}
				})
				.error(function (data) {
					console.log('Error: ' + data);
				});
		}
		
		// update
		
		$scope.update = function(invalid){
			if(invalid){
				$location.hash("create-account_form");
				$anchorScroll();
				return false;

			}
			$scope.dish.special_notes=JSON.stringify($scope.special_notes);
			$scope.dish.delivery_method=JSON.stringify($scope.delivery_method);
			$http.put("/dish/"+$scope.id,$scope.dish)
				.success(function (data) {
					if(data.status){
						Notification.info("Dish successfully updated");
					}else{
						
					}
				})
				.error(function (data) {
					console.log('Error: ' + data);
					
				});
		}
}]);
dish.controller('whutz.modules.dish.sale', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'Notification',
	'whutz.libraries.waitLoader',
	 function ($scope, $http, $location, $window,$routeParams,auth,Notification,waitLoader) {
		 $scope.dishs = [];
		 $http.get("/dish")
				.success(function (data) {
					if(data.status){
						$scope.dishs = data.data;
					}else{
						
					}
					//waitLoader.end("#center_column"); 
				})
				.error(function (data) {
					console.log('Error: ' + data);
					//waitLoader.end("#center_column"); 
				});
}]);

dish.controller('whutz.modules.dish.photos', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'whutz.libraries.waitLoader',
	 function ($scope, $http, $location, $window,$routeParams,auth,waitLoader) {
		 
		 $scope.photos = [];
		 //waitLoader.add("#center_column"); 
		 
		 $http.get("/cook/my-photos")
			.success(function (data) {
				if(data.status){
					$scope.photos = data.photos;
				}else{
					
				}
				//waitLoader.end("#center_column"); 
			})
			.error(function (data) {
				console.log('Error: ' + data);
				//waitLoader.end("#center_column"); 
			}); 
}]);
dish.controller('whutz.modules.dish.videos', [
    '$scope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	"whutz.security.auth",
	'whutz.libraries.waitLoader',
	 function ($scope, $http, $location, $window,$routeParams,auth,waitLoader) {
		 
		 $scope.videos = [];
		//waitLoader.add("#center_column"); 
		 
		 $http.get("/cook/my-videos")
			.success(function (data) {
				if(data.status){
					$scope.videos = data.videos;
				}else{
					
				}
				//waitLoader.end("#center_column");
			})
			.error(function (data) {
				console.log('Error: ' + data);
				//waitLoader.end("#center_column");
			}); 
}]);