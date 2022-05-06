<?php


$fullname = $_POST['fullname'];
$mobilenumber = $_POST['mobilenumber'];
$email = $_POST['email'];
$message = $_POST['message'];

if (!empty($fullname) || !empty($mobilenumber) || !empty($email) || !empty($message) )

{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname ="sample1";


// create connection // 
$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

if (mysqli_connect_error()){
    die('connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
}

else{
    $SELECT = "SELECT email From feedbacks where email = ?  Limit 1";

    $INSERT = "INSERT Into feedbacks (fullname,mobilenumber,email,message) values(?,?,?,?)";
    
    //prepare statement//
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    //checking name//
    if ($rnum==0){
        $stmt-> close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("siss",$fullname,$mobilenumber,$email,$message);
        $stmt->execute();
        echo"Your Response submited sucessfully";
    }else{
        echo"someone already register using this email";
    }
    $stmt->close();
    $conn->close();
    die();

}
}
?>

