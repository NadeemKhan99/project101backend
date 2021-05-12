<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$cate = $obj->user;
$name = $obj->name;
$email = $obj->email;
$password = $obj->password;
$city = $obj->city;
$phone = $obj->phone;
$address = $obj->address;
$status = "active";






// Check if user is exit already or not-------------

$query = "SELECT * FROM all_user WHERE email='$email'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    $message = "User already exits! Try to login...";
    $retObj=(object)["id"=>$message,"signal"=>1];
    echo json_encode($retObj);
}
else
{

    //  count number of rows for unique category id----------

    $count = "Select * from all_user";
    $count_run = mysqli_query($check_conn,$count);
    $num_count = mysqli_num_rows($count_run);
    if($num_count)
    {
        // $cal_sum = $num_count + 1;
        $user_id = $cate."_".($num_count +1);
        
        
            //  inserting data
            $insert_query = "INSERT INTO all_user(user_id,name,category_id,email,password,city,phone,address,status)VALUES('$user_id','$name','$cate','$email','$password','$city','$phone','$address','$status')";
                            
            $result=mysqli_query($check_conn,$insert_query);
            if($result)
            {
                // mysqli_close($check_conn);
                $message="Account created successfully! Plz Login";
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

    

}




?>