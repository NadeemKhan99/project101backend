<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$password = $obj->password;
$email = $obj->email;





$insert_query = "UPDATE all_user SET password='$password' Where email = '$email'";

                    
$insert_query_run = mysqli_query($check_conn,$insert_query);
if($insert_query_run)
{
    // mysqli_close($check_conn);
    $message="Password Updated successfully!";
    $retObj=(object)["id"=>$message,"signal"=>1];
    echo json_encode($retObj);
}
else{
    $message = "Unsuccessfull, Try again later!";
    echo $message;
    $retObj=(object)["id"=>$message,"signal"=>2];
    echo json_encode($retObj);
            }



?>