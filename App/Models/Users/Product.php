<?php

namespace App\Models\Users;

use PDO;

class Product extends \Core\Model{

    function searchProduct($productName){
        $conn = static::getDB();

        $query = "SELECT * from products WHERE product_name LIKE '%$productName%'";

        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }

}