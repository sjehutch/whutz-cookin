<!DOCTYPE html>
<html lang="en" ng-app="whutz.admin">
<head>
    <meta charset="utf-8">
    <title>Whutzcookin admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <!-- The styles -->
    <link id="bs-css" href="/views/admin/css/bootstrap-cerulean.min.css" rel="stylesheet">
    
	<link rel="stylesheet" href="/views/libraries/3rdParty/ngDialog/ngDialog.min.css">
	<link rel="stylesheet" href="/views/libraries/3rdParty/ngDialog/ngDialog-theme-default.min.css">
	<link rel="stylesheet" href="views/libraries/3rdParty/notification/angular-ui-notification.min.css" >
    <link href="/views/admin/css/charisma-app.css" rel="stylesheet">
    <link href='/views/admin/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='/views/admin/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='/views/admin/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='/views/admin/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='/views/admin/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='/views/admin/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='/views/admin/css/jquery.noty.css' rel='stylesheet'>
    <link href='/views/admin/css/noty_theme_default.css' rel='stylesheet'>
    <link href='/views/admin/css/elfinder.min.css' rel='stylesheet'>
    <link href='/views/admin/css/elfinder.theme.css' rel='stylesheet'>
    <link href='/views/admin/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='/views/admin/css/uploadify.css' rel='stylesheet'>
    <link href='/views/admin/css/animate.min.css' rel='stylesheet'>
    <link href='/views/libraries/3rdParty/grid/ui-grid.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
<style>
.navbar {
    background-image: none !important;
}
</style>
</head>

<body ng-controller="whutz.admin.main.controller">


<div ng-if="auth == true">
    <div header class="navbar navbar-default" role="navigation" style="background-color:#fff !important;"> </div>
    <div class="ch-container">
    <div class="row">
    <div siderbar class="col-sm-2 col-lg-2"> </div>
    <div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    
    
    
    <ng-view></ng-view>
    
    </div>
    </div>
    </div>
</div>

<div ng-if="auth != true">
 <ng-view></ng-view>
</div>

<script src="/views/libraries/core/angular/angular.min.js" ></script> 
<script src="/views/libraries/core/angular/angular-router.min.js"></script> 
<script src="/views/libraries/core/angular/angular-resource.min.js"></script> 
<script src="/views/libraries/core/jquery/jquery-1.11.3.min.js"></script> 
<script src="/views/libraries/3rdParty/jquery-ui/jquery-ui.min.js"></script> 
<script src="/views/libraries/3rdParty/jquery-ui/jquery-ui-timepicker-addon.js"></script> 
<script src="/views/libraries/core/angularui/ui-bootstrap-0.14.3.min.js"></script> 
<script src="/views/libraries/core/angular/angular-sanitize.min.js"></script> 
<script src="/views/libraries/3rdParty/sticky/jquery.sticky.js"></script> 
<script src="/views/libraries/3rdParty/fileupload/ng-file-upload-all.min.js"></script> 
<script src="/views/libraries/3rdParty/notification/angular-ui-notification.min.js"></script> 
<script src="/views/libraries/3rdParty/google-maps/lodash.min.js"></script> 
<script src="/views/libraries/3rdParty/google-maps/angular-google-maps.min.js"></script> 
<script src="/views/libraries/3rdParty/google-maps/angular-simple-logger.js"></script> 
<script src="/views/libraries/3rdParty/sweetalert/sweet-alert.min.js"></script> 
<script src="/views/libraries/3rdParty/ngDialog/ngDialog.min.js"></script>
<script src="/views/libraries/3rdParty/grid/smart-table.js"></script>
<script src="/views/libraries/3rdParty/grid/smart-table.js"></script>

<!-- app --> 
<script src="/views/admin/app.js"></script> 

<!--  directives -->
<script src="/views/admin/directive/global.js"></script> 

<!-- controllers  -->
<script src="/views/admin/controller/home.js"></script> 
<script src="/views/admin/controller/users.js"></script> 
<script src="/views/admin/controller/dishs.js"></script> 
<script src="/views/admin/controller/payments.js"></script> 

</body>
</html>