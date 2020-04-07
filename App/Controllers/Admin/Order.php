<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Order as AdminOrder;
use Core\View;

class Order extends \Core\Controller
{   
    public function addAction()
    {
        # code...
    }

    function indexAction()
    {
        $orderObj  = new AdminOrder();
        $orderData = $orderObj->getOrderHistroy();
        view::renderTemplate('admin/order/index.html', ['orderData'=>$orderData]);
    }
}