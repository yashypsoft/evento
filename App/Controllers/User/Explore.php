<?php

namespace App\Controllers\User;

use App\Models\Users\Category;
use Core\View;

class Explore extends \Core\Controller
{
    public function indexAction()
    {
        $categoryObj = new Category();
        $categoryData = $categoryObj->getAll('category');
        View::renderTemplate('user/explore/index.html', ['categoryData'=>$categoryData]);
    }

    public function viewAction()
    {
        // echo "hello";
        $id = ($this->route_params['id']);
        $_SESSION['vid'] = $id;
        $categoryObj = new Category();
        $vendorData = $categoryObj->getVendorDetails($id);
        $count  = $categoryObj->getCount($id);
        $cat   = $categoryObj->getFieldData('category','name',['id'=>$id])[0];
        
        View::renderTemplate('user/explore/view.html', ['vendorData'=>$vendorData,'count'=>$count,'cat'=>$cat]);
    }

}
