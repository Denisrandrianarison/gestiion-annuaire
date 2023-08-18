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

    crmApp.controller('ficheController', ['$scope', '$rootScope', '$http', 'ficheServices', '$location', '$cookies', '$timeout', function (
                                       $scope, $rootScope, $http, ficheServices, $location, $cookies, $timeout) {
        //Initialization
        $scope.allFiches = [];
        $scope.ficheToUpdate = [];
        $scope.allCategory = [];
        $scope.success = false;
        $scope.warning = false;
        $scope.deleteSuccess = false;
        $scope.alert = false;
        $scope.messages = "";
        $scope.spinner = false;
        $scope.fiche = {};
        
        $scope.getAllFiche = function () {
            ficheServices.getAllFiche()
                .then(function (data) {
                    $scope.allFiches = data.data;            
                });
        }
        
        $scope.getAllCategory = function () {
            ficheServices.getAllCategory()
                .then(function (data) {
                    $scope.allCategory = data.data;
                });
        }

        $timeout(function() {                  
            $scope.getAllFiche();
            $scope.getAllCategory();
        }, 500);
        
        $scope.showModalAddFiche = function () {
            console.log("showModalAddFiche");
            $scope.success = false;
            $scope.fiche = {};
            const modal = $('#newClient');
            modal.modal('show');
        }

        $scope.addFiche = function (data) {
            $scope.success = false;
            ficheServices.addFiche(data)
                .then(function (data) {
                    $scope.getAllFiche();
                    $scope.messages = "Ajout fiche effectuée avec succès";
                    $scope.success = true;
                });
        }

        $scope.showModalUpdateClient = function (clientData) {
            const modal = $('#updateClient');
            modal.modal('show');
            $scope.ficheToUpdate.idFiche = clientData.id;
            $scope.ficheToUpdate.libelle = clientData.libelle;
            $scope.ficheToUpdate.description = clientData.description;
            $scope.ficheToUpdate.category = clientData.idCategory;  
            $scope.success = false;
        }

        $scope.updateFiche = function (data) {
            $scope.success = false;
            let datas = JSON.stringify(Object.assign({}, data))
                datas = JSON.parse(datas);
            ficheServices.updateFiche(datas)
                .then(function () {
                   $scope.getAllFiche();
                   $scope.messages = "Modification effectuée avec succès";
                   $scope.success = true;
                });
        }
        
        $scope.confirmDeleteFiche = function (client) {
            const modal = $('#confirmDeleteClient');
            modal.modal('show');
            $scope.idFiche = client.id;
            $scope.libelle = client.libelle;
            $scope.deleteSuccess = false;
        }

        $scope.deleteFiche = function () {
            var param = {
                id: $scope.idFiche
            }
            ficheServices.deleteFiche(param).then(function (data) {
                $scope.getAllFiche();
                $scope.messages = "Supression effectuée avec succès";
                $scope.deleteSuccess = true;
            });
        }

    }]);
            

/**
    * ServiceProvider
    * --------------------------------------------------------------------------
*/
    crmApp.factory('ficheServices', function ($http, $q) {
        var factory = {
            getAllFiche: function () {
                var deferred = $q.defer();
                $http({
                    method: 'GET',
                    url: '/api/fetchFiche',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                        deferred.resolve(datas);
                    });
                return deferred.promise;
            },
            addFiche: function (param) {
                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: '/api/creatFiche/',
                    data: $.param(param),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                    });
                return deferred.promise;
            },
            updateFiche: function (param) {
                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: '/api/updateFiche/',
                    data: $.param(param),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                        });
                return deferred.promise;
            },
            deleteFiche: function (param) {
                var deferred = $q.defer();
                $http({
                    method: 'POST',
                    url: `/api/deleteFiche/${param.id}`,
                    data: $.param(param),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                    then(function (datas) {
                            deferred.resolve(datas);
                        });
                return deferred.promise;
            },
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
        }
        return factory;
    });


/**
    * Directive Provider
    * --------------------------------------------------------------------------
*/
    crmApp.directive('ngModalconfirmation', function () {
        return {
            restrict: 'A',
            templateUrl: 'resources/fiche/views/elements/modal-delete-confirmation.html',
            link: function (scope, element, attrs) {}
        }
    });

    crmApp.directive('ngModaladdclient', function () {
        return {
            restrict: 'A',
            templateUrl: 'resources/fiche/views/elements/modal-add-fiche.html',
            link: function (scope, element, attrs) {}
        }
    });

    crmApp.directive('ngModalupdateclient', function () {
        return {
            restrict: 'A',
            templateUrl: 'resources/fiche/views/elements/modal-update-fiche.html',
            link: function (scope, element, attrs) {}
        }
    });

    crmApp.directive('ngModalsendmail', function () {
        return {
            restrict: 'A',
            templateUrl: 'resources/contact/views/elements/modal-send-mail.html',
            link: function (scope, element, attrs) {}
        }
    });