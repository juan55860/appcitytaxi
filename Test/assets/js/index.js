var app = angular.module('dashboard', []);

app.directive("btnLoading", function()
{
  return function(scope, element, attrs)
  {
    scope.$watch(function()
    {
      return scope.$eval(attrs.ngDisabled);
    },
    function(newVal)
    {
      if (newVal)
      {
        return;
      }
      else
      {
        return scope.$watch(function()
        {
          return scope.$eval(attrs.btnLoading);
        },
        function(loading)
        {
          if (loading)
          {
            return element.button("loading");
          }
          element.button("reset");
        });
      }
    });
  };
});


app.controller('DriverCreateController', ['$scope', '$http', function($scope, $http)
{
  $scope.errors     = {}
  $scope.rhs        = ['','O+','O-','AB+','AB-','A+','A-','B+','B-'];
  $scope.is_loading = false;

  $scope.save = function()
  {
    $scope.is_loading = true;
    $http({
    method : 'POST',
    url    : './php/createDriver.php',
    data   : $scope.driver
}).
    success(function(data, status, headers, config)
    {
      $scope.is_loading = false;
      if(data.state == 'true')
      {
        alert( "Persona creada correctamente " + JSON.stringify(data.person) );
        $scope.driver = {};
        $scope.errors = {};
      }
      else
      {
        $scope.errors = data.errors;
      }
    }).
    error(function(data, status, headers, config)
    {
      $scope.is_loading = false;
    });
  }

}]);