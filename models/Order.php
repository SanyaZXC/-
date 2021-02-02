<?php

class Order
{

    /**
     * Сохранение заказа 
     * @param type $name
     * @param type $email
     * @param type $password
     * @return type
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        // преобразуем массив, в строку в формате json
        $products = json_encode($products);

        $db = Db::getConnection();
        $sql = 'INSERT INTO `product_order` (id, user_name, user_phone, user_comment, user_id, date, products, status) '
                . 'VALUES (NULL, :user_name, :user_phone, :user_comment, :user_id, current_timestamp(),:products, 1)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        
        return $result->execute();
    }

}
