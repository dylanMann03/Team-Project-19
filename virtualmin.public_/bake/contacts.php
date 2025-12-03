<?php
session_start();
?>

<?php include '../components/header.html'; ?>
<html>
<body>

<div class="contact-container">
    <h1>Contact Us</h1>

    <div>
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" placeholder="Enter your full name">

        <label for="email">Email Address:</label>
        <input type="email" id="email" placeholder="Enter your email address">

        <label for="subject">Subject:</label>
        <input type="text" id="subject" placeholder="Enter the subject">

        <label for="message">Message:</label>
        <textarea id="message" rows="5" placeholder="Enter your message"></textarea>

        <button type="submit">Submit</button>
    </div>

    <div class="info-box">
        <h2>Contact</h2>
        <p>Email: <strong>info@group19.com</strong></p>
    </div>
</div>

</body>
</html>
<?php include '../components/footer.html'; ?>
<?php include '../components/scripts.html'; ?>