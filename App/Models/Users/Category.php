<?php
namespace App\Models\Users;
use PDO;

class Category extends \Core\Model{

    public function getVendorDetails($id)
    {
        $conn = self::getDB();
        $query = "SELECT * FROM `vendor` WHERE `categoryId` = $id";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }

}