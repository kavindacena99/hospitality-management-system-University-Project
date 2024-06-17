<?php require_once 'connection/connection.php'; ?>

<?php
    if(isset($_POST['sign'])){
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $mail = mysqli_real_escape_string($connection,$_POST['mail']);
        $pswd = mysqli_real_escape_string($connection,$_POST['pswd']);
        $cpswd = mysqli_real_escape_string($connection,$_POST['cpswd']);

        if($cpswd == $pswd){
            $sql1 = "INSERT INTO users (Names,mails,pswd,online) VALUES('{$name}','{$mail}','{$pswd}',0)";
            $result1 = mysqli_query($connection,$sql1);

            if(isset($result1)){
                //echo "<script>alert('Your Burger Hut account is successfully created. ');</script>";
                header("Location: index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Burger Hut</title>
    <link rel="stylesheet" href="styles.css">
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

        #signup {
            padding: 40px 0;
        }

        .signup-form {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            width: 300px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .signup-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-form label {
            display: block;
            margin-top: 10px;
        }

        .signup-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .signup-form .btn {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            color: #fff;
            background-color: #008CBA;
            border: none;
            border-radius: 5px;
        }

        .signup-form p {
            text-align: center;
            margin-top: 20px;
        }

        .signup-form p a {
            color: #77aaff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php require_once 'nav.php'; ?>

    <section id="signup">
        <div class="container">
            <div class="signup-form">
                <h2>Sign Up</h2>
                <form action="signup.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="mail" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="pswd" required>
                    
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="cpswd" required>
                    
                    <button type="submit" class="btn" name="sign">Sign Up</button>
                </form>
                <p>Already have an account? <a href="index.php">Login here</a></p>
            </div>
        </div>
    </section>
</body>
</html>
