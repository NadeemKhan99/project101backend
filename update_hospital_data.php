<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$name = $obj->name;
$email = $obj->email;
$city = $obj->city;
$phone = $obj->phone;
$address = $obj->address;
$hospital_name = $obj->hospital_name;



$get_hospital_id = "SELECT user_id from all_user where email='$email'";

$query_run=mysqli_query($check_conn,$get_hospital_id);

if($query_run)
{
    $row=$result->fetch_assoc();

    $hospital_id = $row['user_id'];


    $insert_query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where user_id = '$hospital_id';
    UPDATE hospital SET hospital_name = '$hospital_name' WHERE user_id = '$hospital_id'";
    
    $insert_query_run = $check_conn -> multi_query($insert_query);
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



}
else{
    $message = "Unsuccessfull, Try again later!";
    echo $message;
    $retObj=(object)["id"=>$message,"signal"=>2];
    echo json_encode($retObj);
    }








?>