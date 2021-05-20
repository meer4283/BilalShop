<?php
require('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $output=array();
    $logindata=json_decode(file_get_contents("php://input"));
    $accountid=$logindata->accountid;
    $balance=$logindata->balance;
    $price=$logindata->price;
    $pid=$logindata->pid;
  
        $remaining = intval($balance) - intval($price);

$updatequery = "UPDATE `tradeshop` SET `sold` = '1', sold_date = NOW()  WHERE `nameid` = '$pid'";


$updateUserBalance = "UPDATE `cp_credits` SET `balance` = '$remaining' WHERE `account_id` = '$accountid'";



if(mysqli_query($link,$updatequery)){
    if(mysqli_query($link,$updateUserBalance)){

        echo "yes";
    }
    else{
        echo "error";
    }

    
}
else{
    echo "error";
}








    }
?>