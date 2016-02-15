window.app = angular.module('whutz.admin', [
    //'ui.utils',
    //'ui.utils',
    'ngRoute',
   'ui.bootstrap',
	'ui-notification',
	'ngDialog',
	'smart-table',
	'ngFileUpload',
	
	//'ngFileUpload',
	//'whutz.libraries.waitLoader',
	
	//'whutz.security',
	//'whutz.interceptor',
	
	<!-- modules -->
	//'whutz.modules.home',
//	'whutz.modules.user',
//	'whutz.modules.dishs',
//	'whutz.modules.order',
//	'whutz.modules.cart'
]);
app.factory('customInterceptorFactory', [
	"$window", "$rootScope", "$location",
	function ($window, $rootScope, $location)
	{
		var customInterceptorFactory = {
			request: function (config) {
				   return config;
			},
			
			requestError: function(rejection) {
				   return rejection;
			},
				
			response: function (result) {
				 return result;
			},
			
		   responseError: function(rejection) {
			  if(rejection.status == 401){
				  
				  //clear local storage
				  localStorage.removeItem("admin");
				  $rootScope.auth =null;
				  $location.path("/login")  
			  }
			  return rejection;
			}
			
		};
		return customInterceptorFactory;
	}]);

app.config(['$routeProvider', '$locationProvider', '$sceDelegateProvider','$httpProvider',
	function ($routeProvider, $locationProvider, $sceDelegateProvider,$httpProvider) {
	 
	$httpProvider.interceptors.push('customInterceptorFactory');
    $locationProvider.html5Mode(false);

    $routeProvider
		.when('/login', {
            templateUrl : '/views/admin/layouts/login.html',
            controller : 'whutz.admin.app.login'
        })
        .when('/home', {
            templateUrl : '/views/admin/layouts/home.html',
            controller : 'whutz.admin.controller.home'
        })
		.when('/users/:type',{
			templateUrl : '/views/admin/layouts/users.html',
			controller :  'whutz.admin.controller.users'
		})
		.when('/dishs',{
			templateUrl : '/views/admin/layouts/dishs.html',
			controller :  'whutz.admin.controller.dishs'
		})
		.when('/payments/done',{
			templateUrl : '/views/admin/layouts/payment.done.html',
			controller :  'whutz.admin.controller.payments.done'
		})
		.when('/payments/cook',{
			templateUrl : '/views/admin/layouts/payment.cook.html',
			controller :  'whutz.admin.controller.payments.cook'
		})
		.when('/sales',{
			templateUrl : '/views/admin/layouts/sales.html',
			controller :  'whutz.admin.controller.payments.sales'
		})
		.when('/survey',{
			templateUrl : '/views/admin/layouts/survey.html',
			controller :  'whutz.admin.controller.survey'
		})
        .otherwise({
            redirectTo: '/home'
        });
    
} ]);

app.controller('whutz.admin.main.controller', [
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
		 
		$scope.parseInt = parseInt;
		$scope.location = $location;
		$rootScope.auth = JSON.parse( localStorage.getItem("admin"));
		
		
		
		$scope.$watch('auth',function(newVal){
			if(JSON.parse(newVal) != true)
				 $location.path("/login")
			
		})
		
		$scope.logout = function(){
			
			$http.post("admin/logout",$scope.user)
					.success(function (data) {
						localStorage.removeItem("admin");
					})
					.error(function (data) {
						localStorage.removeItem("admin");
					});
			//admin/logout
		}
		//if(Auth.getType() == "cook")
		//	ngDialog.open({ template: 'menuPopup' });
		
			
		
		
		
		$rootScope.$on('$routeChangeStart', function(event,next, current) { 
		
			 //if(Auth.isAuthenticated() && next.originalPath == "/home")
			 //	$location.path("/my-profile");
				
		});
				
		$scope.dishs = [];
		 
		$scope.logout = function(){
			$http.post("/admin/logout",$scope.user)
					.success(function (data) {
						localStorage.removeItem("admin");
					})
					.error(function (data) {
						localStorage.removeItem("admin");
					});	
		}
		
	 }
 ]);
 
 
 app.controller('whutz.admin.app.login', ['$scope','$rootScope','$http','$location','Notification', function($scope,$rootScope,$http,$location,notification){
	
	$scope.user =  {}; 
	$scope.incorrect = false;
	
	$scope.login = function(){
		$http.post("/admin/login",$scope.user)
				.success(function (data) {
					if(data.status){
						notification.info(data.message);
						localStorage.setItem("admin",true);
						$rootScope.auth = true;
						$location.path("/home");
					}else{
						notification.error(data.message)	
					}
				})
				.error(function (data) {
					console.log('Error: ' + data);
				});		
	}
		 
 }]);
 
 
 