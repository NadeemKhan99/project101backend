<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$hospital_id = $obj->id;


// Check if user is exit already or not-------------

$query = "SELECT * FROM hospital WHERE user_id='$hospital_id'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    $row=$result->fetch_assoc();
    


    $specialist = $row['disease_treated'];
    





    //  getting doctor reegister data

    
    
    
    $retObj=(object)["special"=>$specialist];
    echo json_encode($retObj);
    
    
}



?>