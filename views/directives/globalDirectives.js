
app.directive('header', [function () {
    return {
        restrict: 'AE',
        replace: false,
        templateUrl: '/directives/templates/header.html',
        scope: {
        },
        link: function ($scope, $element, $attrs) {


        }
    }
}]);

app.directive('menu', [function () {
    return {
        restrict: 'AE',
        replace: false,
        templateUrl: '/views/directives/templates/menu.html',
        scope: {
        },
        link: function ($scope, $element, $attrs) {


        }
    }
}]);

app.directive('datetimepicker2', function ($timeout) {
    return {
        restrict: 'AE',
        transclude: false,
        replace: false,
        link: function (scope, element, attrs) {
			scope.$whenReady(function () {
				element.datetimepicker({
					 dateFormat: 'M dd yy',
					 timeFormat: 'hh:mm TT'
				   // dateFormat: (attrs.dateFormat == undefined) ? 'M dd yy' : attrs.dateFormat,
				   // beforeShow: function (dateText, inst) {
				   //     var myEl = angular.element(document.querySelector('#ui-datepicker-div'));
				   //     myEl.removeClass('red');
				   // }
				})
 			})
            //element.datepicker("setDate", new Date());
        }
    };
});

app.directive('fullCalendar', function() {

    return {
                restrict : "A",
                replace : true,
                transclude : true,
                scope: {
                  events: '='
                },   

    template : 

                "<div id=\"calendar\" ></div>",

                link : function( scope,$element, $attrs ) {


                      //Call the fullCalendar Method. 
                      scope.calendar = $('#calendar').fullCalendar({
                            theme: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },


        
                            editable: true,
                            slotMinutes: 15,

                            // add event name to title attribute on mouseover
                            eventMouseover: function(event, jsEvent, view) {
                                if (view.name !== 'agendaDay') {
                                    $(jsEvent.target).attr('title', event.title);
                                }
                            },

                            // Calling the events from the scope.  :)
                            events: scope.events,
                        });

              
                }
              }
 });