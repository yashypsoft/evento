<?php

namespace App\Models\Users;

use PDO;

class Vendor extends \Core\Model
{

    public function getVendorDetail($id)
    {
        $conn = self::getDB();
        $query = "SELECT v.*,vi.id 'eventId',vi.description,vi.price,vi.startAt,vi.endAt FROM `vendor` v RIGHT JOIN vendorinfo vi ON v.id = vi.vendorId RIGHT JOIN vendor_media vm ON v.id =vm.vendorId WHERE vi.id = $id AND vm.thumbnail =1";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }

    public function getImages($id)
    {
        $conn = self::getDB();
        $query = "SELECT *  FROM `vendor` v INNER JOIN vendor_media vm ON v.id =vm.vendorId WHERE v.id = $id";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getReview($venderInfoId)
    {
        $conn = self::getDB();
        $query = "SELECT * FROM `review` r INNER JOIN vendorinfo vi ON r.vendorInfoId = vi.id INNER JOIN 
        user u  ON u.id = r.userId WHERE vi.id = $venderInfoId";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
