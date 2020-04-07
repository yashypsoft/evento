<?php
namespace App\Models\Users;
use PDO;

class Payment extends \Core\Model{

    public function getOrderDetails($userId)
    {
        $conn = self::getDB();
        $query = "SELECT * FROM `booking` WHERE userId = $userId  ORDER by  `bookedAt` DESC LIMIT 1";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }

    public $errArray = [];
    public function validate($fieldData)
    {

        foreach($fieldData as $key => $value){
            switch($key){
                case  'urlKey':
                    if(!empty($value) && !ctype_alpha($value)){
                        $this->errArray[$key] = 'URLKey is must be character';
                    }
                break;
                case 'name':
                case 'description':
                    if(empty($value)){
                        $this->errArray[$key] = "$key is required";
                    }
                break;
                
            }
        }


        if ($this->errArray == []) {
            return true;
        } else {
            return false;
        }

       
    }

    function fileUpload($section,$field,$location)
    {
        $name =$_FILES[$section]['name'][$field];
        $extension = substr($name, strpos($name, '.') + 1);
        $temp = $_FILES[$section]['tmp_name'][$field];
        if (isset($name)) {
            if (!empty($name)) {
                if ($extension == 'jpg' || $extension == "jpeg" ) {
                    $location .= '/';
                    if (move_uploaded_file($temp, $location . $name)) {
                    } else {
                      
                    }
                } else {
                    $this->errArray['image'] =  "please upload only jpeg file";
                }
            } else {
                $this->errArray['image'] = "please choose a file";
            }
        }

        

        if ($this->errArray == []) {
            return true;
        } else {
            return false;
        }
    }

    function getErrors()
    {
        return $this->errArray;
    }

    public function getEventData($vendorId)
    {
        $conn = self::getDB();
        $query = "SELECT vi.*,c.name FROM `vendorinfo` vi INNER JOIN category c ON vi.categoryId = c.id WHERE vi.vendorId = $vendorId";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }


}