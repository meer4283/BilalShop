
<!DOCTYPE HTML>
<html>
    <head>
        <title>Halaman Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
   
    <body>
        <div class="container"  ng-app="myApp" ng-controller="myCtrl">
          <h1>Login</h1>
            <form ng-submit="login()">
                <label>Username</label><br>
                <input type="text" ng-model='email'><br>
                <label>Password</label><br>
                <input type="password" ng-model='password'><br>
                <button>Log in</button>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script> 
    </body>
</html>

<script>
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function($scope, $http, $window) {
    //   $http.get("welcome.htm")
    //   .then(function(response) {
    //     $scope.myWelcome = response.data;
    //   });

$scope.login=function(){
				
				$http.post(
		          "functions/login.php",
		          {
		            'email':$scope.email,
		            'password':$scope.password		            
		          }
		          ).then(function(response){
		          	
		          	console.log(response.data);
					  $scope.response = response.data;
					 if($scope.response == "yes"){
						$window.location.href ="product.php";
					 }
					 else if($scope.response == "not_active"){
						$scope.msg= "Account is not activated";
					 }
					 else{
						 $scope.msg= "Error: Invalid Credentials";
					
					 }
		          });

			}







    });
    </script>
