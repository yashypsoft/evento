<?php

namespace App\Controllers\User;

use App\Models\Users\Category;
use App\Models\Users\Payment as UsersPayment;
use Core\View;

class Payment extends \Core\Controller
{

    public function testAction()
    {
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");

        $payment = new UsersPayment();
        $rand = $payment->getOrderDetails($_SESSION['user']['id'])[0];
        $userId = $_SESSION['user']['id'];
        view::renderTemplate('user/payment/test.html', ['order' => $rand,'userId' =>$userId]);
    }

    public function pgRedirectAction()
    {
        view::render('user/payment/pgredirect.php');
    }

    public function orderDoneAction()
    {
        View::renderTemplate('user/vendor/book.html');
    }

}


