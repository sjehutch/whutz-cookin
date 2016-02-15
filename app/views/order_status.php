<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Whutz cookin</title>
<link href="/views/libraries/3rdParty/bootstrap/bootstrap.min.css" rel="stylesheet">

<style>
.order-style{
	font-size:24px;
	margin-bottom:10px;
}
.order-style{
	background:#FBC766;
	 border-radius: 10px;
    padding: 3px 20px;
	color:#000;
	text-align:center;
}
.order-style.active{
	background:#82EC23;
}

</style>

<script src="/views/libraries/core/angular/angular.min.js" ></script> 
<script>
var app = angular.module('app', []);
app.controller('order_details', function($scope,$http,$timeout,$location,$window) {
		$scope.orders = [];
		
		$timeout(function(){
			//location.reload(); 
		},10000); //10 sec

		$http.get("/order/status/"+$location.search().order)
			.success(function (data) {
				if(data.status){
					$scope.orders = data.orders;
				}else{
					
				}
			})
			.error(function (data) {
				console.log('Error: ' + data);
			}); 
});
app.filter('process', function () {
  return function (items) {
	  var status = "";
	  for(var i in items){
		  
		  items[i].status
	  }
    return item.toUpperCase();
  };
});
</script>
</head>
<body ng-app="app" ng-controller="order_details">
<div class="text-center" style="margin-top:40px;margin-bottom:40px;"> <img src="/views/images/logo2.png" width="300" alt=""/> </div>
<div class="container">
  <div class="row">
  	<div class="col-sm-12">
    	<h1>Order details</h1>
     </div>
     
     <div class="" ng-repeat="items in orders">
    <div class="col-sm-12">
    	<div class="col-sm-3 order-style active">
        	<span>Pending</span>
        </div>
        <div class="col-sm-3 order-style">
       		 <span>Ready</span>
        </div>
        <div class="col-sm-3 order-style">
        	<span>Delivered</span>
        </div>
        <div class="col-sm-3 order-style">
        	<span>Completed</span>
        </div>
     </div>
     
     <div class="col-sm-12">
     	<table class="table table-bordered">
            <thead>
              <tr>
                <th>Dish</th>
                <th>Plates</th>
                <th>Price</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="order in items">
                <td>{{ order.dish.name }}</td>
                <td>{{ order.quantity }}</td>
                <td>{{ order.quantity * order.dish.price }}</td>
                <td style="text-transform: capitalize;">{{ 
                
                	(order.status  == 1) ? "Pending" : (order.status  == 2) ? "Ready" : (order.status  == 3) ? "Completed" :''
                
                }}</td>
              </tr>
            </tbody>
          </table>
     </div>
     
     </div>
     
  </div>
</div>
</body>
</html>
