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
                        if(isset($_SESSION['admincode'])){
                            echo "<a href='logoutadmin.php'>Log Out</a>";
                        }
                    }
                ?>
            </div>
        </div>
    </header>
</body>
</html>