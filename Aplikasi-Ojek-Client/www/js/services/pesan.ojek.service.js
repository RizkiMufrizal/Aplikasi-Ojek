'use strict';
angular.module('Aplikasi-Ojek')
  .factory('PesanOjekService', ['$http', function($http) {

    var baseUrl = 'http://127.0.0.1/Aplikasi-Ojek-Server/index.php';

    return {
      ambilDataPesanan: function() {
        return $http.get(baseUrl + '/PesanOjekRestController/pesanOjeks');
      },
      ambilDataPesananByPelanggan: function(email) {
        return $http.get(baseUrl + '/PesanOjekRestController/pesanOjek/' + email);
      },
      pelangganPesanOjek: function(pesanOjek) {
        return $http.post(baseUrl + '/PesanOjekRestController/pesanOjek', pesanOjek);
      },
      ojekTerimaPesanan: function(pesanOjek) {
        return $http.put(baseUrl + '/PesanOjekRestController/pesanOjek', pelanggan);
      },
      pelangganHapusPesanan: function(idPesanOjek) {
        return $http.delete(baseUrl + '/PesanOjekRestController/pesanOjek/' + idPesanOjek);
      }
    }
  }]);
