var waitLoaderLibrary = angular.module('whutz.libraries.waitLoader', []);

waitLoaderLibrary.service('whutz.libraries.waitLoader', [
    function () {
        var promises = {};
        return {
            add:function (element, fullscreen) {
                
//                if (!promises[element]) {
//                    promises[element] = 1;
//                } else {
//                    promises[element] = promises[element] + 1;
//                }
                
//                if (promises[element] == 1) {
                    //reference element  with Jquery
                    element = $(element);
                   // element.hide();
                    $('#spinner').remove();
                    // this is the template for the spinner loader
                    
                    var template = '<div id="spinner"  class="text-center progress-loader' + (fullscreen ? '-fullscreen' : '') +'"><img src="views/images/loader.gif" width="200" /></div>';

                    //use this for prevent the double spinner insertion (issue "Double Jquery Excecution")
                    if ($('#spinner') !== undefined && $('#spinner').length === 0) {

                        //insert the template on before the selected element
                        if (fullscreen) {
                            $("body").append(template);
                        } else {
							
                            element.before(template);
							//console.log(element);
                        }
                    }
//                }
                
            },
            end: function(element) {
                //reference element  with Jquery
                
                promises[element] = promises[element] - 1;

                if (promises[element] <= 0) {
                    promises[element] = 0;

                    element = $(element);
                    //Removing spinner an show the hidden content
                    $('#spinner').remove();
                    element.show();
                }
            },
            clear: function() {
                promises = [];
                $('#spinner').remove();
            }
        };
    }]);
