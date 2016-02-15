var toolTipLibrary = angular.module('wellApp.libraries.toolTip', []);

toolTipLibrary.service('wellApp.libraries.toolTip', [
    function () {
        var toolTips = {
            dashboard_filter: {
                fromdt: 'Start Date for Analysis. Applicable on entire page',
                todt: 'End Date for Analysis. Applicable on entire page',
                offerList: 'Narrow analysis to specific campaigns. Applicable on entire page',
                channelList: 'Narrow analysis to a given channel. Applicable on entire page'
            }
            
        };
        return {
            getToolTips: function (namespace) {
                if (namespace === undefined) {
                    return toolTips;
                } else {
                    return toolTips[namespace];
                }
            }
        };
    }]);


