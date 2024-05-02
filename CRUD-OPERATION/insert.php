<?php

include 'connection.php';
include 'index.php';

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $city=$_POST['city'];
    $address=$_POST['address'];
    // Handle image upload
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    $folder = "images/".$image;
    move_uploaded_file($temp_image, $folder);

    $insertQuery="INSERT INTO temp(name, mobile, email, city, addr, image) VALUES ('$name', '$mobile', '$email', '$city', '$address', '$folder')";

    $res = mysqli_query($con, $insertQuery);
    if($res){
        echo "data inserted";
    }else{
        echo "data not inserted: " . mysqli_error($con);
    }
}
?>
