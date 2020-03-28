<?php

namespace App\Controllers;


use App\Models\Users\Product as UserProduct;
use App\Models\Users\Category as UserCategory;
use \Core\View;


class Product extends \Core\Controller{

    //view single product
    function viewAction(){

        $routeKey = $this->route_params['urlkey'];

        $userProductObj = new UserProduct();
        $productData = $userProductObj->getFieldData('products','*',['url_key'=>$routeKey]);

        view::renderTemplate('user/product/view.html',['productData'=>$productData[0]]);
    }


    //search product 
    public function searchAction()
    {
        $productName =  $this->route_params['urlkey'];

        $productName = str_replace('-'," ",$productName);

        $userProductObj = new UserProduct();
        $productData = $userProductObj->searchProduct($productName);
    
 
        View::renderTemplate('user/category/view.html',
        ['productData' => $productData]);


    }
    

    

}