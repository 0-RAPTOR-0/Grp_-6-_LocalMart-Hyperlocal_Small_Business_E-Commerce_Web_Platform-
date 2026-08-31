CREATE DATABASE IF NOT EXISTS localmart_db;

USE localmart_db;

CREATE TABLE users (
  
    user_id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(100) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    role ENUM('customer', 'shop_owner', 'delivery_agent', 'admin') NOT NULL DEFAULT 'customer',

    phone VARCHAR(20),

    address VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE shops (

    shop_id INT AUTO_INCREMENT PRIMARY KEY,
    
    owner_id INT NOT NULL,

    name VARCHAR(100) NOT NULL,

     category VARCHAR(50),

    location VARCHAR(100),

    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (owner_id) REFERENCES users(user_id)

);

CREATE TABLE products (

    product_id INT AUTO_INCREMENT PRIMARY KEY,

    shop_id INT NOT NULL,

    name VARCHAR(150) NOT NULL,

    category VARCHAR(50),

    price DECIMAL(10,2) NOT NULL,

    stock INT NOT NULL DEFAULT 0,

    description TEXT,

    image_url VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (shop_id) REFERENCES shops(shop_id)

);


CREATE TABLE carts (

    cart_id INT AUTO_INCREMENT PRIMARY KEY,

    customer_id INT NOT NULL,

    FOREIGN KEY (customer_id) REFERENCES users(user_id)

);

CREATE TABLE cart_items (

    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,

    cart_id INT NOT NULL,

    product_id INT NOT NULL,

    quantity INT NOT NULL DEFAULT 1,

    FOREIGN KEY (cart_id) REFERENCES carts(cart_id),

    FOREIGN KEY (product_id) REFERENCES products(product_id)
    
);
