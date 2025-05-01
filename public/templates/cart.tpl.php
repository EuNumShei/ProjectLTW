<?php declare(strict_types = 1); ?>

<?php function drawCart(array $phones) { ?>
    <section class="cart">
    <h1 id="normal_title" class="cart-title">Cart</h1>
    <h1 id="alternative_title" style="display: none;">Confirm Purchase</h1>
        <div id="cart-content" class ="cart-content">
            <div class="cart-items">
            <table class ="cart-table">
                <tr>
                <th>Model</th>
                <th>Color</th>
                <th>Storage</th>
                <th>Condition</th>
                <th>Years used</th>
                <th>Remove Item</th>
                <th>Price</th>
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
                        <input type="hidden" name="action" value="remove_from_cart">
                        <button type="submit" class="remove-button-cart" data-phone-id="<?= $phone->id ?>" data-phone-price="<?= $phone->price ?>">Remove Item</button>
                    </form>
                    </td>
                </tr>
                <?php $price += $phone->price; ?>
                <?php } ?>
            </table><br><br>
            </div>
            <div id="cart-total">
                <h3>Total: €<?=$price?></h3><br>
                <a href="../pages/index.php">
                    <button class="edit-profile">Back</button> 
                </a>
                <button id="checkout-btn" onclick="showPaymentForm()">Checkout</button>
            </div>
        </div>
        <div id="payment-form" style="display: none;" >
            
            <form action="../actions/buying-items.php" method="POST" class="product-buying-form">
                <input type="hidden" name="action" value="complete_purchase">
                <input type="hidden" name="phone_id" value="<?= $phone->id ?>">
                <?php if(isset($_SESSION['buy_error'])) { ?>
                    <em><?= $_SESSION['buy_error'] ?></em>
                    <?php unset($_SESSION['buy_error']); ?>
                <?php } ?>
                <label for="name">Name on the Credit Card:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="number">Number of the Credit Card:</label>
                <input type="text" id="number" name="number" required><br><br>

                <label for="validity">Validity (In the format MM/YY):</label>
                <input type="text" id="validity" name="validity" required><br><br>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required><br><br>
        
                <input id="buybutton" class="edit-profile" type="submit" value="Comprar">
            </form>
            <button id="backbutton" class="edit-profile" onclick="hidePaymentForm(event)">Back</button> 
        </div>
        </section>
    </section>
    <script type="text/javascript">
    window.onload = function() {
        <?php if (isset($_SESSION['show_payment_form'])): ?>
            showPaymentForm();
            <?php unset($_SESSION['show_payment_form']); ?>
        <?php endif; ?>
    }
</script>
<?php } ?>

<?php function drawEmptyCart() { ?>
    <section class="cart">
    <h1 class="cart-title">Cart</h1>
        <div class ="cart-content">
            <div id="cart-total">
                <h3>Total: $0</h3><br>
                <a href="../pages/index.php">
                    <button class="edit-profile">Back</button> 
                </a>
                <button id="checkout-btn">Checkout</button>
            </div>
        </div>
    </section>
<?php } ?>