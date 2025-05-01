<?php declare(strict_types = 1); ?>

<?php function drawIndex() { ?>
    <section class="operator-main">
        <h1>Operator Dashboard</h1>
        <nav>
            <ul>
                <li><a href="op_dashboard.php?option=inventory">Inventory</a></li>
                <li><a href="op_dashboard.php?option=users">Users</a></li>
                <li><a href="op_dashboard.php?option=categories">Categories</a></li>
                <li><a href="op_dashboard.php?option=orders">Orders</a></li>
            </ul>
        </nav>
    </section>
<?php } ?>

<?php function drawInventory(array $users, array $phones) { ?>
    <section class="operator-inventory">
        <h2>Inventory</h2>
        <table>
            <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Seller</th>
            <th>Actions</th>
            </tr>
            <?php foreach ($phones as $phone) { ?>
            <tr>
                <td><?= $phone['id']; ?></td>
                <td><?= $phone['model']; ?></td>
                <td>
                    <?php
                    $seller = null;
                    foreach ($users as $user) {
                        if ($user['id'] == $phone['seller']) {
                            $seller = $user;
                            break;
                        }
                    }
                    echo $seller['username'];
                    ?>
                </td>
                <td>
                    <button type="button" class="edit" onclick="location.href='op_dashboard.php?option=inventory&id=<?= $phone['id']; ?>'" class="edit">Edit</button>
                    <button type="submit" id=<?=$phone['id'];?> class="remove-item">Remove</button>
                </td>
                </td>
                </td>
            </tr>
            <?php } ?>
        </table>
    </section>
<?php } ?>

<?php function drawEditItem(Phone $phone, array $fields) { ?>
    <section class="edit-phone">
        <h2>Edit Item</h2>
        <form action="op_dashboard.php?option=inventory&id=<?= $phone->id; ?>" method="post" enctype="multipart/form-data">
            <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
            <?php foreach ($fields as $field => $options) { ?>
            <tr>
                <td><label for="<?= $field; ?>"><?= ucfirst($field); ?></label></td>
                <td>
                <select name="<?= $field; ?>" id="<?= $field; ?>">
                    <?php foreach ($options as $option) { ?>
                    <option value="<?= $option; ?>" <?= $option == $phone->$field ? 'selected' : ''; ?>><?= $option; ?></option>
                    <?php } ?>
                </select>
                </td>
                <td><input class="item_new_field" type="text" name="<?= $field; ?>" id="new_<?= $field; ?>"></td>
                <td><button class="item_new_field_button" type="button" id="<?= $field; ?>">Add</button></td>
            </tr>
            <?php } ?>
            <!-- PRICE -->
            <tr>
                <td><label for="price">Price</label></td>
                <td><input type="text" name="price" id="price" value="<?= $phone->price; ?>"></td>
                <td></td>
                <td></td>
            </tr>
            <!-- YEARS USED -->
            <tr>
                <td><label for="years_used">Years used</label></td>
                <td><input type="text" name="years_used" id="years_used" value="<?= $phone->years_used; ?>"></td>
                <td></td>
                <td></td>
            </tr>
            <!-- SIZE -->
            <tr>
                <td><label for="size">Size</label></td>
                <td><input type="text" name="size" id="size" value="<?= $phone->size; ?>"></td>
                <td></td>
                <td></td>
            </tr>
            <!-- DESCRIPTION -->
            <tr>
                <td><label for="description">Description</label></td>
                <td><textarea name="description" id="description"><?= $phone->description; ?></textarea></td>
                <td></td>
                <td></td>
            </tr>
            </table>
        </form>
        <button type="submit" id="item-update">Save changes</button>
    </section>
<?php } ?>

<?php function drawUsers(array $users) { ?>
    <section class="operator-users">
        <h2>Users</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['op'] == 1 ? 'Operator' : 'User'; ?></td>
                    <td>
                        <?php if ($user['op'] == 1) { ?>
                            <button id=<?= $user['id']; ?> class='op-user-button'>Revoke Operator</button>
                        <?php } else { ?>
                            <button id=<?= $user['id']; ?> class='op-user-button'>Set Operator</button>
                        <?php } ?>
                        <button id=<?= $user['id']; ?> class='delete-user-button'>Delete Account</button>
                    </td>
                </tr>
                <?php } ?>
            </table>
    </section>
<?php } ?>

<?php function drawCategories(array $fields) { ?>
    <section class="operator-categories">
        <button type="submit" id="category-save">Save changes</button>
        <?php foreach ($fields as $field => $options) { ?>
            <table>
                <th><?= ucfirst($field); ?></th>
                </tr>
                <?php foreach ($options as $option) { ?>
                <tr>
                    <td contenteditable="true"><?= $option; ?></td>
                </tr>
                <?php } ?> 
            </table>
        <?php } ?>  
    </section>
<?php } ?>

<?php function drawOrdersHeader() { ?>
    <section class="operator-orders">
        <h2>Orders</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Buyer</th>
                <th>Products</th>
                <th>Prices</th>
                <th>Timestamp</th>
            </tr>
<?php } ?>

<?php function drawOrder(PDO $dbh, array $order, array $products, array $prices, string $cart_timestamp) { ?>
            <tr>
                <td><?= $order['id']; ?></td>
                <td><?= $order['buyer']; ?></td>
                <td>
                    <?php foreach ($products as $product) { ?>
                        <?= $product; ?><br>
                    <?php } ?>
                </td>
                <td>
                    <?php foreach ($prices as $price) { ?>
                        <?= $price; ?><br>
                    <?php } ?>
                </td>
                <td><?= $cart_timestamp; ?></td>
            </tr>
<?php } ?>

<?php function drawOrdersFooter() { ?>
        </table>
    </section>
<?php } ?>

<?php function displayErrorMessage() { ?>
    <h1>Access Denied</h1>
<?php } ?>