<?php declare(strict_types = 1); ?>

<?php function drawLoginForm () { 
    session_start();
?>
    <section class="login">
        <h1>Log In</h1>
        <?php if(isset($_SESSION['is_invalid']) && $_SESSION['is_invalid']) { ?>
            <em>Invalid Login</em>
        <?php } ?>
        <form action="../actions/process-login.php" method="post" novalidate>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <a href="index.php">
                <input type="button" value="Back">
            </a>
            <input type="submit" value="Log In">
        </form>
    </section>
<?php } ?>

<?php function drawSignUpForm() { ?>
    <section class="signup">
        <h1 class="signup-title">Sign Up</h1>
        <?php if(isset($_SESSION['error'])){ ?>
            <em><?=$_SESSION['error']?></em>
        <?php 
            unset($_SESSION['error']);
        } ?>
        <form action="../actions/process-signup.php" method="post" class="signup-form" novalidate>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>   
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>
            </div>
            <a href="index.php">
                <input type="button" value="Back">
            </a>
            <input type="submit" value="Sign Up">
        </form>
    </section>
<?php } ?>