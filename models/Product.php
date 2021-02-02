<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;

    /**
     * Returns an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = $page * $count;


        $db = Db::getConnection();

        $productsList = [];

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
            . 'WHERE status = "1" '
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count 
            . ' OFFSET '. $offset);
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }

    /**
     * Возвращает спиок рекомендуемых товаров
     */
    public static function getRecomendedProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $productsRecomendedList = [];

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
            . 'WHERE status = "1" AND is_recommended = "1" '
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count );
        $i = 0;
        while ($row = $result->fetch()) {
            $productsRecomendedList[$i]['id'] = $row['id'];
            $productsRecomendedList[$i]['name'] = $row['name'];
            $productsRecomendedList[$i]['price'] = $row['price'];
            $productsRecomendedList[$i]['image'] = $row['image'];
            $productsRecomendedList[$i]['is_new'] = $row['is_new'];
            $i++;
        }


        return $productsRecomendedList;
    }



    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = $page * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $products = [];
            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                . "WHERE status = 1 AND category_id = " . $categoryId 
                . " ORDER BY id DESC "
                . "LIMIT " . self::SHOW_BY_DEFAULT
                . " OFFSET ". $offset .";");

            $i = 0;

            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;
        }
    }

    
    public static function getProductById($id)
    {
        $id = intval($id);

        if ($id) {

            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM product WHERE id = '. $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();

        }
    }

    public static function getTotalProductInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '.
                                        'WHERE status="1" AND category_id = '.$categoryId);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];

        
    }

    public static function getProdustsByIds($idsArray)
    {
        $products = array();
        
        $db = Db::getConnection();
        
        $idsString = implode(',', $idsArray);

        // Оператор IN - где id будет принадлежать определённому списку
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }
}