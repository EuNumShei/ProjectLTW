<?php

declare(strict_types=1);
require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
?>

<?php function drawSideBar(array $brands, array $cameras, array $sizes, array $memory, array $cpus, array $battery, array $colors, array $storages, array $conditions, array $categories) { ?>
    <section id="content">
        <aside id="filters">
            <h2 id="filters-title">Filters:</h2>
            <div class="dropdown">
            <button onclick="toggleDropdown('categoryDropdown', 'categoryDropdownIcon')" class="dropbtn">Category <span id="categoryDropdownIcon">&#9660;</span></button>
                <div id="categoryDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allCategory" name="Category" value="all">
                    <label for="allCategory">All</label><br>
                <?php foreach($categories as $category) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $category ?>" name="Category" value="<?= $category ?>">
                    <label for="<?= $category ?>"><?= $category ?></label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
            <button onclick="toggleDropdown('brandDropdown', 'brandDropdownIcon')" class="dropbtn">Brand <span id="brandDropdownIcon">&#9660;</span></button>
                <div id="brandDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allBrand" name="Brand" value="all">
                    <label for="allBrand">All</label><br>
                <?php foreach($brands as $brand) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $brand ?>" name="Brand" value="<?= $brand ?>">
                    <label for="<?= $brand ?>"><?= $brand ?></label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
            <button onclick="toggleDropdown('cameraDropdown', 'cameraDropdownIcon')" class="dropbtn">Camera <span id="cameraDropdownIcon">&#9660;</span></button>
                <div id="cameraDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allCamera" name="Camera" value="all">
                    <label for="allCamera">All</label><br>
                <?php foreach($cameras as $camera) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $camera ?>" name="Camera" value="<?= $camera ?>">
                    <label for="<?= $camera ?>"><?= $camera ?> MP</label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="toggleDropdown('sizeDropdown','sizeDropdownIcon')" class="dropbtn">Size <span id="sizeDropdownIcon">&#9660;</span></button>
                <div id="sizeDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allSize" name="Size" value="all">
                    <label for="allSize">All</label><br>
                <?php foreach($sizes as $size) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $size ?>" name="Size" value="<?= $size ?>">
                    <label for="<?= $size ?>"><?= $size ?></label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="toggleDropdown('RAMDropdown','RAMDropdownIcon')" class="dropbtn">RAM Memory <span id="RAMDropdownIcon">&#9660;</span></button>
                <div id="RAMDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allRAM" name="RAM" value="all">
                    <label for="allRAM">All</label><br>
                <?php foreach($memory as $ram) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $ram ?>RAM" name="RAM" value="<?= $ram ?>">
                    <label for="<?= $ram ?>RAM"><?= $ram ?> GB</label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="toggleDropdown('cpuDropdown','cpuDropdownIcon')" class="dropbtn">CPU <span id="cpuDropdownIcon">&#9660;</span></button>
                <div id="cpuDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allCPU" name="CPU" value="all">
                    <label for="allCPU">All</label><br>
                <?php foreach($cpus as $cpu) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $cpu ?>CPU" name="CPU" value="<?= $cpu ?>">
                    <label for="<?= $cpu ?>CPU"><?= $cpu ?></label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
            <button onclick="toggleDropdown('batteryDropdown', 'batteryDropdownIcon')" class="dropbtn">Battery <span id="batteryDropdownIcon">&#9660;</span></button>
                <div id="batteryDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allBattery" name="Battery" value="all">
                    <label for="allBattery">All</label><br>
                    <input class="modelcheckbox" type="checkbox" id="0-2000" name="Battery" value="0-2000">
                    <label for="0-2000">0-2000 GHz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="2000-2500" name="Battery" value="2000-2500">
                    <label for="2000-2500">2000-2500 GHz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="2500-3000" name="Battery" value="2500-3000">
                    <label for="2500-3000">2500-3000 GHz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="3000-3500" name="Battery" value="3000-3500">
                    <label for="3000-3500">3000-3500 GHz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="3500-4000" name="Battery" value="3500-4000">
                    <label for="3500-4000">3500-4000 GHz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="4000-4500" name="Battery" value="4000-4500">
                    <label for="4000-4500">4000-4500 Ghz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="4500-5000" name="Battery" value="4500-5000">
                    <label for="4500-5000">4500-5000 GHz</label><br>
                    <input class="modelcheckbox" type="checkbox" id="5000+" name="Battery" value="5000+">
                    <label for="5000+">5000+ GHz</label><br>
                </div>
            </div>
            <div class="dropdown">
            <button onclick="toggleDropdown('colorDropdown', 'colorDropdownIcon')" class="dropbtn">Color <span id="colorDropdownIcon">&#9660;</span></button>
                <div id="colorDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allColors" name="Color" value="all">
                    <label for="all">All</label><br>
                <?php foreach($colors as $color) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $color ?>" name="Color" value="<?= $color ?>">
                    <label for="<?= $color ?>"><?= $color ?></label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
            <button onclick="toggleDropdown('priceDropdown', 'priceDropdownIcon')" class="dropbtn">Price <span id="priceDropdownIcon">&#9660;</span></button>
                <div id="priceDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allprices" name="Price" value="all">
                    <label for="all">All</label><br>
                    <input class="modelcheckbox" type="checkbox" id="0-200" name="Price" value="0-200">
                    <label for="0-200">0-200€</label><br>
                    <input class="modelcheckbox" type="checkbox" id="200-400" name="Price" value="200-400">
                    <label for="200-400">200-400€</label><br>
                    <input class="modelcheckbox" type="checkbox" id="400-600" name="Price" value="400-600">
                    <label for="400-600">400-600€</label><br>
                    <input class="modelcheckbox" type="checkbox" id="600-800" name="Price" value="600-800">
                    <label for="600-800">600-800€</label><br>
                    <input class="modelcheckbox" type="checkbox" id="800-1000" name="Price" value="800-1000">
                    <label for="800-1000">800-1000€</label><br>
                    <input class="modelcheckbox" type="checkbox" id="1000+" name="Price" value="1000+">
                    <label for="1000+">1000+€</label><br>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="toggleDropdown('storageDropdown','storageDropdownIcon')" class="dropbtn">Storage <span id="storageDropdownIcon">&#9660;</span></button>
                <div id="storageDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allstorage" name="Storage" value="all">
                    <label for="allstorage">All</label><br>
                <?php foreach($storages as $storage) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $storage ?>storage" name="Storage" value="<?= $storage ?>">
                    <label for="<?= $storage ?>storage"><?= $storage ?> GB</label><br>
                <?php } ?>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="toggleDropdown('conditionDropdown','conditionDropdownIcon')" class="dropbtn">Condition <span id="conditionDropdownIcon">&#9660;</span></button>
                <div id="conditionDropdown" class="dropdown-content">
                    <input class="modelcheckbox" type="checkbox" id="allConditions" name="Condition" value="all">
                    <label for="all">All</label><br>
                <?php foreach($conditions as $condition) { ?>
                    <input class="modelcheckbox" type="checkbox" id="<?= $condition ?>" name="Condition" value="<?= $condition ?>">
                    <label for="<?= $condition ?>"><?= $condition ?></label><br>
                <?php } ?>
                </div>
            </div>
            <button id ="filterbutton" type="button">Filter</button>
        </aside>
        <script>
            function toggleDropdown(dropdownId, iconId) {
                var dropdownContent = document.getElementById(dropdownId);
                var dropdownIcon = document.getElementById(iconId);
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                    dropdownIcon.innerHTML = "&#9660;";
                } else {
                    dropdownContent.style.display = "block";
                    dropdownIcon.innerHTML = "&#9650;";
                }
            }
        </script>
