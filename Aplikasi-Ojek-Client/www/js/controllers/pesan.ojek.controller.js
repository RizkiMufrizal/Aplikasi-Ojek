'use strict';

angular.module('Aplikasi-Ojek')
  .controller('PesanOjekController', ['$scope', 'PesanOjekService', function($scope, PesanOjekService) {

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
          alert('ada data baru');
        }
      });

    }, 3000);

  }]);
