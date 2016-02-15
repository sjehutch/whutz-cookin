// JavaScript Document

app.controller('whutz.admin.controller.dishs', [
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
			
			$http.get("/admin/dishs",$scope.user)
					.success(function (data) {
						if(data.status)
							$scope.dataCollection = data.data;
					})
					.error(function (data) {
						
					});	
		}
		
		
		$scope.dataFn();
		
		$scope.showDishEditTemplate = function(row){
			 var newScope = $scope.$new();
     		 newScope.data = row;
		
			ngDialog.open({ 
							template : 'dishUpdateTemplate',
							 scope : newScope,
							 controller: 'whutz.admin.controller.dishs.edit',
						});
		}
		
		
		$scope.removeRow = function removeRow(row) {
			var index = $scope.dataCollection.indexOf(row);
			if (index !== -1) {
				$http.delete("/admin/dish/"+row.id)
				.success(function (data) {
					
				})
				.error(function (data) {
					
				});	
				$scope.dataCollection.splice(index, 1);
			}
   		}
			
}]);
app.controller('whutz.admin.controller.dishs.edit', [
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
				$scope.data.dish_img = resp.data.fileName;
			}, function (resp) {
				console.log('Error status: ' + resp.status);
			}, function (evt) {
				var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
				console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
			});
		};
		 
		 
		 
		 $scope.update = function(){
			 
				$http.post("/admin/dish",$scope.data)
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