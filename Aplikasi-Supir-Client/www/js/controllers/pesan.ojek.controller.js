'use strict';

angular.module('Aplikasi-Ojek')
  .controller('PesanOjekController', ['$scope', 'PesanOjekService', '$window', '$ionicPopup', function($scope, PesanOjekService, $window, $ionicPopup) {

    $scope.dataPesanOjek = [];

    function ambilDataPesanOjek() {
      PesanOjekService.ambilDataPesanan().success(function(data) {
        $scope.dataPesanOjek = data;
      });
    }

    ambilDataPesanOjek();

    setInterval(function() {

      PesanOjekService.ambilDataPesanan().success(function(data) {
        if (data.length > $scope.dataPesanOjek.length) {
          $scope.dataPesanOjek = data;
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
      o.id_ojek = $window.localStorage.getItem('id_ojek');

      PesanOjekService.ojekTerimaPesanan(o).success(function(data) {
        ambilDataPesanOjek();
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
