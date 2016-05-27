'use strict';

angular.module('Aplikasi-Ojek')
  .controller('PesanPelangganController', ['$scope', 'PesanOjekService', '$window', '$ionicPopup', function($scope, PesanOjekService, $window, $ionicPopup) {

    $scope.inputPesanOjek = {};
    $scope.enable = 1;

    $scope.dataPesanan = {};

    $scope.prosesPesanOjek = function(p) {
      p.email = $window.localStorage.getItem('email');
      PesanOjekService.pelangganPesanOjek(p).success(function(data) {
        $scope.inputPesanOjek = {};
        $scope.enable = 2;
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
      var c = setInterval(function() {
        PesanOjekService.ambilDataPesananByPelanggan($window.localStorage.getItem('email')).success(function(data1) {

          if (data1.status === '1') {

            clearInterval(c);

            PesanOjekService.ambilDataPesananByPelanggan1($window.localStorage.getItem('email')).success(function(data) {

              PesanOjekService.ambilDataOjek(data.id_ojek).success(function(ojek) {
                $scope.enable = 3;
                $scope.dataPesanan = data;
                $scope.dataPesanan.nama_ojek = ojek.nama;

                var userPopup = $ionicPopup.show({
                  template: 'selamat, pesanan anda akan di ambil oleh ojek yang bernama ' + ojek.nama,
                  title: 'Info',
                  scope: $scope,
                  buttons: [{
                    text: '<b>OK</b>',
                    type: 'button-positive'
                  }]
                });

              });
            });

          }
        })
      }, 3000);
    }

  }]);
