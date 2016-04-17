'use strict';

angular.module('Aplikasi-Ojek')
  .controller('PesanPelangganController', ['$scope', 'PesanOjekService', '$window', '$ionicPopup', function($scope, PesanOjekService, $window, $ionicPopup) {

    $scope.inputPesanOjek = {};
    $scope.enable = false;
    $scope.enableW = false;
    $scope.dataPesanan = {};

    $scope.prosesPesanOjek = function(p) {
      p.email = $window.localStorage.getItem('email');
      PesanOjekService.pelangganPesanOjek(p).success(function(data) {
        $scope.inputPesanOjek = {};
        $scope.enable = true;
        checkPesanOjek();
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

    function checkPesanOjek() {
      setInterval(function() {
        PesanOjekService.ambilDataPesananByPelanggan($window.localStorage.getItem('email')).success(function(data) {
          $scope.dataPesanan = data;
          if (data.status === 1) {
            $scope.enableW = true;
          }
        })
      }, 3000);
    }

  }]);
