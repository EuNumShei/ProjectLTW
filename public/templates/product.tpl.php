<?php declare(strict_types = 1); ?>

<?php function drawAddProduct(array $categories, array $conditions) { ?>
    <section class="product-adding">
        <h1 class="form-title">Product Form</h1>
        <form action="../actions/adding-items.php" method="POST" class="product-adding-form" enctype="multipart/form-data">
            <?php if(isset($_SESSION['add_error'])) { ?>
                <em><?= $_SESSION['add_error'] ?></em>
                <?php unset($_SESSION['add_error']); ?>
            <?php } ?>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category ?>"><?= $category ?></option>
                <?php } ?>
            </select><br><br>
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required><br><br>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required><br><br>

            <label for="camera">Camera:</label>
            <input type="text" id="camera" name="camera" required><br><br>

            <label for="cpu">CPU:</label>
            <input type="text" id="cpu" name="cpu" required><br><br>

            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required><br><br>

            <label for="memory">Memory:</label>
            <input type="text" id="memory" name="memory" required><br><br>

            <label for="battery">Battery:</label>
            <input type="text" id="battery" name="battery" required><br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required><br><br>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required><br><br>
    
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" required><br><br>

            <label for="storage">Storage:</label><br>
            <input type="text" id="storage" name="storage" required><br><br>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition" required>
                <?php foreach ($conditions as $condition) { ?>
                    <option value="<?= $condition ?>"><?= $condition ?></option>
                <?php } ?>
            </select><br><br>

            <label for="years_used">Years Used:</label><br>
            <input type="text" id="years_used" name="years_used" required><br><br>

            <label for="image-upload">Upload an image:</label>
            <input type="file" id="image-upload" name="image-upload"> <br><br>
    
            <input id="submitbutton" type="submit" value="Enviar">
        </form>
        <a href="../pages/index.php">
            <button class="edit-profile">Back</button> 
        </a>
    </section>
<?php } ?>

<?php
function drawUpdateProduct(array $categories, array $conditions, Phone $product) { ?>
    <section class="product-adding">
        <h1 class="form-title">Edit Product</h1>
        <form action="../actions/update-items.php" method="POST" class="product-adding-form" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product->id ?>">
            <?php if(isset($_SESSION['update_error'])) { ?>
                <em><?= $_SESSION['update_error'] ?></em>
                <?php unset($_SESSION['update_error']); ?>
            <?php } ?>
            <input type="hidden" name="product_id" value="<?= $product->id ?>">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category ?>" <?= $product->category == $category ? 'selected' : '' ?>><?= $category ?></option>
                <?php } ?>
            </select><br><br>
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" value="<?= $product->brand ?>" required><br><br>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?= $product->model ?>" required><br><br>

            <label for="camera">Camera:</label>
            <input type="text" id="camera" name="camera" value="<?= $product->camera ?>" required><br><br>

            <label for="cpu">CPU:</label>
            <input type="text" id="cpu" name="cpu" value="<?= $product->cpu ?>" required><br><br>

            <label for="size">Size:</label>
            <input type="text" id="size" name="size" value="<?= $product->size ?>" required><br><br>

            <label for="memory">Memory:</label>
            <input type="text" id="memory" name="memory" value="<?= $product->memory ?>" required><br><br>

            <label for="battery">Battery:</label>
            <input type="text" id="battery" name="battery" value="<?= $product->battery ?>" required><br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?= $product->description ?>" required><br><br>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="<?=  $product->color ?>" required><br><br>

            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" value="<?= $product->price ?>" required><br><br>

            <label for="storage">Storage:</label><br>
            <input type="text" id="storage" name="storage" value="<?= $product->storage ?>" required><br><br>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition" required>
                <?php foreach ($conditions as $condition) { ?>
                    <option value="<?= $condition ?>" <?= $product->condition == $condition ? 'selected' : '' ?>><?= $condition ?></option>
                <?php } ?>
            </select><br><br>

            <label for="years_used">Years Used:</label><br>
            <input type="text" id="years_used" name="years_used" value="<?= $product->years_used ?>" required><br><br>

            <label for="image-upload">Upload an image:</label>
            <input type="file" id="image-upload" name="image-upload"> <br><br>

            <input id="submitbutton" type="submit" value="Update">
        </form>
        <a href="<?= "../pages/model.php?id=" . $product->id ?>">
            <button class="edit-profile">Back</button> 
        </a>
    </section>
<?php } ?>