<?php } ?>

<?php function drawModels(array $phones)
{ 
    $dbh = get_database_connection();
?>
        <section class="product-container" id="product-container">
          <?php foreach($phones as $phone) { 
            $username = User::getUsernameById($dbh,$phone['seller']);
          ?>
            <article class="product">
                <img src="../images/<?= $phone['image'] ?>" alt=<?=$phone['model']?>>
                <h3>
                    <?php if($phone['brand'] == 'Apple' || explode(" ", $phone['model'])[0] == $phone['brand']) { ?>
                        <a class="product-name" href="../pages/model.php?id=<?= $phone['id'] ?>"><?= $phone['model'] ?></a>
                    <?php } else { ?>
                        <a class="product-name" href="../pages/model.php?id=<?= $phone['id'] ?>"><?= $phone['brand'] . ' ' . $phone['model'] ?></a>
                    <?php } ?>
                </h3>
                <p class="modelvalues">Category: <?=$phone['category']?></p>
                <p class="modelvalues">Brand: <?=$phone['brand']?></p>
                <p class="modelvalues">Camera: <?=$phone['camera']?> MP</p>
                <p class="modelvalues">Size: <?=$phone['size']?></p>
                <p class="modelvalues">RAM: <?=$phone['memory']?> GB</p>
                <p class="modelvalues">CPU: <?=$phone['cpu']?></p>
                <p class="modelvalues">Battery: <?=$phone['battery']?> GHz</p>
                <p class="modelvalues">Color: <?=$phone['color']?></p>
                <p class="modelvalues">Storage: <?=$phone['storage']?> GB</p>
                <p class="modelvalues">Price: <?=$phone['price']?> €</p>
                <p class="modelvalues">Condition: <?=$phone['condition']?></p>
                <p class="modelvalues">Seller: <?=$username?></p>
            </article>
          <?php } ?>
        </section>
<?php } ?>

