<?php require_once'connection/connection.php'; ?>

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Burger Hut</title>
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


        #cart {
            padding: 40px 0;
        }

        #cart h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #008CBA;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        table th {
            background: #008CBA;
            color: #fff;
        }

        table td input {
            width: 50px;
            padding: 5px;
        }

        .cart-total {
            text-align: right;
        }

        .cart-total h3 {
            margin-bottom: 20px;
        }

        button.btn {
            padding: 10px 20px;
            color: #fff;
            background: #008CBA;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .editbtn{
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php require_once'nav.php'; ?>

    <section id="cart">
        <div class="container">
            <h2>Shopping Cart</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql3 = "SELECT * FROM orders WHERE userid={$_SESSION['user_id']}"; 

                        if($result_set = $connection->query($sql3)){
                            while($datarows = $result_set->fetch_array(MYSQLI_ASSOC)){
                                $sql4 = "SELECT name,price FROM foods WHERE foodid={$datarows['foodid']}";
                                $result1 = mysqli_query($connection,$sql4);
                                $row = mysqli_fetch_row($result1);

                                echo "<tr>" . 
                                    "<td>" . htmlspecialchars($row[0]) . "</td>" . 
                                    "<td>" . "<input type='number' value='1' min='1' onchange='updateTotal(this)'>" . "</td>" .
                                    "<td class='unit-price'>" . htmlspecialchars($row[1]) . "</td>" . 
                                    "<td class='total-price'>" . htmlspecialchars($row[1]) . "</td>" .
                                    "<td>" . "<button class='btn'><a href=\"deleteitem.php?deletingitem={$datarows['orderid']}\" class='editbtn'>Remove</a></button>" . "</td>" . 
                                    "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div class="cart-total">
                <h3>Cart Total: <span id="cart-total">0</span></h3>
                <button class="btn">Proceed to Checkout</button>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            updateCartTotal();
        });

        function updateTotal(input){
            const row = input.closest('tr');
            const unitPrice = parseInt(row.querySelector('.unit-price').textContent);
            const quantity = input.value;
            const totalPriceCell = row.querySelector('.total-price');
            totalPriceCell.textContent = (unitPrice * quantity).toFixed();

            updateCartTotal();
        }

        function updateCartTotal() {
            const totalCells = document.querySelectorAll('.total-price');
            let total = 0;
            totalCells.forEach(cell => {
                total += parseInt(cell.textContent);
            });
            document.getElementById('cart-total').textContent = total.toFixed();
        }
    </script>
</body>
</html>
