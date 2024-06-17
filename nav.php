<?php require_once 'connection/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
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

        header {
            width: 100%;
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 100px;
            border-bottom: #77aaff 3px solid;
        }

        header h1 {
            float: left;
        }

        header nav {
            float: left;
            margin-top: 10px;
        }

        header nav ul {
            list-style: none;
        }

        header nav ul li{
            display: inline;
            margin-left: 20px;
        }

        header nav ul li a, .topic {
            color: #fff;
            text-decoration: none;
        }

        .user-actions {
            float: right;
            margin-top: 10px;
        }

        .user-actions a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="index.php" class="topic">Burger Hut</a></h1>
            <div class="user-actions">
                <?php
                    if(session_status() == PHP_SESSION_ACTIVE){
                        if(isset($_SESSION['user_id'])){
                            $sql11 = "SELECT * FROM users WHERE userid={$_SESSION['user_id']}";
                            $result11 = mysqli_query($connection,$sql11);

                            while($row1 = mysqli_fetch_assoc($result11)){
                                $fname = $row1['Names'];
                            }

                            echo "<a href='myprofile.php'>" . $fname . "</a>";
                            echo "<a href='mycart.php'>Cart</a>";
                            echo "<a href='logout.php'>Log Out</a>";
                            
                        }else{
                            echo "<a href='index.php'>Log In</a>";
                        }
                        echo "<a href='adminlogin.php'>Admin</a>";
                    }
                ?>
            </div>
        </div>
    </header>
</body>
</html>