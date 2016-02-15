
var interceptorModule = angular.module('whutz.interceptor',[]);

interceptorModule.factory('customInterceptorFactory', [
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
				  localStorage.removeItem("app.identity");
				  $location.path("/home")  
			  }
			  return rejection;
			}
			
		};
		return customInterceptorFactory;
	}]);