'use strict';
angular.module('Aplikasi-Ojek')
  .factory('PesanOjekService', ['$http', function($http) {

    //var baseUrl = 'http://10.42.0.1/Aplikasi-Ojek-Server/index.php';
    var baseUrl = 'http://127.0.0.1/Aplikasi-Ojek-Server/index.php';
	//var baseUrl = 'http://ojek-mufrizal.rhcloud.com';

    return {
      ambilDataPesanan: function() {
        return $http.get(baseUrl + '/OjekRestController/pesanOjeks');
      },
      ambilDataPesananByPelanggan: function(email) {
        return $http.get(baseUrl + '/OjekRestController/pesanOjek/' + email);
      },
      ambilDataPesananByPelanggan1: function(email) {
        return $http.get(baseUrl + '/OjekRestController/pesanOjek1/' + email);
      },
      ambilDataPesananByOjek: function(idOjek) {
        return $http.get(baseUrl + '/OjekRestController/pesanOjekByOjek/' + idOjek);
      },
      ambilDataOjek: function(idOjek) {
        return $http.get(baseUrl + '/OjekRestController/ojek/' + idOjek);
      },
      pelangganPesanOjek: function(pesanOjek) {
        return $http.post(baseUrl + '/OjekRestController/pesanOjekPost', pesanOjek);
      },
      ojekTerimaPesanan: function(pesanOjek) {
        return $http.put(baseUrl + '/OjekRestController/pesanOjekPut', pesanOjek);
      }
    }
  }]);
