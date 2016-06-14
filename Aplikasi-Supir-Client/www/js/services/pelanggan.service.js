'use strict';
angular.module('Aplikasi-Supir')
  .factory('PelangganService', ['$http', function($http) {

    //var baseUrl = 'http://10.42.0.1/Aplikasi-Supir-Server/index.php';
    var baseUrl = 'http://127.0.0.1/Aplikasi-Supir-Server/index.php';
    //var baseUrl = 'http://supir-mufrizal.rhcloud.com';

    return {
      register: function(pelanggan) {
        return $http.post(baseUrl + '/PelangganRestController/register', pelanggan);
      },
      login: function(pelanggan) {
        return $http.post(baseUrl + '/PelangganRestController/login', pelanggan);
      }
    }
  }]);
