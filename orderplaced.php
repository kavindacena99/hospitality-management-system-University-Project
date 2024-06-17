<?php require_once'connection/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed</title>
    <style>
        .btnd{
            padding: 10px 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 200px;
        }
        h2,h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php require_once'nav.php'; ?>

    <h1>Order Placed </h1><br>
    <h2>Thank You <a href="home.php" class="btnd" style="text-decoration: none;">Home</a></h2>
    
</body>
</html>