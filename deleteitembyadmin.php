<?php require_once'connection/connection.php'; ?>

<?php
    session_start();

    if(!isset($_SESSION['admincode'])){
        header("Location: index.php");
    }

    
    $deleteitem = $_GET['admindelete'];

    $sql4 = "SELECT img FROM foods WHERE foodid={$deleteitem}";

    $img = "";

    if($result_set = $connection->query($sql4)){
        while($datarows = $result_set->fetch_array(MYSQLI_ASSOC)){
            $img = $datarows['img'];
        }
    }

    $imagePath = 'images/' . $img;

    if (file_exists($imagePath)) {
        // Attempt to delete the file
        if (unlink($imagePath)) {
            echo "The file $imagePath was deleted successfully.";
        } else {
            echo "Error: The file $imagePath could not be deleted.";
        }
    } else {
        echo "Error: The file $imagePath does not exist.";
    }

    $sql5 = "DELETE FROM foods WHERE foodid={$deleteitem}";
    $result5 = mysqli_query($connection,$sql5);

    if(isset($result5)){
        header("Location: dash.php");
    }
?>