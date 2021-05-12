<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$id = $obj->id;   // appointment_id

$status = "cancel";

$query = "UPDATE appointment SET status='$status'  WHERE id='$id'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{

    $message = "Canceled Successfully!";
    $retObj=(object)["signal"=>1,"message"=>$message];
    echo json_encode($retObj);
}

else{
    $message = "Try Again Later!";
    $retObj=(object)["signal"=>2,"message"=>$message];
    echo json_encode($retObj);
}


    
        
?>