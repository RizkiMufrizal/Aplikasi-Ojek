'use strict';
angular.module('Aplikasi-Supir')
  .factory('SupirService', ['$http', function($http) {

    //var baseUrl = 'http://10.42.0.1/Aplikasi-Supir-Server/index.php';
    var baseUrl = 'http://127.0.0.1/Aplikasi-Supir-Server/index.php';
    //var baseUrl = 'http://supir-mufrizal.rhcloud.com';

    return {
      register: function(supir) {
        return $http.post(baseUrl + '/SupirRestController/register', supir);
      }
    }
  }]);
