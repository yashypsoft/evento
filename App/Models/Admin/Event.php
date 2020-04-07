<?php

namespace App\Models\Admin;

use PDO;

class Event extends \Core\Model{

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

    public function getEventData($vendorId)
    {
        $conn = self::getDB();
        $query = "SELECT vi.*,c.name FROM `vendorinfo` vi INNER JOIN category c ON vi.categoryId = c.id WHERE vi.vendorId = $vendorId";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }

    function checkUrl(){
        if(($this->checkData('categories','url_key',$_POST['categories']['urlKey']))){
            $this->errArray['urlKey'] = 'URLKey is must be different';
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

}

