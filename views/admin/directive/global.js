// JavaScript Document
app.directive('header', [function () {
    return {
        restrict: 'AE',
        replace: false,
        templateUrl: '/views/admin/directive/templates/header.html',
        scope: {
        },
        link: function ($scope, $element, $attrs) {


        }
    }
}]);
app.directive('siderbar', [function () {
    return {
        restrict: 'AE',
        replace: false,
        templateUrl: '/views/admin/directive/templates/siderbar.html',
        scope: {
        },
        link: function ($scope, $element, $attrs) {


        }
    }
}]);

app.directive('clienttable2', ['$sce',
'$document', function ($sce, $document) {
    return {
        restrict: 'A',
        scope: {
            tabledata: '=',
            deletetargetlist: '&',
            edittargetlist: '&',
            copytargetlist: '&',
            deactivetargetlist: '&',
            templatetargetlist: '&',
            inserttargetlist: '&',
            selecttargetlist: '&',
            getnextpage: '&',
            getprevpage: '&',
            getselectpage: '&',
            searchtext: '=',
            pagesize: '=',
            overrideedit: '=',
            overridecopy: '=',
            pagenumbers: '=',
            currentpage: '=',
            groupeditmode: '=',
            totalcount: '=',
            ostatus: '=',
            isstore: '='
        },
        templateUrl: 'directives/templates/grid.html',
        link: function ($scope, $element, $attrs) {
            $scope.sortcolumn = 0;
            $scope.reverse = 1;
            $scope.hascopy = 1;
            $scope.hasdelete = 1;
            $scope.hasinsert = 1;
            $scope.hasedit = 1;
            $scope.hasdeactive = 1;
            $scope.hastemplate = 1;
            $scope.groupeditmode = false;
            $scope.isFirstPage = false;
            $scope.isLastPage = false;
            $scope.sorttype = 's';
            $scope.MathCeil = Math.ceil;

           

            $scope.isGridPopupVisible = false;
            var openGridPopup = false;
            $scope.toggleGridPopup = function () {
                $scope.isGridPopupVisible = !$scope.isGridPopupVisible;
                openGridPopup = $scope.isGridPopupVisible;
            }
            $document.bind('click', function () {
                if (!openGridPopup) {
                    $scope.isGridPopupVisible = false;
                    $scope.$apply();
                } else {
                    openGridPopup = false;
                }
            });

            $scope.isGridDropdownVisible = []; 
            $scope.toggleGridDropdown = function (index) {
                for (var i = 0; i < $scope.totalcount; i++) {
                    $scope.isGridDropdownVisible[i] = false;
                }

                if ($scope.isGridDropdownVisible[index]==null)
                    $scope.isGridDropdownVisible[index] = false;

                $scope.isGridDropdownVisible[index] = !$scope.isGridDropdownVisible[index];
            }

            $scope.isGridDropdown = function (index) {
                return $scope.isGridDropdownVisible[index];
            }

            $document.bind('click', function (event) {
                var isClickedElementChildOfPopup = $element.find(".hoverrow")
                  .find(event.target)
                  .length > 0;

                if (isClickedElementChildOfPopup)
                    return;

                for (var i = 0; i < $scope.isGridDropdownVisible.length; i++) {
                    $scope.isGridDropdownVisible[i] = false;
                }
                $scope.$apply();
            });

            $scope.$watch('overrideedit', function (newValue, oldValue) {
                if (newValue == '1') {
                    $scope.hasedit = 0;
                }
                if (newValue == '0') {
                    $scope.hasedit = 1;
                }
            });
            $scope.$watch('overridecopy', function (newValue, oldValue) {
                if (newValue == '1') {
                    $scope.hascopy = 0;
                }
                if (newValue == '0') {
                    $scope.hascopy = 1;
                }
            });
            $scope.$watch('groupeditmode', function (newValue, oldValue) {
                if ($scope.groupeditmode == true) {
                    $('.hoverrow').css('cursor', 'pointer');
                }
                if ($scope.groupeditmode == false) {
                    $('.hoverrow').css('cursor', 'default');
                }
            });
            $scope.getCell = function (item, type) {
                if (type == "img") {
                    var img = getFullCDNUrl( item );
                    return $sce.trustAsHtml("<a href='" + img + "' rel='lightbox'> <img  src='" + img + "' height='80' rel='lightbox' /> </a>");
                }
                //console.log(item, ' ', type);
                return $sce.trustAsHtml("<span>" + item + "</span>");
            };
            $scope.selectHeaderIndex = function (ind) {
                $scope.sortcolumn = ind;
                $scope.sorttype = $scope.tabledata.header[ind].type;

                $scope.reverse = -1 * $scope.reverse;
                var indx = 0;
                $('.sortindicator').each(function () {
                    $(this).removeClass('arrow-up').removeClass('arrow-down');
                    if (indx == ind) {
                        if ($scope.reverse == 1) {
                            $(this).addClass('arrow-down');
                        }
                        else {
                            $(this).addClass('arrow-up');
                        }
                    }
                    indx = indx + 1;
                });
            }
            $scope.getnextpageNums = function () {
                var len = $scope.pagenumbers.length;
                var lastPage = $scope.pagenumbers[len - 1];
                var totalPage = $scope.numberOfPages();
                if ($scope.pagesize + lastPage < totalPage) {
                    endPage = $scope.pagesize + lastPage;
                }
                else {
                    endPage = totalPage;
                }
                $scope.pagenumbers = [];
                for (var i = lastPage + 1; i <= endPage; i++) {
                    $scope.pagenumbers.push(i);
                }
                $scope.currentpage = $scope.pagenumbers[0];
                $scope.getselectpage({ num: $scope.currentpage });
            };

            $scope.getprevpageNums = function () {
                var startPage = 1;
                if ($scope.pagesize < $scope.pagenumbers[0]) {
                    startPage = $scope.pagenumbers[0] - $scope.pagesize;
                }
                $scope.pagenumbers = [];
                for (var i = startPage; i < startPage + $scope.pagesize; i++) {
                    $scope.pagenumbers.push(i);
                }
                $scope.getselectpage({ num: startPage });
            };
            $scope.isLastPageSegment = function () {

                var totalPages = $scope.numberOfPages();
                var lastPageNum = $scope.pagenumbers[$scope.pagenumbers.length - 1];

                if (totalPages > lastPageNum) {
                    return false;
                }
                else {
                    return true;
                }
            };
            $scope.isFirstPageSegment = function () {
                if ($scope.pagesize > $scope.pagenumbers[0]) {
                    return true;
                }
                else { return false; }
            };

            $scope.numberOfPages = function () {
                if ($scope.tabledata === undefined)
                    return 0;

                if ($scope.tabledata.rowval === undefined)
                    return 0;

                return Math.ceil($scope.totalcount / $scope.pagesize);
            }
            $scope.tableInfofn = function () {
                $scope.tableInfo = $scope.currentpage + ' of ' + $scope.numberOfPages()
            }
            $scope.isFirstPagefn = function () {
                if ($scope.currentpage  == 1) {
                    $scope.isFirstPage = true;
                }
                else
                {
                    $scope.isFirstPage = false;
                }
            }
            $scope.isLastPagefn = function () {
                if ($scope.currentpage >= $scope.totalcount / $scope.pagesize) {
                    $scope.isFirstPage = true;
                }
                else {
                    $scope.isFirstPage = false;
                }
            }
            //$scope.$watch('filtered', function (newValue, oldValue) {
            //    if (newValue == undefined)
            //        return;

            //    $scope.pages = Math.ceil(newValue.length / $scope.pagesize);
            //});
            $scope.noIDFilter = function (m) {
                if (m.name == 'ID' || m.name == "Id" || m.name == 'county' || m.name == "County" || m.name == 'Country' || m.name == 'country')
                    return false;
                return true;
            }
            $scope.hideCountyFilter = function (m) {
                if (m.name == 'county' || m.name == "County" || m.name == 'Country' || m.name == 'country') {
                    $("." + m.name).hide();
                    return true;
                }
                return false;
            }
            $scope.setIDnodisplay = function (I) {
                if (I == 0) {
                    return 'tablenoiddisplay';
                }
            }
            if ($attrs['copytargetlist'] == undefined) {
                $scope.hascopy = 0;
            }
            if ($attrs['deletetargetlist'] == undefined) {
                $scope.hasdelete = 0;
            }
            if ($attrs['edittargetlist'] == undefined) {
                $scope.hasedit = 0;
            }
            if ($attrs['inserttargetlist'] == undefined) {
                $scope.hasinsert = 0;
            }
            if ($attrs['deactivetargetlist'] == undefined) {
                $scope.hasdeactive = 0;
            }
            if ($attrs['templatetargetlist'] == undefined) {
                $scope.hastemplate = 0;
            }
            if ($scope.overrideedit == '1') {
                $scope.hasedit = 0;
            }

        }
    }
}]);

