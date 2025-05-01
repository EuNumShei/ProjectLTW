<?php declare(strict_types = 1); ?>

<?php function drawHeader(string $title) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/model.css">
    <link rel="stylesheet" href="../css/wishlist.css">
    <link rel="stylesheet" href="../css/add-product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/searchnoauth.js" defer></script>
    <script src="../js/profile.js" defer></script>
    <title><?=$title?></title>
</head>
<body>
    <header class="navbar">
        <h1><a href="../pages/index.php">Smartphone Shop</a></h1>
        <ul>
            <li><a href="../pages/inbox.php">Inbox</a></li>
            <li><a href="../pages/signup.php">Sign Up</a></li>
            <li><a href="../pages/login.php">Log In</a></li>
            <a href="../pages/profile.php">
                <i class="fas fa-user"></i>
            </a>
            <a href="../pages/wishlist.php">
                <i class="fas fa-star"></i>
            </a>
            <a href="../pages/cart.php">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </ul>
    </header>
<?php } ?>

<?php function drawLogOutHeader(string $title) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/model.css">
    <link rel="stylesheet" href="../css/wishlist.css">
    <link rel="stylesheet" href="../css/add-product.css">
    <link rel="stylesheet" href="../css/op_dashboard.css">
    <link rel="stylesheet" href="../css/inbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../js/productbuying.js" defer></script>
    <script src="../js/productremoval.js" defer></script>
    <script src="../js/searchwithauth.js" defer></script>
    <script src="../js/profile.js" defer></script>
    <script src="../js/opcategorysave.js"></script>
    <script src="../js/opcategoryadd.js"></script>
    <script src="../js/opitemupdate.js"></script>
    <script src="../js/opitemremove.js"></script>
    <script src="../js/opuseroptoggle.js"></script>
    <script src="../js/opuserdelete.js"></script>
    <title><?=$title?></title>
</head>
<body>
    <header class="navbar">
        <h1><a href="../pages/index.php">Smartphone Shop</a></h1>
        <ul>
            <li><a href="../pages/inbox.php">Inbox</a></li>
            <li><a href="../actions/process-logout.php">Log Out</a></li>
            <li><a href="../pages/add-product.php">Add Product</a></li>
            <a href="../pages/profile.php">
                <i class="fas fa-user"></i>
            </a>
            <a href="../pages/wishlist.php">
                <i class="fas fa-star"></i>
            </a>
            <a href="../pages/cart.php">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </ul>
    </header>
<?php } ?>

<?php function drawFooter() { ?>
    </section>
    <footer>
        <p>&copy; 2022 SShop. All rights reserved.</p>
    </footer>
</body>
</html>
<?php } ?>