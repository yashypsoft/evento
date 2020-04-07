<?php
namespace App\Models\Users;
use PDO;

class Category extends \Core\Model{

    public function getVendorDetails($id)
    {
        $conn = self::getDB();
        $query = "SELECT v.*,vi.id 'eventId',vi.description,vi.price,vi.startAt,vi.endAt,vm.* FROM `vendor` v RIGHT JOIN vendorinfo vi ON v.id = vi.vendorId RIGHT JOIN vendor_media vm ON v.id =vm.vendorId WHERE vi.categoryId = $id AND vm.thumbnail = 1";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }

    public function getCount($catId)
    {
        $conn = self::getDB();
        $query = "SELECT COUNT(categoryId) 'count' FROM `vendorinfo` WHERE categoryId = $catId";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result[0]['count'];
    }

}