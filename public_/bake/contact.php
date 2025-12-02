<?php

$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = $successMsg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $valid = false;
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Validate message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
        $valid = false;
    } else {
        $message = htmlspecialchars($_POST["message"]);
    }

    // Send email
    if ($valid) {
        $to = "your-email@example.com"; // Replace with your email
        $subject = "New Contact Us Message from $name";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $successMsg = "Thank you! Your message has been sent.";
            // Clear form fields
            $name = $email = $message = "";
        } else {
            $successMsg = "Sorry, there was an error sending your message.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        h2 { text-align: center; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; text-align: center; margin-bottom: 15px; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
        button { margin-top: 15px; padding: 10px 20px; background: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>

        <?php if($successMsg): ?>
            <p class="success"><?php echo $successMsg; ?></p>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $nameErr; ?></span>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5"><?php echo $message; ?></textarea>
            <span class="error"><?php echo $messageErr; ?></span>

            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
