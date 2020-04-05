<?php
namespace App\Models\Users;
use PDO;

class Category extends \Core\Model{

    function getCategoryProduct($categoryName){
        $conn = self::getDb();
        
        $query = "";

        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }

}