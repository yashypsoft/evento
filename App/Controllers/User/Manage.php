<?php

namespace App\Controllers\User;

use App\Models\Users\Category;
use App\Models\Users\Manage as UsersManage;
use Core\View;

class Manage extends \Core\Controller
{
    public function orderAction()
    {
        if(!isset(($_SESSION['user']['id']))){
            header("Location: ../../login");
        }
        $manageObj = new UsersManage();
        $orders = $manageObj->getOrderDetails($_SESSION['user']['id']);
        View::renderTemplate('user/manage/order.html',['orderData'=>$orders]);


    }

    public function indexAction()
    {
        $manage = new UsersManage();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id =  $_SESSION['user']['id'];
            $data = $_POST['user'];
            if ($manage->validate($data)) {
                $manage->updateQuery(
                    'user',
                    $data,
                    ['id' => $id]
                );
                header("Location:../view");
            } else {
                $error = $manage->getErrors();
                View::renderTemplate(
                    'user/event/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $userData = $manage->fetchRow('user', ['id' => $_SESSION['user']['id']]);
            View::renderTemplate('user/manage/index.html', ['editData' => $userData]);
        }
    }
    protected function before()
    {
        if (isset($_SESSION['user']['id'])) {
            return true;
        } else {
            header("Location:../login");
            return false;
        }
    }

}