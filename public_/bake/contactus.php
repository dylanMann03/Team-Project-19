<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = htmlspecialchars($_POST["name"]);
    $email    = htmlspecialchars($_POST["email"]);
    $address  = htmlspecialchars($_POST["address"]);
    $product  = htmlspecialchars($_POST["product"]);
    $quantity = intval($_POST["quantity"]);


    $message = "Order placed successfully! Thank you, $name.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 25px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 18px;
        }

        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background: #3b82f6;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            color: green;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Place an Order</h2>

    <form action="" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="address" placeholder="Delivery Address" required>
        <input type="text" name="product" placeholder="Product Name" required>
        <input type="number" name="quantity" placeholder="Quantity" min="1" required>

        <button type="submit">Place Order</button>
    </form>

    <?php if ($message): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
</div>

</body>
</html>
