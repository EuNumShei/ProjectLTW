<?php declare(strict_types = 1); ?>

<?php function drawProfile(User $user, array $all_products_prices, array $sales_prices, array $phones) { ?>
    <section class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="profile-content">
            <div class="profile-info">
                <h2>Personal Information</h2>
                    <p>Username: <?=$user->username?></p>
                    <p>Email: <?=$user->email?></p>
            </div>
            <div class="profile-orders">
                <h2>My Orders</h2>
                <ul>
                    <?php foreach ($all_products_prices as $products_prices) { ?>
                        <?php for($i = 0; $i < sizeof($products_prices[0]); $i++) { ?>
                            <li><?=$products_prices[0][$i]?> <?=$products_prices[1][$i]?>€</li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div class="profile-breakdowns">
                <h2>My Products</h2>
                <ul>
                    <?php foreach ($phones as $phone) { ?>
                        <li><a href="../pages/model.php?id=<?= $phone['id'] ?>" class="product_name"><?=$phone['model']?></a> <?=$phone['price']?>€</li>
                    <?php } ?>
                </ul>
            </div>
            <div class="profile-sales">
                <h2>My Sales</h2>
                <ul>
                    <?php foreach ($sales_prices as $sale_prices) { ?>
                        <?php for($i = 0; $i < sizeof($sale_prices[0]); $i++) { ?>
                            <div>
                                <li><?=$sale_prices[0][$i]?> <?=$sale_prices[1][$i]?>€</li>
                                <button class="print-button">Print Receipt</button>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <a href="index.php">
                <input class="edit-profile" type="button" value="Back">
            </a>
            <button class="edit-profile" onclick="window.location.href='profile.php?edit=true'">Edit Profile</button>
        </div>
    </section>
<?php } ?>

<?php function drawProfileOperator(User $user, array $all_products_prices, array $sales_prices, array $phones) { ?>
    <section class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="profile-content">
            <div class="profile-info">
                <h2>Personal Information</h2>
                    <p>Username: <?=$user->username?></p>
                    <p>Email: <?=$user->email?></p>
            </div>
            <div class="profile-orders">
                <h2>My Orders</h2>
                <ul>
                    <?php foreach ($all_products_prices as $products_prices) { ?>
                        <?php for($i = 0; $i < sizeof($products_prices[0]); $i++) { ?>
                            <li><?=$products_prices[0][$i]?> <?=$products_prices[1][$i]?>€</li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div class="profile-breakdowns">
                <h2>My Products</h2>
                <ul>
                    <?php foreach ($phones as $phone) { ?>
                        <li><a href="../pages/model.php?id=<?= $phone['id'] ?>" class="product_name"><?=$phone['model']?></a> <?=$phone['price']?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="profile-sales">
                <h2>My Sales</h2>
                <ul>
                    <?php foreach ($sales_prices as $sale_prices) { ?>
                        <?php for($i = 0; $i < sizeof($sale_prices[0]); $i++) { ?>
                            <div class="print-screen">
                                <li><?=$sale_prices[0][$i]?> <?=$sale_prices[1][$i]?>€</li>
                                <button class="print-button" data-sale="<?=$sale_prices[0][$i]?>/<?=$sale_prices[1][$i]?>" data-buyer="<?=$user->username?>" data-seller="<?=$sale_prices[2][$i]?>">Print Receipt</button>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <a href="index.php">
                <input class="edit-profile" type="button" value="Back">
            </a>
            <button class="edit-profile" onclick="window.location.href='profile.php?edit=true'">Edit Profile</button>
            <button class="edit-profile" onclick="window.location.href='op_dashboard.php'">Operator Dashboard</button>
        </div>
    </section>
<?php } ?>

<?php function drawProfileNoUser() { ?>
    <section class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="profile-content">
            <div class="profile-info">
                <h2>Personal Information</h2>
                <p>You have yet to log in</p>
            </div>
        <a href="index.php">
            <input class="edit-profile" type="button" value="Back">
        </a>
        </div>
    </section>
<?php } ?>

<?php function drawProfileChanges(){ ?>
    <section id="profile-changes" class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="profile-changes">
            <button id="change-username" onclick="window.location.href='profile.php?edit=true&username=true'">Change Username</button><br><br>
            <button id="change-email" onclick="window.location.href='profile.php?edit=true&email=true'">Change Email</button><br><br>
            <button id="change-password" onclick="window.location.href='profile.php?edit=true&password=true'">Change Password</button><br><br>
            <a href="profile.php">
                <input type="button" value="Back">
            </a>
        </div>
    </section>
<?php } ?>

<?php function drawUsernameChanges(){ ?>
    <section id="username-changes" class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="username-changes">
            <form action="../actions/profile-changes.php" method="post" class="profile-form" novalidate>
                <div>
                    <label for="old_username">Old Username:</label>
                    <input type="text" id="old_username" name="old_username" required><br><br>
                    <label for="username">New Username:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="confirm_username">Confirm Username:</label>
                    <input type="text" id="confirm_username" name="confirm_username" required><br><br>
                </div>
                <a href="profile.php?edit=true">
                    <input type="button" value="Back">
                </a>
                <input type="submit" value="Change Username">
            </form>
        </div>
    </section>
<?php } ?>

<?php function drawEmailChanges(){ ?>
    <section id="email-changes" class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="email-changes">
            <form action="../actions/profile-changes.php" method="post" class="profile-form" novalidate>
                <div>
                    <label for="old_email">Old Email:</label>
                    <input type="email" id="old_email" name="old_email" required><br><br>
                    <label for="email">New Email:</label>
                    <input type="email" id="email" name="email" required><br><br>
                    <label for="confirm_email">Confirm Email:</label>
                    <input type="email" id="confirm_email" name="confirm_email" required><br><br>
                </div>
                <a href="profile.php?edit=true">
                    <input type="button" value="Back">
                </a>
                <input type="submit" value="Change Email">
            </form>
        </div>
    </section>
<?php } ?>

<?php function drawPasswordChanges(){ ?>
    <section id="password-changes" class="profile">
        <h1 class="profile-title">My Profile</h1>
        <div class="password-changes">
            <form action="../actions/profile-changes.php" method="post" class="profile-form" novalidate>
                <div>
                    <label for="old_password">Old Password:</label>
                    <input type="password" id="old_password" name="old_password" required><br><br>
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" required><br><br>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                </div>
                <a href="profile.php?edit=true">
                    <input type="button" value="Back">
                </a>
                <input type="submit" value="Change Password">
            </form>
        </div>
    </section>
<?php } ?>

<?php function drawReceipt(string $buyer, string $seller, string $phone, int $price) { ?>
    <section class="profile">
        <h1 class="profile-title">Receipt</h1>
            <div class="profile-content">
                <h2>Buyer</h2>
                    <p>Username: <?=$buyer?></p>
                <h2>Seller</h2>
                    <p>Username: <?=$seller?></p>
                <h2>Product</h2>
                    <p>Model: <?=$phone?></p>
                    <p>Price: <?=$price?>€</p>
            </div>
        </div>
    </section>
<?php } ?>