<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Data</title>
</head>
<body>

<?php
include 'connection.php';

// Check if 'email' parameter is set in the URL
if(isset($_GET['email'])) {
    $email = $_GET['email'];
    
    // Query to fetch data based on email
    $showquery = "SELECT * FROM temp WHERE email='$email'";
    $showdata = mysqli_query($con, $showquery);
    
    // Check if data is found for the given email
    if($showdata && mysqli_num_rows($showdata) > 0) {
        $arrdata = mysqli_fetch_array($showdata);

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email']; 
            $city = $_POST['city'];
            $address = $_POST['address'];

            // Check if a new image is uploaded
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                // Handle image upload
                $image = $_FILES['image']['name'];
                $temp_image = $_FILES['image']['tmp_name'];
                $folder = "images/".$image;
                move_uploaded_file($temp_image, $folder);

                // Update query with image
                $updateQuery = "UPDATE temp SET nam='$name', mobile='$mobile', city='$city', addr='$address', image='$folder' WHERE email='$email'";
            } else {
                // Update query without image
                $updateQuery = "UPDATE temp SET nam='$name', mobile='$mobile', city='$city', addr='$address' WHERE email='$email'";
            }
            
            $res = mysqli_query($con, $updateQuery);
            
            if($res){
                echo "<script>alert('Data updated');</script>";
                header('location:index.php'); // Redirect to index.php after successful form submission
                exit(); 
            } else {
                echo "<script>alert('Data not updated');</script>";
            }
        }
    } else {
        echo "<script>alert('No data found for the given email');</script>";
    }
}
?>

<!-- Form for updating data -->
<form action="" method="POST" enctype="multipart/form-data">
    Name: <input type="text" placeholder="Enter name here" name="name" value="<?php echo isset($arrdata['nam']) ? $arrdata['nam'] : ''; ?>" ><br><br>
    Mobile: <input type="text" placeholder="Enter mobile number here" name="mobile" value="<?php echo isset($arrdata['mobile']) ? $arrdata['mobile'] : ''; ?>"><br><br>
    Email: <input type="text" placeholder="Enter email here" name="email" value="<?php echo isset($arrdata['email']) ? $arrdata['email'] : ''; ?>"><br><br>
    City: <input type="text" placeholder="Enter city name here" name="city" value="<?php echo isset($arrdata['city']) ? $arrdata['city'] : ''; ?>"><br><br>
    Address: <input type="text" placeholder="Enter address here" name="address" value="<?php echo isset($arrdata['addr']) ? $arrdata['addr'] : ''; ?>"><br><br>
    Image: <input type="file" name="image"><br><br>
    <input type="submit" name="submit" value="Update">
    <a href="display.php">Check data</a>
</form>

</body>
</html>
