<?php require_once'connection/connection.php'; ?>

<?php
    $deleteitem = $_GET['deletingitem'];

    $sql5 = "DELETE FROM orders WHERE orderid={$deleteitem}";
    $result = mysqli_query($connection,$sql5);

    if(isset($result)){
        header("Location: mycart.php");
    }
?>