<?php
require('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $output=array();
    $logindata=json_decode(file_get_contents("php://input"));
    $email=$logindata->email;
    $password=$logindata->password;
  




$password = md5($password);

$query = "SELECT * FROM `login` WHERE `email` ='$email' and `user_pass` ='$password'";
$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);


if($count == 1){
    $detail = mysqli_fetch_array($result);
   
            session_start();
            $_SESSION['email'] = $email;
            
   
        
            
            $_SESSION['userid']  = $detail['userid'];
            $_SESSION['account_id']  = $detail['account_id'];
           
    
     
            
            

            // $sql = "UPDATE `users` SET `status` = 'online' WHERE `users`.`id` = '$user_id' ";
            // mysqli_query($link, $sql);

            $login = "yes" ;
}
else{
   
   
      $login ="no" ;
     
     }

     echo $login;
     

     








    }
?>