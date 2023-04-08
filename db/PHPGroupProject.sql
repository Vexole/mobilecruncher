DROP DATABASE IF EXISTS mobile_crunchers;

CREATE DATABASE mobile_crunchers;

USE mobile_crunchers;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS passwords;
DROP TABLE IF EXISTS payment_methods;
DROP TABLE IF EXISTS operating_systems;
DROP TABLE IF EXISTS manufacturers;
DROP TABLE IF EXISTS processor_types;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS product_details;
DROP TABLE IF EXISTS carts;
DROP TABLE IF EXISTS cart_details;
DROP TABLE IF EXISTS billing_address;
DROP TABLE IF EXISTS sales;


CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    phone BIGINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE passwords (
	id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    password VARCHAR(100) NOT NULL,
    is_current BOOLEAN DEFAULT 1,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE payment_methods (
	id INT NOT NULL AUTO_INCREMENT,
    payment_mode VARCHAR(20) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE operating_systems (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE manufacturers(
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE processor_types(
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE products (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
	price DECIMAL(8,2),
    quantity INT NOT NULL,
    image_path VARCHAR(50) DEFAULT 'product.png',
    PRIMARY KEY(id)
);

CREATE TABLE product_details (
	id INT NOT NULL AUTO_INCREMENT,
    ram VARCHAR(20) NOT NULL,
    storage_capacity VARCHAR(20) NOT NULL,
    screen_size VARCHAR(20) NOT NULL,
    processor_speed VARCHAR(20) NOT NULL,
    optical_sensor_resolution VARCHAR(20) NOT NULL,
    weight VARCHAR(20) NOT NULL,
    dimension VARCHAR(30) NOT NULL,
    product_id INT NOT NULL,
    manufacturer_id INT NOT NULL,
    processor_type_id INT NOT NULL,
    os_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(product_id) REFERENCES products(id),
    FOREIGN KEY(os_id) REFERENCES operating_systems(id),
    FOREIGN KEY(processor_type_id) REFERENCES processor_types(id),
    FOREIGN KEY(manufacturer_id) REFERENCES manufacturers(id)
);

CREATE TABLE carts (
	id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    status VARCHAR(20) NOT NULL,
    total DECIMAL(8,2) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE cart_details (
	id INT NOT NULL AUTO_INCREMENT,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(cart_id) REFERENCES carts(id),
    FOREIGN KEY(product_id) REFERENCES products(id)
);

CREATE TABLE billing_address (
	id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone BIGINT NOT NULL,
    address_line VARCHAR(100) NOT NULL,
    city VARCHAR(50) NOT NULL,
    country VARCHAR(20) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE sales (
	id INT NOT NULL AUTO_INCREMENT,
    cart_id INT,
    total DECIMAL(10,2),
    payment_method_id INT NOT NULL,
    billing_address_id INT NOT NULL,
    purchased_date DATETIME NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(cart_id) REFERENCES carts(id),
    FOREIGN KEY(payment_method_id) REFERENCES payment_methods(id),
    FOREIGN KEY(billing_address_id) REFERENCES billing_address(id)
);

INSERT INTO payment_methods (id, payment_mode) VALUES
(1, 'Credit Card'), (2, 'Debit Card'), (3, 'Cash');

INSERT INTO operating_systems (name) VALUES
('Android'),
('iOS'),
('Windows Phone'),
('BlackBerry OS');

INSERT INTO manufacturers (name) VALUES
('Samsung'),
('Apple'),
('Huawei'),
('Xiaomi'),
('Oppo'),
('Vivo'),
('Motorola'),
('Nokia'),
('LG'),
('Sony');

INSERT INTO processor_types (name) VALUES
('Snapdragon 888'),
('Exynos 2200'),
('A15 Bionic'),
('Kirin 9000'),
('Dimensity 1200'),
('Snapdragon 870'),
('Helio G95'),
('MediaTek Dimensity 900'),
('Exynos 1080'),
('Snapdragon 765G');

INSERT INTO products (name, price, quantity, image_path) VALUES
('Samsung Galaxy S21 Ultra 5G', 1199.99, 50, 'samsung_galaxy_s21_ultra.jpg'),
('iPhone 13 Pro Max', 1299.00, 30, 'iphone_13_pro_max.jpg'),
('Huawei Mate 40 Pro', 1099.00, 20, 'huawei_mate_40_pro.jpg'),
('Xiaomi Mi 11 Ultra', 999.00, 40, 'xiaomi_mi_11_ultra.jpg'),
('Oppo Find X3 Pro', 1199.99, 35, 'oppo_find_x3_pro.jpg'),
('Vivo X60 Pro+', 999.00, 25, 'vivo_x60_pro+.jpg'),
('Motorola Moto G Power', 199.99, 60, 'motorola_moto_g_power.jpg'),
('Nokia 7.2', 299.99, 15, 'nokia_7.2.jpg'),
('LG V60 ThinQ 5G', 799.99, 10, 'lg_v60_thinq_5g.jpg'),
('Sony Xperia 1 III', 1299.99, 20, 'sony_xperia_1_iii.jpg');

INSERT INTO product_details (ram, storage_capacity, screen_size, processor_speed, optical_sensor_resolution, weight, dimension, product_id, manufacturer_id, processor_type_id, os_id) VALUES 
('12 GB', '128 GB', '6.2 inch', '2.3 GHz', '16 MP', '175 g', '157.9 x 74.7 x 7.8 mm', 1, 1, 2, 1),
('6 GB', '256 GB', '6.7 inch', '2.84 GHz', '12 MP', '198 g', '165.2 x 76.5 x 9.3 mm', 2, 2, 3, 2),
('8 GB', '512 GB', '6.4 inch', '2.7 GHz', '48 MP', '189 g', '158 x 73.4 x 8.4 mm', 3, 3, 4, 1),
('6 GB', '128 GB', '6.5 inch', '2.0 GHz', '13 MP', '185 g', '164.3 x 76.7 x 7.9 mm', 4, 4, 4, 1),
('4 GB', '64 GB', '5.5 inch', '1.4 GHz', '8 MP', '149 g', '151.5 x 74.7 x 8 mm', 5, 5, 5, 1),
('8 GB', '256 GB', '6.8 inch', '2.73 GHz', '64 MP', '208 g', '165.1 x 77.3 x 8.5 mm', 6, 6, 4, 1),
('4 GB', '32 GB', '5.7 inch', '1.4 GHz', '13 MP', '153 g', '151.5 x 71.1 x 8.2 mm', 7, 7, 2, 1),
('6 GB', '128 GB', '6.4 inch', '2.0 GHz', '48 MP', '175 g', '156.9 x 75.4 x 9.1 mm', 8, 8, 6, 1),
('8 GB', '512 GB', '6.7 inch', '2.84 GHz', '12 MP', '198 g', '165.2 x 76.5 x 9.3 mm', 9, 9, 3, 1),
('6 GB', '128 GB', '6.5 inch', '2.0 GHz', '48 MP', '186 g', '159.2 x 75.2 x 8.2 mm', 10, 10, 2, 1);
