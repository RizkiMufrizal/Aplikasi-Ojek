'use strict';

angular.module('Aplikasi-Ojek')
  .controller('OjekController', ['$scope', 'PesanOjekService', '$window', function($scope, PesanOjekService, $window) {

    $scope.dataPesanOjek = {};

    function ambilDataPesananByOjek() {
      PesanOjekService.ambilDataPesananByOjek($window.localStorage.getItem('id_ojek')).success(function(data) {
        $scope.dataPesanOjek = data;
      });
    }

    ambilDataPesananByOjek();

  }]);
