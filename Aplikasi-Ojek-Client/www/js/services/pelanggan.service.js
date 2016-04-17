'use strict';
angular.module('Aplikasi-Ojek')
  .factory('PelangganService', ['$http', function($http) {

    var baseUrl = 'http://127.0.0.1/Aplikasi-Ojek-Server/index.php';

    return {
      register: function(pelanggan) {
        return $http.post(baseUrl + '/PelangganRestController/register', pelanggan);
      },
      login: function(pelanggan) {
        return $http.post(baseUrl + '/PelangganRestController/login', pelanggan);
      }
    }
  }]);
