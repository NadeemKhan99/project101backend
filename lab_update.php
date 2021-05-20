<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$name = $obj->name;
$email = $obj->email;
$city = $obj->city;
$phone = $obj->phone;
$address = $obj->address;
$start = $obj->start;
$end = $obj->end;
$speciality = $obj->speciality;
$lab = $obj->lab;



//  update if everything is updated i.e. data,slots,specialities


if(!empty($start) && !empty($speciality))
{

    $insert_query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where user_id = '$lab';
                    UPDATE lab SET services='$speciality' WHERE user_id = '$lab';
                    UPDATE timing SET start = '$start',end = '$end' WHERE user_id = '$lab'";
                    
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
elseif(empty($start) && empty($speciality))
{

    $query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where user_id = '$lab'";

    $result=mysqli_query($check_conn,$query);

    if($result)
    {

        


        $message = "Updated Succesfully! To see changes, plz login again";
        $retObj=(object)["id"=>$message,"signal"=>1];
        echo json_encode($retObj);
    }
    else
    {

       
            $message="Unsuccessfull, plz try again later!";
            $retObj=(object)["signal"=>2,"id"=>$message];
            echo json_encode($retObj);
        

    }



}

elseif(!empty($start) && empty($speciality))
{

    $insert_query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where user_id = '$lab';
    UPDATE timing SET start = '$start',end = '$end' WHERE user_id = '$lab'";
    
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

elseif(empty($start) && !empty($speciality))
{
    $insert_query = "UPDATE all_user SET name='$name',city='$city',phone='$phone',address='$address' Where user_id = '$lab';
    UPDATE lab SET services='$speciality' WHERE user_id = '$lab'";
        
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