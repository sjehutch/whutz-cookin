var whutzauth = angular.module('whutz.security',[]);

whutzauth.factory('whutz.security.auth', ['$q', '$timeout','$http','$location',
	function($q, $timeout,$http,$location)
	{
		var _identity = undefined,
			_authenticated = false;

		return {
			isAuthenticated: function()
			{
				if(!_authenticated){
					_identity = angular.fromJson(localStorage.getItem("app.identity"));
					this.authenticate(_identity,true);
				}
					
				return _authenticated;
			},
			getUser : function(){
				  if(angular.isDefined(_identity)){
					  return _identity;
				  }
			},
			getType: function () {
				if (_identity)
					return _identity.type;
			},
			isComplete: function () {
				if (_identity)
					return _identity.is_complete;
			},
			update : function(identity){
				_identity = identity || null;
				localStorage.setItem("app.identity", angular.toJson(identity));
			},
			authenticate: function(identity,isCompleteCheck)
			{
				var identity = identity || null;
				_identity = identity;
				_authenticated = identity != null;
				
				if (_authenticated){ 
					localStorage.setItem("app.identity", angular.toJson(identity));
					if(isCompleteCheck){
						if(identity.type == 'cook'){
							(identity.is_complete == null) ? 
								$location.path("/cook/plans") : '';
						}
						//else
							//$location.path("/home");
					}
				}
				else{
				var _isLocalStorage = angular.fromJson(localStorage.getItem("app.identity"));
				if(_isLocalStorage != null){
					localStorage.removeItem("app.identity");
					
					$http.get("/logout")
						.success(function (data) {
							if(data.status){
								$location.path("/");
							}else{
								
							}
						})
						.error(function (data) {
							console.log('Error: ' + data);
						});
				}
				}
			}
		};
	}
]);
