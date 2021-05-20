<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$name = $obj->name;
$email = $obj->email;
$address = $obj->address;

if(!empty($email))
{
    $insert_query = "INSERT INTO contact_us(name,email,message)VALUES('$name','$email','$address')";
    $insert_query_run = mysqli_query($check_conn,$insert_query);
    
                if($insert_query_run)
                {
                    $message="Message sent successfully!";
                    $retObj=(object)["id"=>$message,"signal"=>2];
                    echo json_encode($retObj);
                }
                else{
                    $message = "Unsuccessfull, Try again later!";
                    echo $message;
                    $retObj=(object)["id"=>$message,"signal"=>1];
                    echo json_encode($retObj);
                }
        
}


        

?>