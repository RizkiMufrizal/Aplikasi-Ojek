'use strict';

angular.module('Aplikasi-Supir')
  .controller('PesanPelangganController', ['$scope', 'PesanSupirService', '$window', '$ionicPopup', function($scope, PesanSupirService, $window, $ionicPopup) {

    $scope.inputPesanSupir = {};
    $scope.enable = 1;

    $scope.dataPesanan = {};

    $scope.prosesPesanSupir = function(p) {
      p.email = $window.localStorage.getItem('email');
      PesanSupirService.pelangganPesanSupir(p).success(function(data) {
        $scope.inputPesanSupir = {};
        $scope.enable = 2;
        checkPesanSupir();
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

    function checkPesanSupir() {
      var c = setInterval(function() {
        PesanSupirService.ambilDataPesananByPelanggan($window.localStorage.getItem('email')).success(function(data1) {

          if (data1.status === '1') {

            clearInterval(c);

            PesanSupirService.ambilDataPesananByPelanggan1($window.localStorage.getItem('email')).success(function(data) {

              PesanSupirService.ambilDataSupir(data.id_supir).success(function(supir) {
                $scope.enable = 3;
                $scope.dataPesanan = data;
                $scope.dataPesanan.nama_supir = supir.nama;

                var userPopup = $ionicPopup.show({
                  template: 'selamat, pesanan anda akan di ambil oleh supir yang bernama ' + supir.nama,
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
