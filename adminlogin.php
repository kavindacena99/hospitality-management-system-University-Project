<?php require_once'connection/connection.php'; ?>

<?php
    session_start();

    if(isset($_POST['login'])){
        $pswd = mysqli_real_escape_string($connection,$_POST['pswd']);

        $sql2 = "SELECT * FROM admins WHERE admincode='admin' AND pswd='{$pswd}' ";
        $result2 = mysqli_query($connection,$sql2);

        if(mysqli_num_rows($result2) == 1){
            $_SESSION['admincode'] = 'admin';
            header("Location: dash.php");
        }else{
            echo "<p>Invalid Password</p>";
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
<?php require_once 'navadmin.php'; ?>

    <section id="login">
        <div class="container">
            <div class="login-form">
                <h2>Login</h2>
                <form action="adminlogin.php" method="post">
                    <label for="password">Admin Password:</label>
                    <input type="password" id="password" name="pswd" required>
                    
                    <button type="submit" class="btn" name="login">Login</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>