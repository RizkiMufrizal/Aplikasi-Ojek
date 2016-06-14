'use strict';

angular.module('Aplikasi-Supir')
  .controller('PelangganController', ['$scope', '$ionicModal', '$ionicPopup', 'PelangganService', '$window', 'SupirService', '$ionicHistory', '$state', function($scope, $ionicModal, $ionicPopup, PelangganService, $window, SupirService, $ionicHistory, $state) {

    $scope.inputRegister = {};
    $scope.inputLogin = {};

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

    $scope.signOut = function() {

      $state.go('app.home');

      $window.localStorage.clear();
      $ionicHistory.clearCache();
      $ionicHistory.clearHistory();

      $ionicModal.fromTemplateUrl('templates/login.html', {
        scope: $scope
      }).then(function(modal) {
        $scope.modalLogin = modal;
        $scope.modalLogin.show();
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

      if ($window.localStorage.getItem('enable')) {
        $scope.enable = $window.localStorage.getItem('enable');
      }

    }

    init();

    $scope.prosesRegister = function(r, choice) {
      if (choice === 'PELANGGAN') {
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
      } else if (choice === 'OJEK') {
        SupirService.register(r).success(function(data) {
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
      } else {
        var userPopup = $ionicPopup.show({
          template: 'anda belum memilih user pelanggan atau supir',
          title: 'Info',
          scope: $scope,
          buttons: [{
            text: '<b>OK</b>',
            type: 'button-positive'
          }]
        });
      }

    };

    $scope.prosesLogin = function(l) {
      PelangganService.login(l).success(function(data) {

        if (data.login === true) {
          $window.localStorage.setItem('role', data.role);
          $window.localStorage.setItem('email', data.email);
          $window.localStorage.setItem('id_supir', data.id_supir);

          $scope.modalLogin.hide();
          $scope.inputLogin = {};

          if (data.role === 'ROLE_PELANGGAN') {
            $scope.enable = 0;
            $window.localStorage.setItem('enable', 0);
          } else {
            $scope.enable = 1;
            $window.localStorage.setItem('enable', 1);
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
