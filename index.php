<?php require_once'connection/connection.php'; ?>

<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        header("Location: home.php");
    }

    if(isset($_POST['login'])){
        $mail = mysqli_real_escape_string($connection,$_POST['mail']);
        $pswd = mysqli_real_escape_string($connection,$_POST['pswd']);

        $sql2 = "SELECT * FROM users WHERE mails='{$mail}' AND pswd='{$pswd}' ";
        $result2 = mysqli_query($connection,$sql2);

        if(mysqli_num_rows($result2) == 1){
            $row = mysqli_fetch_assoc($result2);
            $_SESSION['user_id'] = $row['userid'];
            $_SESSION['username'] = $row['Names'];

            $sql = "UPDATE users SET online=1 WHERE userid={$_SESSION['user_id']}";
            $result = mysqli_query($connection,$sql);

            header("Location: home.php");
        }else{
            echo "<p>Invalid Password and Email</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Burger Hut</title>
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

        #login {
            padding: 40px 0;
        }

        .login-form {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            width: 300px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            margin-top: 10px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
        }

        .login-form p {
            text-align: center;
            margin-top: 20px;
        }

        .login-form p a {
            color: #77aaff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php require_once 'nav.php'; ?>

    <section id="login">
        <div class="container">
            <div class="login-form">
                <h2>Login</h2>
                <form action="index.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="mail" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="pswd" required>

                    <p><a href="">Forgot Password</a></p>
                    
                    <button type="submit" class="btn" name="login">Login</button>
                </form>
                <p>Don't have an account? <a href="signup.php">Register here</a></p>
            </div>
        </div>
    </section>
</body>
</html>