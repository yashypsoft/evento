<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Dashboard as AdminDashboard;
use Core\View;

class Dashboard extends \Core\Controller {

    function indexAction()
    {
        $dash = new AdminDashboard();
        $totUser = $dash->getTotal('user');
        $totOrder = $dash->getTotal('booking');
        $totVendor = $dash->getTotal('vendor');
        $totCategory = $dash->getTotal('category');

        View::renderTemplate('admin/dashboard/index.html',['user'=>$totUser,'order'=>$totOrder,'vendor'=>$totVendor,'category'=>$totCategory]);

    }
    
    function before()
    {
        
    }
}