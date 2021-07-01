<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$email = $obj->email;
$password = $obj->password;
$status = "active";

// Check if user is exit already or not-------------

$query = "SELECT * FROM all_user WHERE email='$email' AND user_id LIKE 'hospital_%' AND status='$status'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    $row=$result->fetch_assoc();
    if($row['password']==$password)
    {


        $hospital_id = $row['user_id'];



        $query_doctor_data = "SELECT * FROM hospital where user_id = '$hospital_id'";

        $result_doctor=mysqli_query($check_conn,$query_doctor_data);
        
        if($result_doctor)
        {
            while($row1 = mysqli_fetch_assoc($result_doctor))
            {

                
                $hospital_name =  $row1["hospital_name"];
                $numberDoctor = $row1["no_doctors"];
                $speciality = $row1["disease_treated"];
            
            }
        }





        //  getting doctor reegister data

        $message = "Login Successfully!";
        
        $name = $row['name'];
        $city = $row['city'];
        $address = $row['address'];
        $phone = $row['phone'];
        $retObj=(object)["signal"=>1,"id"=>$message,"name"=>$name,"user_id"=>$hospital_id,"city"=>$city,"address"=>$address,"phone"=>$phone,"email"=>$email,"password"=>$password,"hospital_name"=>$hospital_name,"number_doctor"=>$numberDoctor,"speciality"=>$speciality];
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

    
    $message="Email not found!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}


?>