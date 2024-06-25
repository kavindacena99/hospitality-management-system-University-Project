<?php require_once 'connection/connection.php'; ?>

<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Hut</title>
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
        .home{
            background: url('images/mainimg.jpg') no-repeat center center/cover;
        }

        .hero {
            height: 550px;
            color: #fff;
            text-align: center;
            padding-top: 150px;
        }

        .hero h2 {
            font-size: 48px;
        }

        .hero p {
            font-size: 24px;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #008CBA;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

        section {
            padding: 40px 0;
        }

        section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .items, .menu-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .item, .menu-item {
            flex: 1 0 45%;
            margin: 10px 0;
            background: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .item img, .menu-item img{
            width: 500px;
            height: 350px;
            border-radius: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            margin-top: 10px;
        }

        form input, form textarea {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            margin-top: 20px;
            padding: 10px 20px;
            color: #fff;
            background: #77aaff;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php require_once 'nav.php'; ?>

    <section class="home">
        <div class="hero">
            <div class="container">
                <h2>Welcome to Burger Hut</h2>
                <p>Experience the best food in town delivered to your door</p>
                <a href="#menu" class="btn">Order Now</a>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Welcome to Burger Hut, where culinary excellence meets exceptional service. Nestled in the heart of Vavuniya, our restaurant offers a variety of delicious dishes prepared with the freshest ingredients. Our talented chefs bring passion and creativity to every plate, ensuring each meal is a memorable experience.</p>
        </div>
    </section>

    <section id="featured-items">
        <div class="container">
            <h2>Featured Items</h2>
            <div class="items">
                <?php
                    $sql4 = "SELECT * FROM foods";
                    
                    if($result_set = $connection->query($sql4)){
                        $i = 0;
                        while($data = $result_set->fetch_array(MYSQLI_ASSOC)){
                            if($i<2){
                                echo   "<div class='item'>" .
                                "<img src=images/" . $data['img'] . ">" .
                                //"<img src=images/" . $data['img'] . ".jpg>" .
                                "<h3>" . $data['name'] . "</h3>" .
                                "<p>" . $data['decrp'] . "</p>" . 
                                "<p>Price: " . $data['price'] . "</p>" .
                                "<a href=\"additem.php?item_id={$data['foodid']}\" class='btn'>Add to Cart</a>" . 
                                "</div>";
                            }
                            $i++;
                        }
                    }
                ?>
            </div>
        </div>
    </section>

    <section id="menu">
        <div class="container">
            <h2>Our Menu</h2>
            <div class="menu-items">
                <?php
                    $sql3 = "SELECT * FROM foods";
                    
                    if($result_set = $connection->query($sql3)){
                        while($data = $result_set->fetch_array(MYSQLI_ASSOC)){
                            echo   "<div class='menu-item'>" .
                                "<img src=images/" . $data['img'] . ">" .
                                "<h3>" . $data['name'] . "</h3>" .
                                "<p>" . $data['decrp'] . "</p>" . 
                                "<p>Price: " . $data['price'] . "</p>" .
                                "<a href=\"additem.php?item_id={$data['foodid']}\" class='btn'>Add to Cart</a>" . 
                                "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </section>

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

    <?php require_once 'footer.php'; ?>
</body>
</html>
