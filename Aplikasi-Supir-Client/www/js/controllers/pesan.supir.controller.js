'use strict';

angular.module('Aplikasi-Supir')
  .controller('PesanSupirController', ['$scope', 'PesanSupirService', '$window', '$ionicPopup', function($scope, PesanSupirService, $window, $ionicPopup) {

    $scope.dataPesanSupir = [];

    function ambilDataPesanSupir() {
      PesanSupirService.ambilDataPesanan().success(function(data) {
        $scope.dataPesanSupir = data;
      });
    }

    ambilDataPesanSupir();

    setInterval(function() {

      PesanSupirService.ambilDataPesanan().success(function(data) {
        if (data.length > $scope.dataPesanSupir.length) {
          $scope.dataPesanSupir = data;
          var userPopup = $ionicPopup.show({
            template: 'ada penumpang baru dari ' + data[0].lokasi_awal + ' menuju ' + data[0].lokasi_akhir,
            title: 'Info',
            scope: $scope,
            buttons: [{
              text: '<b>OK</b>',
              type: 'button-positive'
            }]
          });
        }
      });

    }, 3000);

    $scope.ambilPesanan = function(o) {
      o.id_supir = $window.localStorage.getItem('id_supir');

      PesanSupirService.supirTerimaPesanan(o).success(function(data) {
        ambilDataPesanSupir();
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
