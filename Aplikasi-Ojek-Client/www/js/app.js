angular.module('Aplikasi-Ojek', ['ionic'])

  .run(function($ionicPlatform) {
    $ionicPlatform.ready(function() {
      if (window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        cordova.plugins.Keyboard.disableScroll(true);
      }
      if (window.StatusBar) {
        StatusBar.styleDefault();
      }
    });
  })

  .config(function($stateProvider, $urlRouterProvider) {
    $stateProvider

      .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'PelangganController'
      })
      .state('app.home', {
        url: '/home',
        views: {
          'menuContent': {
            templateUrl: 'templates/home.html'
          }
        }
      })
      .state('app.pesan', {
        url: '/pesan',
        views: {
          'menuContent': {
            templateUrl: 'templates/pesan.ojek.html',
            controller: 'PesanPelangganController'
          }
        }
      })
      .state('app.ojek', {
        url: '/ojek',
        views: {
          'menuContent': {
            templateUrl: 'templates/ojek.html',
            controller: 'PesanOjekController'
          }
        }
      })
      .state('app.order', {
        url: '/order',
        views: {
          'menuContent': {
            templateUrl: 'templates/daftar.order.html',
            controller: 'OjekController'
          }
        }
      });

    $urlRouterProvider.otherwise('/app/home');
  });
