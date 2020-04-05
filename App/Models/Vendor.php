<?php

namespace App\Models;

class Vendor extends \Core\Model
{
    public $errArray = [];

    public function validate($fieldData)
    {

        foreach ($fieldData as $key => $value) {
            switch ($key) {
                case  'urlKey':
                    if (!empty($value) && !ctype_alpha($value)) {
                        $this->errArray[$key] = 'URLKey is must be character';
                    }
                    break;
                case 'name':
                case 'description':
                    if (empty($value)) {
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




    function getErrors()
    {
        return $this->errArray;
    }
}
