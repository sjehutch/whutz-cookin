// JavaScript Document

app.controller('whutz.admin.controller.users', [
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
		 
		var type = $scope.type = $routeParams.type;
		 
		 
		$scope.dataCollection = [];

		$scope.itemsByPage = 10;
				
		$scope.dataFn = function(){
			
			if(type == 'all'){
				$http.get("/admin/users",$scope.user)
					.success(function (data) {
						if(data.status)
							$scope.dataCollection = data.data;
					})
					.error(function (data) {
						
					});	
			}else if(type == 'cook'){
				$http.get("/admin/users?type=cook",$scope.user)
					.success(function (data) {
						if(data.status)
							$scope.dataCollection = data.data;
					})
					.error(function (data) {
						
					});	
			}else if(type == 'delivery'){
				$http.get("/admin/users?type=delivery",$scope.user)
					.success(function (data) {
						if(data.status)
							$scope.dataCollection = data.data;
					})
					.error(function (data) {
						
					});		
			}
		}
		
		
		$scope.dataFn();
		
		$scope.showUserEditTemplate = function(user){
			 var newScope = $scope.$new();
     		 newScope.user = user;
		
			ngDialog.open({ 
							template : 'userUpdateTemplate',
							 scope : newScope,
							 controller: 'whutz.admin.controller.users.edit',
						});
		}
		
		
		$scope.removeRow = function removeRow(row) {
			var index = $scope.dataCollection.indexOf(row);
			if (index !== -1) {
				$http.delete("/admin/user/"+row.id)
				.success(function (data) {
					
				})
				.error(function (data) {
					
				});	
				$scope.dataCollection.splice(index, 1);
			}
   		}
			
}]);
app.controller('whutz.admin.controller.users.edit', [
    '$scope',
	'$rootScope',
    '$http',
    '$location',
    '$window',
	'$routeParams',
	'$q',
	'Notification',
	'ngDialog',
	'Upload',
	 function ($scope,$rootScope, $http, $location, $window, $routeParams,$q,notification,ngDialog,Upload) {
		 
		 $scope.$watch('file',function(newVal,oldVal){
			
			if(newVal !== undefined && newVal !== null)
				$scope.upload($scope.file);
			
		});
		
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
		 
		 
		 
		 $scope.update = function(){
			 
				$http.post("/admin/user",$scope.user)
					.success(function (data) {
						if(data.status){
							notification.info(data.message);
							$scope.closeThisDialog();	
						}else{
							notification.error(data.message);	
						}
					})
					.error(function (data) {
						
					});	
		}
}]);