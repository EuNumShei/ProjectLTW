DROP TABLE IF EXISTS phones;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS wishlist;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS msgs;

CREATE TABLE phones (
    id INTEGER PRIMARY KEY,
    category TEXT,
    color TEXT,
    price REAL,
    storage INTEGER,
    condition TEXT,
    years_used INTEGER,
    seller INTEGER,
    image TEXT,
    brand TEXT,
    model TEXT,
    camera INTEGER,
    cpu TEXT,
    size TEXT,
    memory INTEGER,
    battery INTEGER,
    description TEXT,
    FOREIGN KEY (seller) REFERENCES users(id)
);

CREATE TABLE users (
    id INTEGER PRIMARY KEY,
    username VARCHAR(128),
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255),
    op INTEGER DEFAULT 0
);

CREATE TABLE wishlist (
    id INTEGER PRIMARY KEY,
    user_id INTEGER,
    phone_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (phone_id) REFERENCES phones(id) ON DELETE CASCADE
);

CREATE TABLE cart (
    id INTEGER PRIMARY KEY,
    buyer INTEGER,
    seller INTEGER,
    products TEXT,
    prices TEXT,
    purchase_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer) REFERENCES users(id),
    FOREIGN KEY (seller) REFERENCES users(id)
);

CREATE TABLE msgs (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    sender INTEGER NOT NULL,
    receiver INTEGER NOT NULL,
    content TEXT NOT NULL,
    send_time DATETIME DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (sender) REFERENCES users(id),
    FOREIGN KEY (receiver) REFERENCES users(id)
);

INSERT INTO users (username, email, password_hash, op) VALUES ('john', 'john@op.com', '$2y$10$3BN7kZgEv1bbFohzo8HhduBhyaZuUvg4agkvNQTnqNrZ7h8V3.xTO', 1);

INSERT INTO users (username, email, password_hash, op) VALUES ('jane', 'jane@op.com', '$2y$10$3BN7kZgEv1bbFohzo8HhduBhyaZuUvg4agkvNQTnqNrZ7h8V3.xTO', 0);

-- INSERT INTO msgs (sender, receiver, content, send_time) VALUES (2, 1, 'no', "2024-05-19 17:22:17");

-- INSERT INTO msgs (sender, receiver, content, send_time) VALUES (1, 2, 'give me a refund', "2024-05-19 17:21:17");

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Red', 300, 64, 'A+', 2, 1, 'i13promax.png', 'Apple', 'IPhone XS', 12, 'A12 Bionic', '5.8 inches', 4, 2658, 'The IPhone XR is a previous generation mid-range smartphone produced by Apple.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Blue', 200, 256, 'A', 3, 1, 'i13promax.png', 'Samsung', 'Samsung S24', 12, 'Exynos 2400', '6.2 inches', 8, 5500, 'The Samsung S24 is an upcoming flagship smartphone produced by Samsung Electronics as part of the Samsung Galaxy S series.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Most Value', 'Black', 400, 128, 'B', 1, 1, 'i13promax.png', 'Xiaomi', 'Xiaomi 14', 128, 'Snapdragon 888', '6.81 inches', 8, 5000, 'The Xiaomi 14 is a flagship smartphone produced by Xiaomi.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'White', 350, 64, 'B', 2, 1, 'i13promax.png', 'Huawei', 'Huawei P40 Pro', 8, 'Kirin 990', '6.58 inches', 50, 4200, 'The Huawei P40 Pro is an upgraded version of the Huawei P40 smartphone.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Silver', 250, 256, 'A+', 3, 1, 'i13promax.png', 'Sony', 'Sony Xperia 1', 12, 'Snapdragon 855', '6.5 inches', 6, 3330, 'The Sony Xperia 1 is a flagship smartphone produced by Sony.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Gold', 280, 128, 'B', 1, 1, 'i13promax.png', 'LG', 'LG V60 ThinQ', 12, 'Snapdragon 865', '6.8 inches', 8, 5000, 'The LG V60 ThinQ is a flagship smartphone produced by LG.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Most Value', 'Red', 320, 64, 'A', 2, 1, 'i13promax.png', 'Google', 'Google Pixel 5', 12, 'Snapdragon 765G', '6.0 inches', 8, 4080, 'The Pixel 5 is a flagship smartphone produced by Google.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Blue', 270, 256, 'B', 3, 1, 'i13promax.png', 'Apple', 'IPhone 12 Pro', 12, 'A14 Bionic', '6.1 inches', 6, 2815, 'The iPhone 12 Pro is a high-end smartphone produced by Apple.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Great Condition', 'Black', 380, 128, 'A+', 1, 1, 'i13promax.png', 'Apple', 'IPhone 12 Pro Max', 12, 'A14 Bionic', '6.7 inches', 6, 3687, 'The iPhone 12 Pro Max is the largest and most advanced smartphone produced by Apple.');

INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'White', 290, 64, 'B', 2, 1, 'i13promax.png', 'Apple', 'IPhone 13', 12, 'A15 Bionic', '6.1 inches', 4, 3095, 'The iPhone 13 is a flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Silver', 310, 256, 'A', 3, 1, 'i13promax.png', 'Apple', 'IPhone 13 Mini', 12, 'A15 Bionic', '5.4 inches', 4, 2438, 'The iPhone 13 Mini is a compact flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Most Value', 'Gold', 260, 128, 'B', 1, 1, 'i13promax.png', 'Apple', 'IPhone 13 Pro', 12, 'A15 Bionic', '6.1 inches', 6, 3095, 'The iPhone 13 Pro is a high-end flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Red', 330, 64, 'A+', 2, 1, 'i13promax.png', 'Apple', 'IPhone 13 Pro Max', 12, 'A15 Bionic', '6.7 inches', 6, 3687, 'The iPhone 13 Pro Max is the top-of-the-line flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Blue', 300, 256, 'C', 3, 1, 'i13promax.png', 'Apple', 'IPhone 14', 12, 'A16 Bionic', '6.1 inches', 4, 3095, 'The iPhone 14 is a flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Black', 370, 128, 'C', 1, 1, 'i13promax.png', 'Apple', 'IPhone 14 Mini', 12, 'A16 Bionic', '5.4 inches', 4, 2438, 'The iPhone 14 Mini is a compact flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Best Value', 'White', 300, 64, 'B', 2, 1, 'i13promax.png', 'Apple', 'IPhone 14 Pro', 12, 'A16 Bionic', '6.1 inches', 6, 3095, 'The iPhone 14 Pro is a high-end flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Brand New', 'Silver', 200, 256, 'A+', 3, 1, 'i13promax.png', 'Apple', 'IPhone 14 Pro Max', 12, 'A16 Bionic', '6.7 inches', 6, 3687, 'The iPhone 14 Pro Max is the top-of-the-line flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Great Condition', 'Gold', 400, 128, 'C', 1, 1, 'i13promax.png', 'Apple', 'IPhone 15', 12, 'A17 Bionic', '6.1 inches', 4, 3095, 'The iPhone 15 is a flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Red', 270, 64, 'A', 2, 1, 'i13promax.png', 'Apple', 'IPhone 15 Mini', 12, 'A17 Bionic', '5.4 inches', 4, 2438, 'The iPhone 15 Mini is a compact flagship smartphone produced by Apple.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Blue', 330, 256, 'B', 3, 1, 'i13promax.png', 'Samsung', 'Galaxy S21', 12, 'Exynos 2100', '6.2 inches', 8, 4000, 'The Samsung Galaxy S21 is a flagship smartphone produced by Samsung Electronics as part of the Samsung Galaxy S series.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Red', 300, 64, 'A+', 2, 1, 'i13promax.png', 'Samsung', 'Galaxy S21 Ultra', 12, 'Exynos 2100', '6.8 inches', 12, 5000, 'The Samsung Galaxy S21 Ultra is a flagship smartphone produced by Samsung Electronics as part of the Samsung Galaxy S series.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Best Value', 'Blue', 200, 256, 'A', 3, 1, 'i13promax.png', 'Samsung', 'Galaxy S22', 12, 'Exynos 2200', '6.2 inches', 8, 4500, 'The Samsung Galaxy S22 is an upcoming flagship smartphone produced by Samsung Electronics as part of the Samsung Galaxy S series.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Brand New', 'Black', 400, 128, 'B', 1, 1, 'i13promax.png', 'Samsung', 'Galaxy S22 Ultra', 12, 'Exynos 2200', '6.8 inches', 12, 5500, 'The Samsung Galaxy S22 Ultra is an upcoming flagship smartphone produced by Samsung Electronics as part of the Samsung Galaxy S series.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Great Condition', 'White', 350, 64, 'B', 2, 1, 'i13promax.png', 'Samsung', 'Galaxy S23', 12, 'Exynos 2300', '6.2 inches', 8, 5000, 'The Samsung Galaxy S23 is an upcoming flagship smartphone produced by Samsung Electronics as part of the Samsung Galaxy S series.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Silver', 250, 256, 'A+', 3, 1, 'i13promax.png', 'Xiaomi', 'Xiaomi 12', 128, 'Snapdragon 888', '6.81 inches', 8, 5000, 'The Xiaomi 12 is a flagship smartphone produced by Xiaomi.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Gold', 280, 128, 'B', 1, 1, 'i13promax.png', 'Xiaomi', 'Redmi 13C', 64, 'MediaTek Dimensity 810', '6.6 inches', 6, 5000, 'The Redmi 13C is a mid-range smartphone produced by Redmi.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Red', 320, 64, 'A', 2, 1, 'i13promax.png', 'Xiaomi', 'Redmi Note 10', 128, 'Snapdragon 678', '6.43 inches', 4, 5000, 'The Redmi Note 10 is a mid-range smartphone produced by Redmi.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Best Value', 'Blue', 270, 256, 'B', 3, 1, 'i13promax.png', 'Xiaomi', 'Redmi Note 13', 128, 'Snapdragon 690', '6.43 inches', 6, 5000, 'The Redmi Note 13 is a mid-range smartphone produced by Redmi.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Brand New', 'Black', 380, 128, 'A+', 1, 1, 'i13promax.png', 'Xiaomi', 'Redmi Note 11', 128, 'MediaTek Dimensity 810', '6.43 inches', 6, 5000, 'The Redmi Note 11 is a mid-range smartphone produced by Redmi.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Great Condition', 'White', 290, 64, 'B', 2, 1, 'i13promax.png', 'Huawei', 'Huawei Ascend Mate', 8, 'Kirin 910', '6.1 inches', 2, 4050, 'The Huawei Ascend Mate is a large-screen smartphone produced by Huawei.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Silver', 200, 256, 'A+', 3, 1, 'i13promax.png', 'Huawei', 'P30', 6, 'Kirin 980', '6.1 inches', 40, 3650, 'The Huawei P30 is a flagship smartphone produced by Huawei.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Red', 330, 64, 'A+', 2, 1, 'i13promax.png', 'Huawei', 'P30 Pro', 8, 'Kirin 980', '6.47 inches', 40, 4200, 'The Huawei P30 Pro is an upgraded version of the Huawei P30 smartphone.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Great Condition', 'Blue', 390, 32, 'B', 3, 1, 'i13promax.png', 'Huawei', 'P30 Lite', 4, 'Kirin 710', '6.15 inches', 48, 3340, 'The Huawei P30 Lite is a budget-friendly version of the Huawei P30 smartphone.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Brand New', 'Black', 340, 128, 'A', 1, 1, 'i13promax.png', 'Huawei', 'P30 New Edition', 6, 'Kirin 980', '6.1 inches', 40, 3650, 'The Huawei P30 New Edition is an updated version of the Huawei P30 smartphone.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'White', 370, 64, 'B', 2, 1, 'i13promax.png', 'Google', 'Pixel 4', 64, 'Snapdragon 855', '5.7 inches', 6, 2800, 'The Pixel 4 is a flagship smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Silver', 230, 256, 'A+', 3, 1, 'i13promax.png', 'Google', 'Pixel 4a', 128, 'Snapdragon 730G', '5.81 inches', 6, 3140, 'The Pixel 4a is a mid-range smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Gold', 360, 128, 'B', 1, 1, 'i13promax.png', 'Google', 'Pixel 5', 128, 'Snapdragon 765G', '6.0 inches', 8, 4080, 'The Pixel 5 is a flagship smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Red', 270, 64, 'A', 2, 1, 'i13promax.png', 'Google', 'Pixel 5a', 128, 'Snapdragon 765G', '6.34 inches', 6, 4680, 'The Pixel 5a is a mid-range smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Low Performance', 'Blue', 380, 256, 'B', 3, 1, 'i13promax.png', 'Google', 'Pixel 6', 128, 'Google Tensor', '6.4 inches', 8, 4614, 'The Pixel 6 is a flagship smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Cheap', 'Black', 310, 128, 'A+', 1, 1, 'i13promax.png', 'Google', 'Pixel 6a', 128, 'Google Tensor', '6.2 inches', 6, 4614, 'The Pixel 6a is a mid-range smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Brand New', 'White', 290, 64, 'B', 2, 1, 'i13promax.png', 'Google', 'Pixel 7', 128, 'Google Tensor', '6.4 inches', 8, 4614, 'The Pixel 7 is a flagship smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('Great Condition', 'Silver', 350, 256, 'A', 3, 1, 'i13promax.png', 'Google', 'Pixel Fold', 256, 'Google Tensor', '7.6 inches', 12, 4614, 'The Pixel Fold is a foldable smartphone produced by Google.');
INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES ('High Performance', 'Gold', 270, 128, 'B', 1, 1, 'i13promax.png', 'Google', 'Pixel 8', 128, 'Google Tensor', '6.4 inches', 8, 4614, 'The Pixel 8 is a flagship smartphone produced by Google.');

INSERT INTO users (username, email, password_hash, op) VALUES ('EuNumShei', 'guircteixeira@gmail.com', '$2y$10$RfNw38QjyuLfKiNN727MQ.Wc8ZUP9tCQpiOW.z.WE4p.NacWJPDfG', 1);