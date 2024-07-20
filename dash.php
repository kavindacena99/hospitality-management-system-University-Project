<?php require_once'connection/connection.php'; ?>

<?php
    session_start();

    if(!isset($_SESSION['admincode'])){
        header("Location: index.php");
    }
    // Check if image file is a actual image or fake image
    if(isset($_POST["add"])) {
        $foodname = mysqli_real_escape_string($connection,$_POST['foodname']);
        $price = $_POST['price'];
        $decrip = mysqli_real_escape_string($connection,$_POST['descrip']);

        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //echo $_FILES["fileToUpload"]["tmp_name"];
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        // Check file size (15MB maximum)
        if ($_FILES["fileToUpload"]["size"] > 15000000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $j = 0;
            //echo "Sorry, your file was not uploaded.<br>";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $imagename = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));

                $sql5 = "INSERT INTO foods (name,img,price,decrp) VALUES('{$foodname}','{$imagename}',{$price},'{$decrip}')";
                $result5 = mysqli_query($connection,$sql5);

                header("Location: dash.php");
                //echo "The file ". $imagename . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Burger Hut</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }


        #cart {
            padding: 40px 0;
        }

        #cart h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #008CBA;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        table th {
            background: #008CBA;
            color: #fff;
        }

        table td input {
            width: 50px;
            padding: 5px;
        }

        .cart-total {
            text-align: right;
        }

        .cart-total h3 {
            margin-bottom: 20px;
        }

        button.btn {
            padding: 10px 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btnd{
            padding: 10px 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 200px;
        }
        button.btnf{
            padding: 10px 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 200px;
        }
        .editbtn{
            text-decoration: none;
            color: #fff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            margin-top: 10px;
        }

        form input, form textarea {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php require_once'navadmin.php'; ?>

    <section id="cart">
        <div class="container">
            <h2>Online Users Now</h2>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql3 = "SELECT * FROM users WHERE online=1"; 

                        if($result_set = $connection->query($sql3)){
                            while($datarows = $result_set->fetch_array(MYSQLI_ASSOC)){
                                echo "<tr>" .
                                    "<td>" . $datarows['Names'] . "</td>" . 
                                    "<td>" . $datarows['mails'] . "</td>" . 
                                    "<td>Online</td>";
                            }
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <h2>Add a New Item</h2>
                <form action="dash.php" method="post" enctype="multipart/form-data">
                    <label for="name">Food Name:</label>
                    <input type="text" id="name" name="foodname" required>
                    
                    <label for="email">Price</label>
                    <input type="number" id="email" name="price" required>
                    
                    <label for="message">Message:</label>
                    <textarea id="message" name="descrip" required></textarea>

                    <label for="file">Choose photo to upload:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>

                    <button type="submit" class="btn" name="add">Add a new food</button>
                </form>

            <br><br>
            <h2>Update and Remove</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql6 = "SELECT * FROM foods";
                        $result6 = mysqli_query($connection,$sql6);

                        if($result_set6 = $connection->query($sql6)){
                            $i = 0;
                            while($datarows = $result_set6->fetch_array(MYSQLI_ASSOC)){
                                $i++;
                                echo "<tr>" . 
                                    "<td>" . $i . "</td>" . 
                                    "<td>" . $datarows['name'] . "</td>" .
                                    "<td>" . $datarows['price'] . "</td>" .
                                    "<td>" . 
                                        "<a href=\"updateprice.php?updatingitem={$datarows['foodid']}\" style='text-decoration:none;' class='btnd'>Update Price</a>    " .
                                        "  <a href=\"deleteitembyadmin.php?admindelete={$datarows['foodid']}\" style='text-decoration:none;' class='btnd'>Delete</a>" .
                                    "</td>" .
                                    "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
            <br><br>
            <h2>Customer Feedbacks</h2>
                <?php
                    $sql1 = "SELECT * FROM feedbacks";

                    if($result_set1 = $connection->query($sql1)){
                        while($datarows = $result_set1->fetch_array(MYSQLI_ASSOC)){
                            echo "<h3 style='color:red'>" . $datarows['Name'] . "</h3>" . " " . "<h4>" . $datarows['mails'] . "</h4>" . 
                                "<p>" . $datarows['msgs'] . "</p><br>";
                        }
                    }
                ?>
            <br><br>
        </div>
    </section>
</body>
</html>