<?php
function drawModel(Phone $phone, User $seller) {
    ?>
        <h1 class="phone-title">
            <a><?= $phone->model ?></a>
        </h1>
        <div class="phone-content">
            <div class="phone-details">
                <img src="../images/<?= $phone->image ?>" alt="<?= $phone->model ?>" class ="phone-image">
                <div class="phone-specs">
                    <p><strong>Seller:</strong> <?=$seller->username?></p>
                    <p><strong>Category:</strong> <?=$phone->category?></p>
                    <p><strong>Brand:</strong> <?= $phone->brand ?></p>
                    <p><strong>Camera:</strong> <?= $phone->camera ?></p>
                    <p><strong>CPU:</strong> <?= $phone->cpu ?></p>
                    <p><strong>Size:</strong> <?= $phone->size ?> inches</p>
                    <p><strong>RAM Memory:</strong> <?= $phone->memory ?> GB</p>
                    <p><strong>Battery:</strong> <?= $phone->battery ?> Ghz</p>
                    <p><strong>Description:</strong> <?= $phone->description ?></p>
                </div>
            </div>
            <table>
                <tr>
                <th>Color</th>
                <th>Storage</th>
                <th>Condition</th>
                <th>Years used</th>
                <th>Price</th>
                <th>Wishlist</th>
                <th>Buy it now</th>
                <?php if($phone->seller == $_SESSION['user_id']) { ?>
                    <th>Edit</th>
                    <th>Remove</th>
                <?php } ?>
                <tr>
                    <td><?= $phone->color ?></td>
                    <td><?= $phone->storage?> GB</td>
                    <td><?= $phone->condition ?></td>
                    <td><?= $phone->years_used ?></td>
                    <td><?= $phone->price ?>€</td>
                    <td>
                        <form action="../actions/buying-items.php" method="post">
                            <input type="hidden" name="phone_id" value="<?= $phone->id ?>">   
                            <input type="hidden" name="action" value="add_to_wishlist">
                            <button type="submit" class="add-to-cart-button">
                                <i class="fas fa-star"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="../actions/buying-items.php" method="post">
                            <input type="hidden" name="phone_id" value="<?= $phone->id ?>">   
                            <input type="hidden" name="action" value="add_to_cart">
                            <button type="submit" class="add-to-cart-button">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    </td>
                    <?php if($phone->seller == $_SESSION['user_id']) { ?>
                        <td>
                            <form action="../pages/edit-product.php" method="post">
                                <input type="hidden" name="phone_id" value="<?= $phone->id ?>">   
                                <input type="hidden" name="action" value="edit_product">
                                <button type="submit" class="add-to-cart-button">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="../actions/removing-items.php" method="post">
                                <input type="hidden" name="phone_id" value="<?= $phone->id ?>">   
                                <input type="hidden" name="action" value="remove_product">
                                <button type="submit" class="add-to-cart-button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    <?php } ?>
                </tr>
                <?php if(isset($_SESSION['not_authenticated'])){ ?>
                    <p class="warning">You can't manage or buy products without logging in</p>
                <?php 
                    unset($_SESSION['not_authenticated']);
                } else if(isset($_SESSION['already_existing'])) { ?>
                    <p class="warning">This product has already been added into your Wishlist/Cart </p>
                <?php
                    unset($_SESSION['already_existing']);
                } ?>
            </table>
            <?php if ($seller->id != $_SESSION['user_id']) { ?>
                <section class="send-message">
                    <h2>Contact the seller</h2>
                    <form action="../actions/send-message.php" method="POST">
                        <input type="hidden" name="receiver" value="<?= $seller->id ?>">
                        <textarea name="content" placeholder="Type your message here"></textarea>
                        <button type="submit">Send</button>
                    </form>
                </section>
            <?php } ?>
            <a href="../index.php">
                <input class="edit-profile" type="button" value="Back">
            </a>
        </div>
    </section>
<?php } ?>