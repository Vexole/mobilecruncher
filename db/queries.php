<?php

class Queries
{
    public static $registerUserQuery = "INSERT INTO users(first_name, last_name, email, username, phone) 
        VALUES(:firstName, :lastName, :email, :username, :phone)";

    public static $insertPasswordQuery = "INSERT INTO passwords(user_id, password) 
        VALUES (:userId, :password)";

    public static $loginQuery = "SELECT u.id, p.password FROM users u JOIN passwords p 
        ON u.id = p.user_id WHERE u.username = :username AND p.is_current = 1";

    public static $productListQuery = "SELECT p.*, pd.ram, pd.storage_capacity,
        m.name AS manufacturer, os.name AS OS 
        FROM products p JOIN product_details pd ON p.id = pd.product_id 
        JOIN manufacturers m ON pd.manufacturer_id = m.id 
        JOIN operating_systems os ON os.id = pd.os_id";

    public static $productListFilterByOSQuery = "SELECT p.*, pd.ram, pd.storage_capacity, 
        m.name AS manufacturer, os.name AS OS 
        FROM products p JOIN product_details pd ON p.id = pd.product_id 
        JOIN manufacturers m ON pd.manufacturer_id = m.id 
        JOIN operating_systems os ON os.id = pd.os_id WHERE os.id=:osId";

    public static $productListFilterByManufacturerQuery = "SELECT p.*, pd.ram, pd.storage_capacity,
        m.name AS manufacturer, os.name AS OS 
        FROM products p JOIN product_details pd ON p.id = pd.product_id 
        JOIN manufacturers m ON pd.manufacturer_id = m.id 
        JOIN operating_systems os ON os.id = pd.os_id WHERE m.id=:manufacturerId";

    public static $productDetailQuery = "SELECT p.*, pd.ram,
        pd.storage_capacity, pd.screen_size, pd.processor_speed, pd.optical_sensor_resolution, 
        pd.weight, pd.dimension, m.name AS manufacturer, os.name AS OS, pt.name AS processor_type 
        FROM products p JOIN product_details pd ON p.id = pd.product_id 
        JOIN manufacturers m ON pd.manufacturer_id = m.id 
        JOIN operating_systems os ON os.id = pd.os_id
        JOIN processor_types pt ON pt.id = pd.processor_type_id WHERE p.id=:productId";

    public static $manufacturerListQuery = "SELECT * FROM manufacturers";

    public static $osListQuery = "SELECT * FROM operating_systems";

    public static $newCartEntry = "INSERT INTO carts(user_id, status, total) 
        VALUES(:userId, 'IN_PROGRESS', :total);";

    public static $newCartDetailEntry = "INSERT INTO cart_details(cart_id, product_id, quantity) 
        VALUES(:cartId, :productId, :quantity);";

    public static $cartByUser = "SELECT id, total FROM carts WHERE user_id=:userId AND status='IN_PROGRESS'";

    public static $cartDetailsByUser = "SELECT cd.quantity, cd.product_id, p.name, p.price,
        p.image_path FROM cart_details cd 
        JOIN products p ON p.id = cd.product_id WHERE cd.cart_id=:cartId;";

    public static $updateCartById = "UPDATE carts SET total=:total, status=:status 
        WHERE id=:cartId";

    public static $updateCartDetailsById = "UPDATE cart_details SET quantity=:quantity
        WHERE cart_id=:cartId AND product_id=:productId";
}
