/*
|--------------------------------------------------------------------------
| Routes App
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Autor : Jean Denis
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Email : denisrandrianarisonfr@gmail.com
|--------------------------------------------------------------------------
|
| Here is where you can register all API routes for your application. These
| routes are loaded by the routeProvider with template and your angular controller.
| Enjoy building your API!
*/

let path = "";
if (window.location.href.includes('http://localhost'))
{
    path = window.location.origin;
} else {
   // path = window.location.origin + '/annuaire/';
}
const crmApp = angular
    .module("crmApp", ["ngRoute", "ngCookies"])
    .filter('formatDate', [
        '$filter', function($filter) {
            return function (input, format) {
                if (input === null) {
                     return "";
                } else {
                    return $filter('date')(new Date(input), format);
                }
            };
        }
    ])
    .config(function ($routeProvider, $locationProvider, $qProvider) {
        $qProvider.errorOnUnhandledRejections(false);
        $routeProvider
            .when("/", {
                templateUrl: "resources/fiche/views/fiche.html",
                controller: 'ficheController',
            })
            .when("/category", {
                templateUrl: "resources/category/views/category.html",
                controller: 'categoryController',
            })
            .otherwise({
                templateUrl: "resources/default/views/error_404.html",
                controller: 'defaultController',
            });
         //check browser support
        if(window.history && window.history.pushState){
        //$locationProvider.html5Mode(true); will cause an error $location in HTML5 mode requires a  tag to be present! Unless you set baseUrl tag after head tag like so: <head> <base href="/">
        // to know more about setting base URL visit: https://docs.angularjs.org/error/$location/nobase
        // if you don't wish to set base URL then use this
        $locationProvider.html5Mode({
                 enabled: true,
                 requireBase: false
          });
        }
    });

    crmApp.run(['$rootScope', '$http','$location', '$cookies', function (
        $rootScope, $http, $location, $cookies) {
        
        $rootScope.showNavMenu = function (){
            let navMenu = document.getElementById("showNavMenu");
                navMenu.style.display = "block";
        }
                    
        $rootScope.login = $cookies.get('login');
        if ($rootScope.login === undefined ||
            $rootScope.login === null ||
            $rootScope.login === "") $location.path('/');
    }]);