<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        td {
            margin: 10px;
        }

        .image-cell img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: auto;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <title>Document</title>
</head>
<body>
    <div class="center-div">
        <div class="table-responsive">
            <table border="black" margin: 2px>
                <!-- table head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th colspan="2">Operation</th>
                    </tr>
                    <tbody>
    <?php
    include 'connection.php';

    $selectquery = "SELECT * FROM temp";
    $query = mysqli_query($con, $selectquery);

    while ($res = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $res['nam']; ?></td>
            <td><?php echo $res['mobile']; ?></td>
            <td><?php echo $res['email']; ?></td>
            <td><?php echo $res['city']; ?></td>
            <td><?php echo $res['addr']; ?></td>
            <td class="image-cell">
                <?php
                $imagePath = 'images/' . $res['image'];

                if (file_exists($imagePath)) {
                    echo '<img src="' . $imagePath . '" alt="Image">';
                } else {
                    echo '<img src="default_image.jpg" alt="Default Image">';
                    // or you can display a placeholder or a default image
                    // echo 'Image not found. Path: ' . $imagePath;
                }
                ?>
            </td>
            <td><a href="update.php?email=<?php echo $res['email']; ?>" title="Update"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
            <td><a href="delete.php?email=<?php echo $res['email']; ?>" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
    }
    ?>
</tbody>
                <!-- table body -->
            </table>
        </div>  
    </div>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
