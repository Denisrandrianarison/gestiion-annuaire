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

    crmApp.controller('categoryController', ['$scope', '$rootScope', '$http', 'categoryServices', '$location', '$cookies', '$timeout', function (
                                       $scope, $rootScope, $http, categoryServices, $location, $cookies, $timeout) {
        //Initialization
        $scope.allCategory = [];
        $scope.category= [];
        $scope.lib= "";
        $scope.idCategory= "";
        $scope.isUpdateCategory = false;
        $scope.success = false;
        $scope.warning = false;
        $scope.deleteSuccess = false;
        $scope.alert = false;
        $scope.messages = "";
        $scope.spinner = false;
        
        $scope.getAllCategory = function () {
            categoryServices.getAllCategory()
                .then(function (data) {
                    $scope.allCategory = data.data;
                });
        }

        $timeout(function() {                  
            $scope.getAllCategory();
        }, 500);
        
        $scope.addCategory = function (data) {
            $scope.success = false;
            let datas = JSON.stringify(Object.assign({}, data))
                datas = JSON.parse(datas);

            categoryServices.addCategory(datas)
                .then(function (data) {
                    $scope.getAllCategory();
                    $scope.clearInput();
                    $scope.messages = "Ajout categorie effectuée avec succès";
                    $scope.success = true;
                });
        }

        $scope.showCategoryToUpdate = function (clientData) {
            $scope.category.idCategory = clientData.id;
            $scope.category.libelle = clientData.libelle;
            $scope.category.subCategory = clientData.sub_category;
            $scope.isUpdateCategory = true;
            $scope.success = false;
        }

        $scope.updateCategory = function (data) {
            $scope.success = false;
            let datas = JSON.stringify(Object.assign({}, data))
                datas = JSON.parse(datas);

            categoryServices.updateCategory(datas)
                .then(function (data) {
                   $scope.getAllCategory();
                   $scope.clearInput();
                   $scope.messages = "Modification effectuée avec succès";
                   $scope.success = true;
                });
        }
        
        $scope.confirmDeleteCategory = function (cat) {
            const modal = $('#confirmDeleteCategory');
            modal.modal('show');
            $scope.idCategory = cat.id;
            $scope.lib = cat.libelle;
            $scope.deleteSuccess = false;
        }

        $scope.deleteCategory = function () {
            const param = {
                id: $scope.idCategory,
            };
            categoryServices.deleteCategory(param).then(function (data) {
                $scope.getAllCategory();
                $scope.messages = "Supression effectuée avec succès";
                $scope.deleteSuccess = true;
            });
        }

        $scope.clearInput = function () {
            $scope.category = [];
            $scope.isUpdateCategory = false;
        }

    }]);
            

/**
    * Client ServiceProvider
    * --------------------------------------------------------------------------
*/
    crmApp.factory('categoryServices', function ($http, $q) {
        var factory = {
            getAllCategory: function () {
                var deferred = $q.defer();
                $http({
                    method: 'GET',
                    url: '/api/fetchCategory',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                        });
                return deferred.promise;
            },
            addCategory: function (param) {
                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: '/api/createCategory/',
                    data: $.param(param),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                        });
                return deferred.promise;
            },
            updateCategory: function (param) {
                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: '/api/updateCategory/',
                    data: $.param(param),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                        });
                return deferred.promise;
            },
            deleteCategory: function (param) {
                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: `/api/deleteCategory/${param.id}`,
                    data: $.param(param),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                        });
                return deferred.promise;
            }
        }
        return factory;
    });


/**
    * Directive Provider
    * --------------------------------------------------------------------------
*/
    crmApp.directive('ngModaldeletecatconfirmation', function () {
        return {
            restrict: 'A',
            templateUrl: 'resources/category/views/elements/modal-delete-cat-confirmation.html',
            link: function (scope, element, attrs) {
            }
        }
    });
