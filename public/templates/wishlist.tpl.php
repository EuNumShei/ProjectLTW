<?php declare(strict_types = 1); 
$price = 0.00;
?>

<?php function drawWishlist(array $phones) { ?>
    <section class="wishlist">
        <h1 class="wishlist-title">Wishlist</h1>
        <div class ="wishlist-content">
            <div class="wishlist-items">
            <table class ="wishlist-table">
                <tr>
                <th>Model</th>
                <th>Color</th>
                <th>Storage</th>
                <th>Condition</th>
                <th>Years used</th>
                <th>Price</th>
                <th>Remove Item</th>
                </tr>
                <?php foreach ($phones as $phone) { ?>
                <tr>
                    <td><?= $phone->model ?></td>
                    <td><?= $phone->color ?></td>
                    <td><?= $phone->storage?> GB</td>
                    <td><?= $phone->condition ?></td>
                    <td><?= $phone->years_used ?></td>
                    <td><?= $phone->price ?>€</td>
                    <td>
                    <form action="../actions/removing-items.php" method="post">
                        <input type="hidden" name="phone_id" value="<?= $phone->id ?>"> 
                        <input type="hidden" name="action" value="remove_from_wishlist"> 
                        <button type="submit" class="remove-button-wishlist" data-phone-id="<?= $phone->id ?>" data-phone-price="<?= $phone->price ?>">Remove Item</button>
                    </form>
                    </td>
                </tr>
                <?php $price += $phone->price; ?>
                <?php } ?>
            </table><br><br>
            </div>
            <div id="wishlist-total">
                <h3>Total: €<?=$price?></h3><br>
                <a href="../pages/index.php">
                    <button class="edit-profile">Back</button> 
                </a>
                <form action="../actions/buying-items.php" method="post"> 
                        <input type="hidden" name="action" value="add_to_cart_from_wishlist"> 
                        <button id="checkout-btn">Add To Cart</button>
                </form>
            </div>
        </div>
    </section>
<?php } ?>

<?php function drawEmptyWishlist() { ?>
    <section class="wishlist">
        <h1 class="wishlist-title">Wishlist</h1>
        <div class ="wishlist-content">
            <div id="wishlist-total">
                <h3>Total: $0</h3><br>
                <a href="../pages/index.php">
                    <button class="edit-profile">Back</button> 
                </a>
                <button id="checkout-btn">Checkout</button>
            </div>
        </div>
    </section>
<?php } ?>