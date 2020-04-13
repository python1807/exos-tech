'use strict';

// Declare app level module which depends on views, and core components
let myApp =  angular.module('myApp', ['ngResource']);

myApp.value('iconclass', {
    '01d': 'wi-day-sunny',
    '01n': 'wi-night-clear',
    '02d': 'wi-day-cloudy',
    '02n': 'wi-night-alt-cloudy',
    '03d': 'wi-cloud',
    '03n': 'wi-cloud',
    '04d': 'wi-cloudy',
    '04n': 'wi-cloudy',
    '09d': 'wi-rain',
    '09n': 'wi-rain',
    '10d': 'wi-day-rain',
    '10n': 'wi-night-alt-rain',
    '11d': 'wi-thunderstorm',
    '11n': 'wi-thunderstorm',
    '13d': 'wi-snow',
    '13n': 'wi-snow',
    '50d': 'wi-fog',
    '50n': 'wi-fog',

});


myApp.factory('weatherApi', ['$resource', function($resource) {
    let apiKey = '42380653e98ffa9e543872a7de1db1a2';
    let apiBaseUrl = 'http://api.openweathermap.org/data/2.5/weather';

    return $resource(apiBaseUrl + '?q=:location',
        {
            APPID: apiKey,
            mode: 'json',
            units: 'metric',
            lang: 'en',
            location: '@location'
        },
        {
            getCurrentWeather: {
                method: 'GET'
            }
        }
    )

}]);

myApp.controller('baseController', ['$scope', function ($scope){
    $scope.modifyingSettings = false;
    $scope.cities = [];
    $scope.showSettings = function(){
        $scope.modifyingSettings = true;
    };
    $scope.hideSettings = function(){
        $scope.modifyingSettings = false;
    };
}]);

myApp.controller('widgetsController', ['$scope', 'weatherApi', 'iconclass', function ($scope, weatherApi, iconclass){
    $scope.refreshWidget = function(key, city) {
        weatherApi.getCurrentWeather({location: city.name}).$promise
        .then(function (response) {
            $scope.cities[key].weather = response;
            $scope.cities[key].class = iconclass[response.weather[0].icon];
            return true;
        })
        .catch(function (err) {
            alert('An error occured while refreshing');
        });
    }

}]);


myApp.controller('cityManagementController', ['$scope', 'weatherApi', 'iconclass', function ($scope, weatherApi, iconclass){
    $scope.city = {};

    $scope.submit = function() {
        if ($scope.cityName) {
            weatherApi.getCurrentWeather({location: this.cityName}).$promise
            .then(function (response) {
                $scope.city.name = $scope.cityName.charAt(0).toUpperCase() + $scope.cityName.slice(1);
                $scope.city.class = iconclass[response.weather[0].icon];
                $scope.city.weather = response;
                $scope.cities.push($scope.city);
                $scope.cityName = '';
                $scope.city = {};
                return true;
            })
            .catch(function (err) {
                alert('This city does not exist');
            });

        }
    };

    $scope.deleteCity = function(key){
        $scope.cities.splice(key, 1);
    }
}]);


