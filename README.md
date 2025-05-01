

# Smartphone Shop

​

## Group ltw11g05

​

- Guilherme Teixeira (up202204875)

- Júlio Santos (up202207975)

- Diogo Neves (up202108460)

​Project Grade: 15.5

## Install Instructions

​

    git clone git@github.com:FEUP-LTW-2024/ltw-project-2024-ltw11g05.git

    git checkout final-delivery-v1

    cd private/database

    sqlite3 phones.db < phones.sql

    cd ../../public

    php -S localhost:9000

​

## Screenshots

​

<p align="center" justify="center">
  <img src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw11g05/blob/main/docs/homepage.png"/>
</p><br><br>

<p align="center" justify="center">
  <img src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw11g05/blob/main/docs/profilepage.png"/>
</p><br><br>

<p align="center" justify="center">
  <img src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw11g05/blob/main/docs/phonepage.png"/>
</p>


​

## Implemented Features

​

**General**:

​

- Register a new account.

- Log in and out.

- Edit their profile, including their name, username, password, and email.

​

**Sellers**  should be able to:

​

- List new items, providing details such as category, brand, model, size, and condition, along with images.

- Track and manage their listed items.

- Respond to inquiries from buyers regarding their items and add further information if needed.

- Print shipping forms for items that have been sold.

​

**Buyers**  should be able to:

​

- Browse items using filters like category, price, and condition.

- Engage with sellers to ask questions or negotiate prices.

- Add items to a wishlist or shopping cart.

- Proceed to checkout with their shopping cart (simulate payment process).

​

**Admins**  should be able to:

​

- Elevate a user to admin status.

- Introduce new item categories, sizes, conditions, and other pertinent entities.

- Oversee and ensure the smooth operation of the entire system.

​

**Security**:

We have been careful with the following security aspects:

​

- **SQL injection**

- **Cross-Site Request Forgery (CSRF)**

​

**Password Storage Mechanism**: hash_password&verify_password

​

**Aditional Requirements**:

​

We have not implemented any aditional requirements.


