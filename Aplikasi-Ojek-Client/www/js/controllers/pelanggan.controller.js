'use strict';

angular.module('Aplikasi-Ojek')
  .controller('PelangganController', ['$scope', '$ionicModal', '$ionicPopup', 'PelangganService', '$window', function($scope, $ionicModal, $ionicPopup, PelangganService, $window) {

    $scope.inputRegister = {};
    $scope.inputLogin = {};
    $scope.enable = false;

    $scope.signUp = function() {
      $ionicModal.fromTemplateUrl('templates/register.html', {
        scope: $scope
      }).then(function(modal) {
        $scope.modalRegister = modal;
        $scope.modalRegister.show();
        $scope.modalLogin.hide();
      });
    };

    $scope.signIn = function() {
      $ionicModal.fromTemplateUrl('templates/login.html', {
        scope: $scope
      }).then(function(modal) {
        $scope.modalLogin = modal;
        $scope.modalLogin.show();
        $scope.modalRegister.hide();
      });
    };

    function init() {
      if ($window.localStorage.getItem('role') == undefined || !$window.localStorage.getItem('role')) {
        $ionicModal.fromTemplateUrl('templates/login.html', {
          scope: $scope
        }).then(function(modal) {
          $scope.modalLogin = modal;
          $scope.modalLogin.show();
        });
      }

    }

    init();

    $scope.prosesRegister = function(r) {
      PelangganService.register(r).success(function(data) {
        $scope.inputRegister = {};
        var userPopup = $ionicPopup.show({
          template: data.info,
          title: 'Info',
          scope: $scope,
          buttons: [{
            text: '<b>OK</b>',
            type: 'button-positive'
          }]
        });
      });
    };

    $scope.prosesLogin = function(l) {
      PelangganService.login(l).success(function(data) {

        if (data.login === true) {
          $window.localStorage.setItem('role', data.role);
          $window.localStorage.setItem('email', data.email);
          $window.localStorage.setItem('id_ojek', data.id_ojek);

          $scope.modalLogin.hide();
          $scope.inputLogin = {};

          if (data.role === 'ROLE_PELANGGAN') {
            $scope.enable = true;
            $window.localStorage.setItem('enable', true);
          } else {
            $scope.enable = false;
            $window.localStorage.setItem('enable', false);
          }

        }

        var userPopup = $ionicPopup.show({
          template: data.info,
          title: 'Info',
          scope: $scope,
          buttons: [{
            text: '<b>OK</b>',
            type: 'button-positive'
          }]
        });
      });
    };

  }]);
