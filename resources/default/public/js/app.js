/*
    |--------------------------------------------------------------------------
    | Angular Client Controller
    |--------------------------------------------------------------------------
    |
    | Autor: Jean Denis
    | Email: denisrandrianarisonfr@gmail.com
    |
    | --------------------------------------------------------------------------
*/

    crmApp.controller('defaultController', ['$scope', '$rootScope', '$http', '$location', function (
                                       $scope, $rootScope, $http, $location) {
        console.log('defaultController');
    }]);
            

/**
    * Default ServiceProvider
    *
    * --------------------------------------------------------------------------
*/
    crmApp.factory('defaultServiceProvider', function ($http, $q) {
        console.log('defaultServiceProvider');
    });