<!DOCTYPE html>
<html lang="en" ng-app="whutz">
<head>

<!-- Character set configuration -->
<meta charset="UTF-8">

<!-- Viewport configuration, scaling options -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Trying to make IE do its best -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Author and description -->
<meta name="author" content="whutz cookin">
<meta name="description" content="Whutz Cookin, Home Cooked Meals Delivered, Fine Dining at your Front Door.">

<!-- Open graph elements | http://ogp.me/ -->
<meta property="og:title" content="whutz cookin">
<meta property="og:image" content="views/images/slider/veggies.jpg">
<meta property="og:description" content="Whutz Cookin, Home Cooked Meals Delivered, Fine Dining at your Front Door.">

<!-- Hide the browser UI -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- MS tile icons -->
<meta name="msapplication-TileColor" content="#e13e3e">
<meta name="msapplication-TileImage" content="mstile-144x144.html">

<!-- Android toolbar color -->
<meta name="theme-color" content="#ffffff">

<!-- Apple touch icons -->
<link rel="apple-touch-icon" sizes="57x57" href="views/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="views/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="views/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="views/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="views/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="views/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="views/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="views/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="views/favicons/apple-touch-icon-180x180.png">

<!-- Android touch icons -->
<link rel="icon" type="image/png" href="views/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="views/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="views/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="views/favicons/favicon-16x16.png" sizes="16x16">

<!-- Web app manifest file | Make sure you edit the app name in it on 2nd line -->
<link rel="manifest" href="views/favicons/manifest.json">

<!-- Stylesheets -->
<link href="views/libraries/3rdParty/bootstrap/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="views/css/font-awesome.min.css">
<link rel="stylesheet" href="views/css/all.css">

<link rel="stylesheet" href="views/libraries/3rdParty/jquery-ui/jquery-ui-timepicker-addon.css">
<link rel="stylesheet" href="views/libraries/3rdParty/notification/angular-ui-notification.min.css" >

<!-- Site title -->
<title>WHUTZ COOKIN</title>
</head>
<body class="locked nav-fixed" ng-controller="whutz.main.controller" >

<!-- The initial spinner container --> 

<!-- Progress indicator when an email is being sent --> 
<!--<div class="progress" id="status">
            <div class="indeterminate"></div>
        </div>--> 

<!-- Fixed navigation bar -->
<div class="header-nav slideHeader">
  <nav class="navbar">
    <div class="container-fluid"> <a href="#/home" class="brand-logo center"> <img src="views/images/whutzcookin.png" alt="Whutz Cookin"> </a>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" ng-click="navbarCollapsed = !navbarCollapsed"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <!-- <a class="navbar-brand" href="#">WebSiteName</a>--> 
      </div>
      <div class="collapse navbar-collapse" collapse="navbarCollapsed" aria-expanded="false">
        <ul class="nav navbar-nav">
          <li><a href="#/home#cook">Book Cook</a></li>
          <li><a href="#/home#plate">Order Plate</a></li>
          <li><a href="#/home#menu">Menu</a></li>
          <li> <a href="#/home#reservations">Reservations</a></li>
          <li> <a href="#/home#contact">Contact</a></li>
        </ul>
        <!-- cook menu -->
        <ul class="nav navbar-nav show-sm" ng-if="auth.getType()=='cook' && auth.isComplete()">
          <li> <a href=""><i class="fa fa-bars"></i> COOK MENUS </a> </li>
          <li> <a href="#/home"> HOME </a> </li>
          <li> <a id="flip" href="#"> MESSAGES
            <div class="pull-right notification"> 0</div>
            </a> </li>
          <li> <a href="#/my-profile/edit"> MY PROFILE </a> </li>
          <li> <a href="#/cook/dish/0"> ADD DISH </a> </li>
          <li> <a href="#/cook/dishs"> ALL DISHES </a> </li>
          <li> <a href="#/cook/my-orders"> MY ORDERS
            <div class="pull-right notification"> 0</div>
            </a> </li>
          <li> <a href="#/cook/booking"> BOOKING DETAILS
            <div class="pull-right notification"> 0</div>
            </a> </li>
          <li> <a href="#/my-photos"> MY PHOTOS </a> </li>
          <li> <a href="#/my-videos"> MY VIDEOS </a> </li>
        </ul>
        
        <!-- user  menu -->
        <ul class="nav navbar-nav show-sm" ng-if="auth.getType()=='user'">
          <li> <a href=""><i class="fa fa-bars"></i> COOK MENUS </a> </li>
          <li> <a href="#/home"> HOME </a> </li>
          <li> <a id="flip" href="#/mycart"> Cart
            <div class="pull-right notification"> 0</div>
            </a> </li>
          <!--<li> <a id="flip" href="#"> MESSAGES
            <div class="pull-right notification"> 0</div>
            </a> </li>-->
          <li> <a href="#/my-profile/edit"> MY PROFILE </a> </li>
          <li> <a href="#/dishs"> ALL DISHES </a> </li>
          <li> <a href="#/food-for-sale"> FOOD FOR SALE </a> </li>
          <li> <a href="#/my-orders"> MY ORDERS </a> </li>
          <li> <a href="#/cook/booking"> BOOKING With Cook </a> </li>
        </ul>
        <ul class="nav navbar-nav navbar-right" ng-if="!auth.isAuthenticated()">
          <li><a href="#/login/false"> Sign Up</a></li>
          <li><a href="#/login/true">Login</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right"  ng-if="auth.isAuthenticated()">
        	<li><a ng-click="logout()"> LOGOUT </a> </li>
        </ul>
      </div>
    </div>
  </nav>
 <div class="menu-style ng-cloak" ng-if="auth.isAuthenticated()">
  <ul class="tree dhtml show-gt-sm" ng-if="auth.getType()=='cook' && auth.isComplete()">
      <li> <a href=""><i class="fa fa-bars"></i> COOK MENUS </a> </li>
      <li> <a href="#/home"> HOME </a> </li>
      <li> <a id="flip" href="#"> MESSAGES
        <div class="pull-right notification"> 0</div>
        </a> </li>
      <li> <a href="#/my-profile/edit"> MY PROFILE </a> </li>
      <li> <a href="#/cook/dish/0"> ADD DISH </a> </li>
      <li> <a href="#/cook/dishs"> ALL DISHES </a> </li>
      <li> <a href="#/cook/my-orders"> MY ORDERS
        <div class="pull-right notification"> 0</div>
        </a> </li>
      <li> <a href="#/cook/booking"> BOOKING DETAILS
        <div class="pull-right notification"> 0</div>
        </a> </li>
      <li> <a href="#/my-photos"> MY PHOTOS </a> </li>
      <li> <a href="#/my-videos"> MY VIDEOS </a> </li>
    </ul>
    
    <!-- user  menu -->
    <ul class="tree dhtml show-gt-sm" ng-if="auth.getType()=='user'">
      <li> <a href=""><i class="fa fa-bars"></i> COOK MENUS </a> </li>
      <li> <a href="#/home"> HOME </a> </li>
      <li> <a id="flip" href="#/mycart"> Cart
            <div class="pull-right notification"> 0</div>
            </a> </li>
      <!--<li> <a id="flip" href="#"> MESSAGES
        <div class="pull-right notification"> 0</div>
        </a> </li>-->
      <li> <a href="#/my-profile/edit"> MY PROFILE </a> </li>
      <li> <a href="#/dishs"> ALL DISHES </a> </li>
      <li> <a href="#/food-for-sale"> FOOD FOR SALE </a> </li>
      <li> <a href="#/my-orders"> MY ORDERS </a> </li>
      <li> <a href="#/cook/booking"> BOOKING With Cook </a> </li>
    </ul>
   </div>
