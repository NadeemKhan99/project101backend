<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$name = $obj->name;
$email = $obj->email;
$city = $obj->city;
$phone = $obj->phone;
$address = $obj->address;




$insert_query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where email = '$email'";

                    
$insert_query_run = mysqli_query($check_conn,$insert_query);
if($insert_query_run)
{
    // mysqli_close($check_conn);
    $message="Data Updated successfully!";
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