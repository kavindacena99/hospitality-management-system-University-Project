<?php require_once'connection/connection.php'; ?>

<?php
    session_start();

    if(isset($_POST['update'])){
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $mail = mysqli_real_escape_string($connection,$_POST['mail']);
        $pswd = mysqli_real_escape_string($connection,$_POST['pswd']);
        $cpswd = mysqli_real_escape_string($connection,$_POST['cpswd']);

        if($pswd == $cpswd){
            $sql1 = "UPDATE users SET Names='{$name}',mails='{$mail}',pswd='{$pswd}' WHERE userid={$_SESSION['user_id']}";
            $result = mysqli_query($connection,$sql1);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Burger Hut</title>
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

        #profile {
            padding: 40px 0;
        }

        .profile-form {
            background: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-form label {
            display: block;
            margin-top: 10px;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-form button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <?php require_once'nav.php'; ?>

    <section id="profile">
        <div class="container">
            <div class="profile-form">
                <h2>My Profile</h2>
                <form action="" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="mail" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="pswd" required>
                    
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="cpswd" required>
                    
                    <button type="submit" class="btn" name="update">Update Profile</button>
                </form>
            </div>
        </div>
    </section>

</body>
</html>
