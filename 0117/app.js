// app.js
(function (){
    var routerApp = angular.module('routerApp', ['ui.router']);

    routerApp.config(function ($stateProvider, $urlRouterProvider){
        $urlRouterProvider.otherwise('/home');

        // HOME STATES AND NESTED VIEWS ====================
        $stateProvider
            .state('home', {
                url: '/home',
                templateUrl: 'partial-home.html'
            })

            // nested list with custom controller
            .state('home.list', {
               url: '/list',
               templateUrl: 'partial-home-list.html',
                controller: function ($scope){
                   $scope.dogs = ['Bernese', 'Husky', 'Goldendoodle'];
                }
            })

            // nested list with just some random string data
            .state('home.paragraph', {
                url: '/paragraph',
                template: 'I could sure use a drink right now.'

            })

            // ABOUT PAGE AND MULTIPLE NAMED VIEWS ================
            .state('about', {
                // we'll get to this in a bit
            })
    });
})();