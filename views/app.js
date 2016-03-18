window.app = angular.module('whutz', [
    //'ui.utils',
    //'ui.utils',
    'ngRoute',
    'ui.bootstrap',
	'ui-notification',
	'uiGmapgoogle-maps',
	'ngDialog',
	
	'ngFileUpload',
	'whutz.libraries.waitLoader',
	
	'whutz.security',
	'whutz.interceptor',
	
	<!-- modules -->
	'whutz.modules.home',
	'whutz.modules.user',
	'whutz.modules.dishs',
	'whutz.modules.order',
	'whutz.modules.cart'
]);


app.config(['$routeProvider', '$locationProvider', '$sceDelegateProvider','$httpProvider','uiGmapGoogleMapApiProvider',
	function ($routeProvider, $locationProvider, $sceDelegateProvider,$httpProvider,uiGmapGoogleMapApiProvider) {
	
	uiGmapGoogleMapApiProvider.configure({
        key: 'AIzaSyA59v0IXTXagPNCrXlZg6LCB4kVJw0ILsU',
        v: '3.20', //defaults to latest 3.X anyhow
        libraries: 'weather,geometry,visualization'
    });
	 
	$httpProvider.interceptors.push('customInterceptorFactory');
    $locationProvider.html5Mode(false);

    $routeProvider
        .when('/home', {
            templateUrl : 'views/modules/home/views/index.html',
            controller : 'whutz.modules.home.index'
        })
        .when('/login/:isLogin', {
			templateUrl: 'views/modules/user/views/login.html',
            controller: 'whutz.modules.user.login'
        })
		.when('/cook/plans', {
			templateUrl: 'views/modules/user/views/plan.html',
            controller: 'whutz.modules.user.plan'
        })
		.when('/cook/licence', {
			templateUrl: 'views/modules/user/views/licence.html',
            controller: 'whutz.modules.user.licence'
        })
		.when('/search',{
			templateUrl: 'views/modules/dish/views/search.html',
            controller: 'whutz.modules.dish.search'
		})
		.when('/mycart',{
			templateUrl: 'views/modules/cart/views/index.html',
            controller: 'whutz.modules.cart.index'
		})
		.when('/order/place',{
			templateUrl: 'views/modules/order/views/order.place.html',
            controller: 'whutz.modules.order.place'
		})
		.when('/my-profile',{
			templateUrl: 'views/modules/user/views/profile.html',
            controller: 'whutz.modules.user.profile'
		})
		.when('/my-profile/edit',{
			templateUrl: 'views/modules/user/views/edit.profile.html',
            controller: 'whutz.modules.user.edit.profile'
		})
		.when('/cook/dish/:id',{
			templateUrl: 'views/modules/dish/views/store.dish.html',
            controller: 'whutz.modules.dish.addEdit'
		})
		.when('/dish/show/:id',{
			templateUrl: 'views/modules/dish/views/show.dish.html',
            controller: 'whutz.modules.dish.show'
		})
		.when('/cook/dishs/',{
			templateUrl: 'views/modules/dish/views/dishs.html',
            controller: 'whutz.modules.dish.cook'
		})
		.when('/my-photos',{
			templateUrl: 'views/modules/dish/views/photos.html',
            controller: 'whutz.modules.dish.photos'
		})
		.when('/my-videos',{
			templateUrl: 'views/modules/dish/views/videos.html',
            controller: 'whutz.modules.dish.videos'
		})
		.when('/dishs',{
			templateUrl: 'views/modules/dish/views/dishs.html',
            controller: 'whutz.modules.dish.all'
		})
		.when('/cook/my-orders',{
			templateUrl: 'views/modules/order/views/cook.order.html',
            controller: 'whutz.modules.order.cook'
		})
		.when('/my-orders',{
			templateUrl: 'views/modules/order/views/user.order.html',
            controller: 'whutz.modules.order.user'
		})
		.when('/cook/booking',{
			templateUrl: 'views/modules/order/views/cook.booking.html',
            controller: 'whutz.modules.order.cook.booking'
		})
		.when('/near-dish',{
			templateUrl: 'views/modules/user/views/map.search.html',
            controller: 'whutz.modules.user.near.dish'
		})
		.when('/food-for-sale',{
			templateUrl: 'views/modules/dish/views/dishs.html',
            controller: 'whutz.modules.dish.sale'
		})
		.when('/my-account',{
			templateUrl: 'views/modules/user/views/myaccount.html',
            controller: 'whutz.modules.user.myaccount'
		})
		.when('/dashboard',{
			templateUrl: 'views/modules/user/views/dashboard.html',
            controller: 'whutz.modules.user.dashboard'
		})
		.when('/dashboard-user',{
			templateUrl: 'views/modules/user/views/dashboard_user.html',
            controller: 'whutz.modules.user.dashboardUser'
		})
		.when('/calendar',{
			templateUrl: 'views/modules/user/views/calendar.html',
            controller: 'whutz.modules.user.calendar'
		})
		.when('/send/:id',{
			templateUrl: 'views/modules/user/views/message.html',
            controller: 'whutz.modules.user.send.message'
		})
		.when('/sms/:id',{
			templateUrl: 'views/modules/user/views/message.html',
			controller: 'whutz.modules.user.message'
		})
        .when('/resetPassword', {
    		
        })
        
        .otherwise({
            redirectTo: '/home'
        });
    
} ]);

