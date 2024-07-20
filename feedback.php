<?php require_once 'connection/connection.php'; ?>

<?php

    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
    }

    if(isset($_POST['feedback'])){
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $mail = mysqli_real_escape_string($connection,$_POST['mail']);
        $msg = mysqli_real_escape_string($connection,$_POST['message']);

        $sql5 = "INSERT INTO feedbacks(Name,mails,msgs) VALUES('{$name}','{$mail}','{$msg}')";
        $result5 = mysqli_query($connection,$sql5);
    }

    //header("Location: home.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <form action="feedback.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="mail" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit" class="btn" name="feedback">Send Message</button>
            </form>
        </div>
    </section>
</body>
</html>