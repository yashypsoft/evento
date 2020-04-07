<?php

namespace App\Models\Users;

use PDO;

class Booking extends \Core\Model
{
    public function getOrderHistroy($userId)
    {
        $conn = self::getDB();
        $query = "SELECT v.*,ve.*,b.* FROM `booking` b INNER JOIN vendorinfo v ON v.id = b.VendorinfoId INNER JOIN vendor ve ON v.vendorId = ve.id WHERE b.userId =$userId";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
