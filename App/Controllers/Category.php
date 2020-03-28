<?php

namespace App\Controllers;

use App\Models\Users\Category as UserCategory;

use \Core\View;

class Category extends \Core\Controller{

 
    public function indexAction()
    {      
      //for navbbar catgories
      $categoryObj = new UserCategory();
      $categoryData = $categoryObj -> getFieldData('categories','*');  
        
      echo json_encode($categoryData);
    }

    function viewAction(){
      
      $routeKey = $this->route_params['urlkey'];
      $userCategoryObj = new UserCategory();
      $productData =$userCategoryObj->getCategoryProduct($routeKey);

      View::renderTemplate('user/category/view.html',
                ['productData' => $productData]);

    }

}
