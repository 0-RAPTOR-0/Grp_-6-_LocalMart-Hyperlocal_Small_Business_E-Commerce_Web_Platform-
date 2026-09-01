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

CREATE TABLE orders (

    order_id INT AUTO_INCREMENT PRIMARY KEY,
    
    customer_id INT NOT NULL,
    
    status ENUM('placed', 'confirmed', 'out_for_delivery', 'delivered') NOT NULL DEFAULT 'placed',
    
    total_amount DECIMAL(10,2) NOT NULL,
    
    address VARCHAR(255),
    
    city VARCHAR(50),
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_id) REFERENCES users(user_id)
    
);

CREATE TABLE order_items (

    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    
    order_id INT NOT NULL,
    
    product_id INT NOT NULL,
    
    quantity INT NOT NULL,
    
    price DECIMAL(10,2) NOT NULL,
    
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    
    FOREIGN KEY (product_id) REFERENCES products(product_id)

);

CREATE TABLE payments (

    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    
    order_id INT NOT NULL,
    
    method ENUM('bkash', 'nagad', 'cod') NOT NULL,
    
    amount DECIMAL(10,2) NOT NULL,
    
    status ENUM('pending', 'paid') NOT NULL DEFAULT 'pending',
    
    FOREIGN KEY (order_id) REFERENCES orders(order_id)

);

CREATE TABLE deliveries (

    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    
    order_id INT NOT NULL,
    
    agent_id INT,
    
    status ENUM('assigned', 'picked_up', 'on_the_way', 'delivered') NOT NULL DEFAULT 'assigned',
    
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    
    FOREIGN KEY (agent_id) REFERENCES users(user_id)

);

CREATE TABLE reviews (

    review_id INT AUTO_INCREMENT PRIMARY KEY,
    
    customer_id INT NOT NULL,
    
    product_id INT NOT NULL,
    
    rating INT NOT NULL,
    
    comment TEXT,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_id) REFERENCES users(user_id),
    
    FOREIGN KEY (product_id) REFERENCES products(product_id)

);

INSERT INTO users (name, email, password, role, phone, address) VALUES

('Karim Store Owner', 'karim@localmart.com', '$2y$10$abcdefghijklmnopqrstuv', 'shop_owner', '01712345678', 'Mirpur, Dhaka');

INSERT INTO shops (owner_id, name, category, location, status) VALUES

(1, 'Karim Store', 'Grocery', 'Mirpur-10, Dhaka', 'approved');


INSERT INTO products (shop_id, name, category, price, stock, description) VALUES

    (1, 'Premium Rice 5kg', 'Grocery', 320.00, 42, 'Premium quality aromatic rice sourced directly from local farmers.'),
    
    (1, 'Mustard Oil 1L', 'Grocery', 180.00, 30, 'Pure mustard oil from local farms.'),
    
    (1, 'Mixed Spices Pack', 'Grocery', 75.00, 50, 'Freshly ground mixed spices.'),
    
    (1, 'Masoor Dal 1kg', 'Grocery', 95.00, 25, 'High quality red lentils.');

