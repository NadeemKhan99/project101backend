<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$name = $obj->name;
$email = $obj->email;
$city = $obj->city;
$phone = $obj->phone;
$address = $obj->address;
$clinic = $obj->clinic;
$fees = $obj->fees;
$experience = $obj->experience;
$qualification = $obj->qualification;
$speciality = $obj->speciality;
$doctor = $obj->doctor_id;







$insert_query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where user_id = '$doctor';
                    UPDATE doctor SET experience = '$experience',fees = '$fees',speciality='$speciality',qualification='$qualification',clinic='$clinic' WHERE user_id = '$doctor'";
                    
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



?>