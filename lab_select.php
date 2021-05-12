<?php

include 'connection.php';


//-----------------getting all labs detail

// $query = "SELECT * FROM ((all_user INNER JOIN lab ON all_user.user_id=lab.user_id) INNER JOIN timing ON all_user.user_id=timing.user_id)";

// $result=mysqli_query($check_conn,$query);

// if($result)
// {
//     while($row = mysqli_fetch_assoc($result))
//     {
//         echo $row["fname"]."\n";
//         echo $row["lname"]."\n";
//         echo $row["category_id"]."\n";
//         echo $row["email"]."\n";
//         echo $row["password"]."\n";
//         echo $row["city"]."\n";
//         echo $row["phone"]."\n";
//         echo $row["address"]."\n";
//         echo $row["status"]."\n";
//         echo $row["services"]."\n";
//         echo $row["day"]."\n";
//         echo $row["start"]."\n";
//         echo $row["end"]."\n";
//         echo "<br>";
//     }
// }


//       getting all appointments of lab--------------------------


$query = "SELECT * FROM (((all_user INNER JOIN lab ON all_user.user_id=lab.user_id) INNER JOIN timing ON all_user.user_id=timing.user_id) INNER JOIN appointment ON lab.user_id=appointment.lab_id)";

$result=mysqli_query($check_conn,$query);

if($result)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo $row["fname"]."\n";
        echo $row["lname"]."\n";
        echo $row["category_id"]."\n";
        echo $row["email"]."\n";
        echo $row["password"]."\n";
        echo $row["city"]."\n";
        echo $row["phone"]."\n";
        echo $row["address"]."\n";
        echo $row["status"]."\n";
        echo $row["services"]."\n";
        echo $row["day"]."\n";
        echo $row["start"]."\n";
        echo $row["end"]."\n";
        echo $row["slot"]."\n";
        echo $row["date"]."\n";
        echo "<br>";
    }
}




?>