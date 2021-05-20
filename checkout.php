

<?php
require_once('functions/config.php');
session_start();

if(isset($_SESSION['account_id'])){
        $accountid = $_SESSION['account_id'];
    $queryuser ="select * from login LEFT JOIN cp_credits on login.account_id = cp_credits.account_id where login.account_id = '$accountid' ";
    $runuser=mysqli_query($link,$queryuser);
    $rowuser=mysqli_fetch_array($runuser);
    $balance=$rowuser['balance'];
    // echo $balance;
    
}
else{
    header('Location: index.php');
}



if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $query ="select * from tradeshop where nameid = '$pid' ";
    $run=mysqli_query($link,$query);
    $row=mysqli_fetch_array($run);
    
    $price = $row['price'];
    
}
else{
    header('Location: product.php');
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Halaman Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
   
    <body>
        <div class="container"  ng-app="myApp" ng-controller="myCtrl">
          <h1>Checkout</h1>
            <form ng-submit="checkout()">
             <center>   <label class="h11">Cost</label><br>  <br>
                    <h3 class="h11"><?php echo $price; ?></h3>
    <br>
                    <hr><br>
                    <label class="h11">Balance</label><br>
                    <br>
                    <h3 class="h11"><?php echo $balance; ?></h3><br><br></center>
                <button>Procced To Purchase</button>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script> 
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>
</html>

<script>
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function($scope, $http, $window) {
    //   $http.get("welcome.htm")
    //   .then(function(response) {
    //     $scope.myWelcome = response.data;
    //   });

$scope.accountid='<?php echo $accountid;?>'  ; 
$scope.balance='<?php echo $balance;?>'  ; 
$scope.price='<?php echo $price;?>'  ;  
$scope.pid='<?php echo $pid;?>'  ;

$scope.balance = parseInt($scope.balance);
$scope.price = parseInt($scope.price);
$scope.checkout=function(){
				if($scope.balance >= $scope.balance){
                    $http.post(
		          "functions/checkout.php",
		          {
                    'accountid':$scope.accountid,
                    'balance':$scope.balance,
                    'price':$scope.price,
                    'pid':$scope.pid	            
		          }
		          ).then(function(response){
		          	
		          	console.log(response.data);
					  $scope.response = response.data;
					 if($scope.response == "yes"){
                        $window.location.href="product.php";
					 }
					 else if($scope.response == "not_active"){
						$scope.msg= "Account is not activated";
					 }
					 else{
						 $scope.msg= "Error: Invalid Credentials";
					
					 }
		          });

                }
                else{
                    swal("Insufficent Balance", "", "error");

                }
				

			}







    });
    </script>