app.controller('whutz.main.controller', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$q',
	'whutz.security.auth',
	'Notification',
	'ngDialog',
	'$anchorScroll',
	'anchorSmoothScroll',
	 function ($scope,$rootScope, $http, $location, $window, $routeParams,$q,Auth,notification,ngDialog,$anchorScroll,anchorSmoothScroll) {
		 
		$scope.parseInt = parseInt;
		$scope.location = $location;
		$rootScope.auth = Auth;
		$scope.JSON = JSON;

		 $scope.goTo = function(id){
			 $location.hash(id);
			 anchorSmoothScroll.scrollTo(id);
		 }

		$scope.unreadMessage = 0;

		 $scope.conversation = [];

		 $scope.getAllConversation = function(){
			 $http.get("/conversation")
				 .success(function (data) {
					 if(data.status){
						 $scope.conversation = data.data;
					 }else{

					 }
				 })
				 .error(function (data) {
					 console.log('Error: ' + data);
				 });
		 }
		 if(Auth.isAuthenticated())
		 	$scope.getAllConversation();

		$scope.getUnreadMessage = function(){
			$http.get("/msg/unread")
				.success(function (data) {
					if(data.status){
						$scope.unreadMessage = data.unread;
					}else{

					}
				})
				.error(function (data) {
					console.log('Error: ' + data);
				});
		}

		 if(Auth.isAuthenticated())
			$scope.getUnreadMessage();
		
		if(Auth.getType() == "cook")
			ngDialog.open({ template: 'menuPopup.html' });
			
		
		$scope.surveyPopup = function(){
			ngDialog.open({
							template: 'surveyTemplate',
							controller: ['$scope','$http','Notification', function($scope,$http,Notification) {
											$scope.survey = {};
											
											$scope.save = function(){
												$http.post("/survey",$scope.survey)
													.success(function (data) {
														//$scope.closeThisDialog();
														ngDialog.open({template: 'surveyCloseStatus'})
													})
													.error(function (data) {
														console.log('Error: ' + data);
													});	
											}
											
											// controller logic
										}]
						});
		}
		
		
		if($location.path() == '/home')
			$scope.surveyPopup();
		
		$rootScope.$on('$routeChangeStart', function(event,next, current) { 
		
			 //if(Auth.isAuthenticated() && next.originalPath == "/home")
			 //	$location.path("/my-profile");
				
		});
				
		$scope.dishs = [];
		 
		$scope.logout = function(){
			notification.info("Logout Successfully");
			Auth.authenticate();
			$scope.surveyPopup();
		}
	 }
 ]);