<?php

namespace App\Models\Users;

use PDO;

class Category extends \Core\Model{

    function getCategoryProduct($categoryName){
        $conn = self::getDb();
        
        $query = "SELECT
            p.*
        FROM
            products p
        INNER JOIN products_categories pc ON
            p.id = pc.product_id
        INNER JOIN categories c ON
            c.id = pc.category_id
            WHERE c.url_key = '$categoryName' ";

        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
       
        return $result;
        
    }

}