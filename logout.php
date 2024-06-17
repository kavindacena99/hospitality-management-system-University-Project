<?php
    require_once 'connection/connection.php';
?>
<?php
    session_start();

    $sql1 = "UPDATE users SET online=0 WHERE userid={$_SESSION['user_id']}";
    $result = mysqli_query($connection,$sql1);

    $_SESSION = array();

    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(), '',time()-86400, '/');
    }

    session_destroy();

    header("Location: index.php");
?>