</div>
<!--<div class="navbar-fixed">
            <nav class="active">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li><a href="#cook" class="waves-effect waves-dark">Book a Cook</a></li>
                        <li><a href="#plate" class="waves-effect waves-dark">Order a Plate</a></li>
                    </ul>
                    <ul class="right hide-on-med-and-down" ng-if="!auth.isAuthenticated()">
                        <li><a href="#/login/false" class="waves-effect waves-dark">Sign Up</a></li>
                        <li><a href="#/login/true" class="waves-effect waves-dark">Login</a></li>
                    </ul>
                    <ul class="right hide-on-med-and-down" ng-if="auth.isAuthenticated()">
                        <li><a href="#/" class="waves-effect waves-dark" ng-click="logout()">logout</a></li>
                    </ul>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                </div>
            </nav>
        </div>--> 

<!-- Mobile menu.
             You can slide it out with your finger, too :-) --> 
<!--<ul id="slide-out" class="side-nav">
            <li><a href="#cook">Book a Cook</a></li>
            <li><a href="#plate">Chef</a></li>
            
            <li><a href="#/login/false" class="waves-effect waves-dark" ng-if="!auth.isAuthenticated()">Sign Up</a></li>
            <li><a href="#/login/true" class="waves-effect waves-dark" ng-if="!auth.isAuthenticated()">Login</a></li>
            <li><a href="#/" class="waves-effect waves-dark" ng-click="logout()">logout</a></li>
        </ul>--> 

<!-- Overlay navigation icon --> 
<!--<div class="nav-icon-container">
            <div class="nav-icon"></div>
        </div>--> 

<!-- Overlay navigation --> 
<!--<div class="nav-overlay-wrapper">
            <div class="nav container">
                <div class="row">
                    <div class="col-sm-12 m10 offset-m2">
                        <ul id="nav-items">
                            <li><a href="#intro" class="waves-effect waves-light">Intro</a></li>
                            <li><a href="#atmosphere" class="waves-effect waves-light">Atmosphere</a></li>
                            <li><a href="#menu" class="waves-effect waves-light">Menu</a></li>
                            <li><a href="#reservations" class="waves-effect waves-light">Reservations</a></li>
                            <li><a href="#chef" class="waves-effect waves-light">Chef</a></li>
                            <li><a href="#events" class="waves-effect waves-light">Events</a></li>
                            <li><a href="#contact" class="waves-effect waves-light">Contact</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>--> 



