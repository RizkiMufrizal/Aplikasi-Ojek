'use strict';

angular.module('Aplikasi-Supir')
  .controller('SupirController', ['$scope', 'PesanSupirService', '$window', function($scope, PesanSupirService, $window) {

    $scope.dataPesanSupir = {};

    function ambilDataPesananBySupir() {
      PesanSupirService.ambilDataPesananBySupir($window.localStorage.getItem('id_supir')).success(function(data) {
        $scope.dataPesanSupir = data;
      });
    }

    ambilDataPesananBySupir();

  }]);
