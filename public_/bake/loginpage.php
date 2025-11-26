<?php

session_start();
?>


<link rel="stylesheet" href="style.css">

<?php include '../components/header.html'; ?>

    <div class="form-container">
        <h1>Welcome Back!</h1>
        <p>Log in to access your saved bakery favourites</p>

        <form action="verify_credentials.php" method="POST">
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    autocomplete="email">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="current-password">
                <div class="forgot-password">
                    <a href="forgot-password.html">Forgot your password?</a>
                </div>
            </div>
            
            <button type="submit" name="loginButton" class="submit-btn">
                Log In
            </button>
        </form>
    </div>

    
        
      
  <?php include '../components/footer.html'; ?>
  <?php include '../components/script.html'; ?>