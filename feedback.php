<?php require_once 'connection/connection.php'; ?>
<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
    }

    $i = 0;

    if(isset($_POST['feedback'])){
        if($i<1){
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $mail = mysqli_real_escape_string($connection,$_POST['mail']);
            $msg = mysqli_real_escape_string($connection,$_POST['message']);

            $sql5 = "INSERT INTO feedbacks(Name,mails,msgs) VALUES('{$name}','{$mail}','{$msg}')";
            $result5 = mysqli_query($connection,$sql5);

            $i++;
        }
    }

    header("Location: home.php");
?>