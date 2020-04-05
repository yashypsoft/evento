<?php
namespace App\Models\Users;
use PDO;

class Vendor extends \Core\Model{

    public function getVendorDetail($id)
    {
        $conn = self::getDB();
        $query = "SELECT * FROM `vendor` WHERE `id` = $id";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result[0];
    }

}
