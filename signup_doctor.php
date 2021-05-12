<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$cate = $obj->category;
$name = $obj->name;
$email = $obj->email;
$password = $obj->password;
$city = $obj->city;
$phone = $obj->phone;
$address = $obj->address;
$clinic = $obj->clinic;
$fees = $obj->fees;
$experience = $obj->experience;
$qualification = $obj->qualification;
$speciality = $obj->speciality;
$start = $obj->start;
$end = $obj->end;
$hospital_id = "nothing";
$day = "M,T,W,TH,F,Sat,Sun";
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
        
        // inserting category id
        // $category_query = "INSERT INTO user_category(category_id)VALUES('$category_id')";
        // $category_query_run = mysqli_query($check_conn,$category_query);
        // if($category_query_run)
        // {
    
            //  inserting data
            $insert_query = "INSERT INTO all_user(user_id,name,category_id,email,password,city,phone,address,status)VALUES('$user_id','$name','$cate','$email','$password','$city','$phone','$address','$status');
                             INSERT INTO doctor(user_id,experience,fees,speciality,qualification,clinic,hospital_id)VALUES('$user_id','$experience','$fees','$speciality','$qualification','$clinic','$hospital_id');
                             INSERT INTO timing(user_id,day,start,end)VALUES('$user_id','$day','$start','$end')";
            $insert_query_run = $check_conn -> multi_query($insert_query);
            if($insert_query_run)
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
        // }
        

        
    }

    

}

//test by returning the same values
// $retObj=(object)["id"=>$id,"Name"=>$Name];
// echo json_encode($retObj);


?>