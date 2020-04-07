<?php

namespace App\Models\Admin;

use PDO;

class Dashboard extends \Core\Model{

    public $errArray = [];
    
    function prepareCategoryData($postData)  
    {
        $categoryData = [];
        foreach($postData as $key => $value){
            switch($key){
                case 'name':
                    $categoryData['category_name'] = $value;
                break;
                case 'urlKey':
                    if(empty($value)){
                        $categoryData['url_key'] = strtolower($postData['title']);
                    }else{
                        $categoryData['url_key'] = strtolower($value);
                    }
                break;
                case 'status':
                    
                    $categoryData['status'] = $value;
                break;
                case 'description':
                    $categoryData['description'] = $value;
                break;
                case 'parentCategory':
                    $categoryData['parent_category'] = $value;
                break;   
            }
        }
        $categoryData['image'] = $_FILES['categories']['name']['image'];
        print_r($categoryData);
        return $categoryData;
    }

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

    public function getTotal($tableName)
    {
        $conn = self::getDB();
        $query = "SELECT count(*) 'count' FROM `$tableName`";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['count'];
    }
    

   
    function getErrors()
    {  
        return $this->errArray;
    }

}

