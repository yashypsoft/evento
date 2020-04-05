<?php

namespace App\Controllers\User;

use App\Models\Users\Booking;
use App\Models\Users\Vendor as UsersVendor;
use Core\View;

class Vendor extends \Core\Controller
{
    public function viewAction()
    {
        $id = ($this->route_params['id']);
        $vendorObj = new UsersVendor();
        $vendorData = $vendorObj->getVendorDetail($id);
        View::renderTemplate('user/vendor/view.html', ['vendor'=>$vendorData]);
    }

    public function bookAction()
    {
        $bookObj = new Booking();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if(!isset(($_SESSION['user']['id']))){
                    header("Location: ../../login");
                }

            $data = $_POST['book'];
            $data['vendorId'] = ($this->route_params['id']);
            $data['userId'] = $_SESSION['user']['id'];
            $bookObj->insertData('booking', $data);
            View::renderTemplate('user/vendor/book.html');
        }
    }
}