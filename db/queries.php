<?php

class Queries
{
    public static $registerUserQuery = "INSERT INTO users(first_name, last_name, email, username, phone) 
    VALUES(:firstName, :lastName, :email, :username, :phone)";

    public static $insertPasswordQuery = "INSERT INTO passwords(user_id, password) VALUES (:userId, :password)";

    public static $loginQuery = "SELECT u.id, p.password FROM users u JOIN passwords p 
        ON u.id = p.user_id WHERE u.username = :username";

    public static $cartQuery = "
        SET @cartId = NULL;
        IF EXISTS (SELECT 1 FROM carts WEHRE user_id=:userId AND status='IN_PROGRESS')
            BEGIN
                SELECT id INTO @cartId FROM carts WEHRE user_id=:userId AND status='IN_PROGRESS';
                UPDATE carts SET total = :total WHERE id=@cartId;
                UPDATE cart_details SET quantity=:quantity WHERE cart_id=@cart_id 
                    AND product_id=:productId;
            END
        ELSE
            BEGIN
                INSERT INTO carts(user_id, status, total) VALUES (:userId, 'IN_PROGRESS', :total);
                SELECT id INTO @cartId FROM carts WEHRE user_id=:userId AND status='IN_PROGRESS';
                INSERT INTO cart_details(cart_id, product_id, quantity) VALUES 
                (@cartId, :productId, :quantity);
            END
        ENDIF
    ";
}
