<?php 

require_once('./config.php');



$query = "SELECT * from tradeshop  where sold = '0' ";

$output=array();

$run=mysqli_query($link,$query);
if(mysqli_num_rows($run)>0){
    while($row=mysqli_fetch_array($run)){	
        $temp=array();
        $temp['nameid']=$row['nameid'];
        $temp['quantity']=$row['quantity'];
        $temp['price']=$row['price'];
        
   
        array_push($output,$temp);
    }
    echo json_encode($output,JSON_UNESCAPED_SLASHES);	
}
else{
    echo "Error";
}












?>