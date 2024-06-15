<?php require_once 'connection/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        footer .social {
            list-style: none;
            padding: 0;
        }

        footer .social li {
            display: inline;
            margin: 0 10px;
        }

        footer .social li a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <footer>
        <div class="container">
            <p>&copy; 2024 Burger Hut. All Rights Reserved.</p>
            <ul class="social">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Twitter</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>