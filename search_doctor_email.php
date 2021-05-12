<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$email = $obj->email;


// Check if user is exit already or not-------------

$query = "SELECT * FROM all_user WHERE email='$email'";

// -- AND user_id LIKE 'doctor_%'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    $row=$result->fetch_assoc();

    if($row['category_id'] == "doctor")
    {

        $user_id = $row['user_id'];



        $message = "User Exist, Enter shifts of doctor!";
        
        
        $retObj=(object)["signal"=>1,"id"=>$message,"doctor_id"=>$user_id];
        echo json_encode($retObj);


    }

    else{

        $message = "Try with another email!";
        
        
        $retObj=(object)["signal"=>3,"id"=>$message];
        echo json_encode($retObj);
    }
   

    
   
    
}
else
{


    
    $message="Doctor does not exist! Plz enter doctor details";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}


?>