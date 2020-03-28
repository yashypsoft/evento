<?php

namespace App\Models\Admin;

use PDO;

class Cmsmodel extends \Core\Model{

    public $errArray = [];
    
    function prepareCmsData($postData)  
    {
        $categoryData = [];
        foreach($postData as $key => $value){
            switch($key){
                case 'pageTitle':
                    $categoryData['page_title'] = $value;
                break;
                case 'urlKey':
                    if(empty($value)){
                        $categoryData['url_key'] = strtolower($postData['pageTitle']);
                    }else{
                        $categoryData['url_key'] = strtolower($value);
                    }
                break;
                case 'status':   
                    $categoryData['status'] = $value;
                break;
                case 'content':
                    $categoryData['content'] = $value;
                break;  
            }
        }
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
                case 'pageTitle':
                case 'content':
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

    function checkUrl(){
        if(($this->checkData('cms_pages','url_key',$_POST['cms']['urlKey']))){
            $this->errArray['urlKey'] = 'URLKey is must be different';
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

