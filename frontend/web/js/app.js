var headerLoginApp=angular.module("headerLogin",[]);

headerLoginApp.factory("loginservice",function ($http,$location){
	var servicebase='site/checklogin';
	var obj={};
	obj.checklogin=function (customer)
	{		
	//return $http.post(servicebase, customer)
	$http.post(servicebase,customer).success(function(data){
              // $location.path("/");
               //$route.reload();
               location.reload();
            });
	}
	return obj;
});

headerLoginApp.config(appconfig);
appconfig.$inject = ['$httpProvider'];
function appconfig($httpProvider){
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
}

headerLoginApp.controller("loginController",function ($scope,loginservice){

	$scope.validateLogin=function ()
	{
		$scope.customer = {};
		$scope.customer={username:$scope.username,password:$scope.password};
		loginservice.checklogin($scope.customer);
		
	}
});
var registrationApp=angular.module("registration",[]);