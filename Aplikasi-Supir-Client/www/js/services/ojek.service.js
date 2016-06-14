'use strict';
angular.module('Aplikasi-Ojek')
  .factory('OjekService', ['$http', function($http) {

    //var baseUrl = 'http://10.42.0.1/Aplikasi-Ojek-Server/index.php';
    var baseUrl = 'http://127.0.0.1/Aplikasi-Ojek-Server/index.php';
	//var baseUrl = 'http://ojek-mufrizal.rhcloud.com';

    return {
      register: function(ojek) {
        return $http.post(baseUrl + '/OjekRestController/register', ojek);
      }
    }
  }]);
