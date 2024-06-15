<?php require_once'connection/connection.php'; ?>
<?php
    session_start();

    $itemid = $_GET['item_id'];

    $sql = "INSERT INTO orders (userid,foodid,qty) VALUES({$_SESSION['user_id']},{$itemid},1)";
    $result = mysqli_query($connection,$sql);

    if(isset($result)){
        header("Location: home.php");
    }
?>