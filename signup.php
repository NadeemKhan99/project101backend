<?php

include 'connection.php';


// $obj = json_decode(file_get_contents('php://input'));   
// $cate = $obj->user;
// $fname = $obj->fname;
// $lname = $obj->lname;
// $email = $obj->email;
// $password = $obj->password;
// $city = $obj->city;
// $phone = $obj->phone;
// $address = $obj->address;


$cate = "lab";
$fname = "Adeel";
$lname = "Mushtaq";
$email = "mushioo@gmail.com";
$password = "12345678";
$city = "shahdara";
$phone = "12345678";
$address = "shahdar, lahore";
$status = "active";



// Check if user is exit already or not-------------

$query = "SELECT * FROM all_user WHERE email='$email'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    $message = "User already exit! Try to login...";
    echo $message;
    // $retObj=(object)["id"=>$message];
    // echo json_encode($retObj);
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
            $insert_query = "INSERT INTO all_user(user_id,fname,lname,category_id,email,password,city,phone,address,status)VALUES('$user_id','$fname','$lname','$cate','$email','$password','$city','$phone','$address','$status')";
            $insert_query_run = mysqli_query($check_conn,$insert_query);
            if($insert_query_run)
            {
                // mysqli_close($check_conn);
                $message="Account created successfully!";
                echo $message;
                // $retObj=(object)["id"=>$message];
                // echo json_encode($retObj);
            }
            else{
                $message = "Unsuccessfull, Try again later!";
                echo $message;
                // $retObj=(object)["id"=>$message];
                // echo json_encode($retObj);
            }
        // }
        

        
    }

    

}

//test by returning the same values
// $retObj=(object)["id"=>$id,"Name"=>$Name];
// echo json_encode($retObj);


?>