<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$email = $obj->email;
$password = $obj->password;


// Check if user is exit already or not-------------

$query = "SELECT * FROM all_user WHERE email='$email' AND user_id LIKE 'lab_%'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    $row=$result->fetch_assoc();
    if($row['password']==$password)
    {


        $user_id = $row['user_id'];


        //  getting doctor reegister data

        $message = "Login Successfully!";
        
        $name = $row['name'];
        $city = $row['city'];
        $address = $row['address'];
        $phone = $row['phone'];
        $retObj=(object)["signal"=>1,"id"=>$message,"name"=>$name,"user_id"=>$user_id,"city"=>$city,"address"=>$address,"phone"=>$phone,"email"=>$email];
        echo json_encode($retObj);
    }
    else{
        $message="Invalid password or email!";
        $retObj=(object)["signal"=>2,"id"=>$message];
        echo json_encode($retObj);
    }
    
}
else
{

    //  count number of rows for unique category id----------

    
    $message="Email not found. Plz sign up as a user!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}


?>