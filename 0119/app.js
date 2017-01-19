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

            // my define music nav
            .state('music', {
                url: '/music',
                templateUrl: 'partial-music.html'
            })

            // music nested child view
            .state('music.album', {
                url: '/album',
                templateUrl: 'partial-music-album.html',
                controller: function ($scope){
                    $scope.albums = ['爱在西元前', '演员', 'Nobody', 'kamikaze'];

                }

            })

            // music dance nested music view
            .state('music.dance', {
               url: '/dance',
               templateUrl: 'partial-music-dance.html'
            })

            // ABOUT PAGE AND MULTIPLE NAMED VIEWS ================
            .state('about', {
                // we'll get to this in a bit
                url: '/about',
                views: {

                    // the main template will be placed here (relatively named)
                    '': { templateUrl: 'partial-about.html' },

                    // the child views will be defined here (absolutely named)
                    'columnOne@about': { template: 'Look i am a column' },

                    // for column two, we'll define a separate controller
                    'columnTwo@about' : {
                        templateUrl: 'table-data.html',
                        controller: 'scotchController'
                    },
                    'myColumnOne@about': {
                        template: '<h3>This is my first nested router</h3>'
                    },
                    'myColumnTwo@about': {
                        template: '<h3>my Column Two Username:{{username}}, she hobby is {{hobby}}</h3>',
                        controller: 'myCtrl'

                    }
                }
            })
    }) // closes $routerApp.config();

    // let's define the scotch controller that we call up in the about state
    routerApp.controller('scotchController', function ($scope){

        $scope.message = 'test';

        $scope.scotches = [
            {
                name: 'Macallan 12',
                price: 50

            },
            {
                name: 'Chivas Regal Royal Salute',
                price: 10000
            },
            {
                name: 'Glenfiddich 1937',
                price: 20000

            },
            {
                name: 'Coca-cola',
                price: 3

            }
        ];
    });

    routerApp.controller("myCtrl", function  ($scope){
        $scope.username = 'Smille';
        $scope.hobby = 'basketball';
    });



})();