<ng-view></ng-view>

<!-- Footer -->
<footer class="page-footer"> 
  <!--<div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-6" style="margin-bottom:50px;">
                        <h5>Instagram Feed</h5>

                         
                        <script src="http://instansive.com/widget/js/instansive.js"></script>
                        <iframe
                                src="http://instansive.com/widgets/ce8bf5f8fb71c3632a013164c08e1cb246626f42.html"
                                id="instansive_ce8bf5f8fb"
                                name="instansive_ce8bf5f8fb"
                                scrolling="no"
                                allowtransparency="true"
                                class="instansive-widget"
                                style="width: 100%; border: 0; overflow: hidden; ">
                        </iframe>
                        Use #Whutzcookin to see your photos here!
                    </div>
                    <div class="col-sm-12 col-lg-4  subscribe">
                        <h5>Subscribe</h5>
                        <p>
                            Receive our news, events pre-sale information and more. No spam, unsubscribe anytime you want.
                        </p>

                        
                        <div id="mc_embed_signup">
                            <form action="http://pimmey.us11.list-manage.com/subscribe/post?u=4131d254e34d85ebd3ba25ad3&amp;id=61196261e7" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <input type="email" value="" name="EMAIL" class="email form-control" id="mce-EMAIL" placeholder="email address" required>
                                    
                                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_4131d254e34d85ebd3ba25ad3_61196261e7" tabindex="-1" value=""></div>
                                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn"></div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>--> 
  
  <!-- Footer copyright and social icons -->
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6"> © 2015 <span class="bukhari-span">WHUTZ COOKIN</span> </div>
        <div class="col-sm-12 col-md-6"> <span class="social right"> <a href="#!"><i class="fa fa-facebook"></i></a> <a href="#!"><i class="fa fa-vk"></i></a> <a href="#!"><i class="fa fa-google-plus"></i></a> <a href="#!"><i class="fa fa-twitter"></i></a> <a href="#!"><i class="fa fa-pinterest"></i></a> <a href="#!"><i class="fa fa-instagram"></i></a> </span> </div>
      </div>
    </div>
  </div>
</footer>

<!-- These containers are needed to inject colors into JavaScript, do not remove -->
<div id="dark-color"></div>
<div id="base-color"></div>

<!-- JavaScript libraries --> 

<script src="views/libraries/core/angular/angular.min.js" ></script> 
<script src="views/libraries/core/angular/angular-router.min.js"></script> 
<script src="views/libraries/core/angular/angular-resource.min.js"></script> 
<script src="views/libraries/core/jquery/jquery-1.11.3.min.js"></script> 

<script src="views/libraries/3rdParty/jquery-ui/jquery-ui.min.js"></script> 
<script src="views/libraries/3rdParty/jquery-ui/jquery-ui-timepicker-addon.js"></script>

<script src="views/libraries/core/angularui/ui-bootstrap-0.14.3.min.js"></script> 
<script src="views/libraries/core/angular/angular-sanitize.min.js"></script> 

<script src="views/libraries/3rdParty/sticky/jquery.sticky.js"></script> 


<script src="views/libraries/3rdParty/fileupload/ng-file-upload-all.min.js"></script> 
<script src="views/libraries/3rdParty/notification/angular-ui-notification.min.js"></script>
<script src='//maps.googleapis.com/maps/api/js?sensor=false'></script>

<script src="views/libraries/3rdParty/google-maps/lodash.min.js"></script>
    
<script src="views/libraries/3rdParty/google-maps/angular-google-maps.min.js"></script>
<script src="views/libraries/3rdParty/google-maps/angular-simple-logger.js"></script>

<!-- app --> 
<script src="views/app.js"></script> 

<!-- global --> 
<script src="views/services/globalServices.js"></script> 
<script src="views/directives/globalDirectives.js"></script> 
<script src="views/filters/globalFilters.js"></script> 
<script src="views/security/auth.js"></script>
<script src="views/security/interceptor.js"></script>

<!-- modules --> 
<script src="views/modules/home/home.js"></script> 
<script src="views/modules/user/user.js"></script> 
<script src="views/modules/dish/dishs.js"></script>
<script src="views/modules/order/order.js"></script>
<script src="views/modules/cart/carts.js"></script>
<script type="text/javascript">	
	$(document).ready(function () {
		var startY = 100; 
		$(window).scroll(function () {
			checkY();
		});
		// Navigation slide down // Get the headers position from the top of the page, plus its own height 

		// Do this on load just in case the user starts half way down the page checkY(); // End navigation slide down

		function checkY() {
			if ($(window).scrollTop() > startY) {
				$('.slideHeader').addClass("slideHeaderNav").slideDown();
			} else { $('.slideHeader').removeClass("slideHeaderNav") } //.slideUp().fadeIn();
		}

		$('a[href*=#]:not([href=#].scroll)').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top - 60
					}, 300);
					return false;
				}
			}
		});
	
		var one=false;
		$(window).resize(function () {
			//var wth2 = $('.container').outerWidth(true);
			//$('.slideHeader').width(wth2);
		});
    
	});
</script>

</body>
</html>