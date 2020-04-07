<?php

namespace App\Controllers\User;

use App\Models\Users\Booking;
use Core\View;

class Order extends \Core\Controller
{

    public function historyAction()
    {
        $booking = new Booking();
        $orderData = $booking->getOrderHistroy($_SESSION['user']['id']);
        View::renderTemplate('user/order/history.html', ['orderData' => $orderData]);
    }

    public function cancelAction()
    {
        $booking = new Booking();
        $id = ($this->route_params['id']);
        $booking->deleteData('booking', ['id' => $id]);
        View::renderTemplate('user/order/cancel.html');
    }
}
