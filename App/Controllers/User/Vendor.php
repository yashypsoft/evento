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
        $imageData = $vendorObj->getImages($_SESSION['vid']);
        
        $reviewData = $vendorObj->getReview($id);
        // print_r($reviewData);
        View::renderTemplate('user/vendor/view.html', ['vendor' => $vendorData, 'imageData' => $imageData,'reviewData'=>$reviewData]);
    }

    public function bookAction()
    {
        $bookObj = new Booking();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!isset(($_SESSION['user']['id']))) {
                header("Location: ../../login");
            }

            $data = $_POST['book'];
            $id =($this->route_params['id']);
            $data['VendorinfoId'] = $id;
            $_SESSION['VendorinfoId'] = ($this->route_params['id']);
            $data['userId'] = $_SESSION['user']['id'];
            $data['price'] = $bookObj->fetchRow('vendorinfo',['id'=>$id])['price'];
            $bookObj->insertData('booking', $data);
            View::renderTemplate('user/vendor/book.html');
        }
    }

    public function reviewAction()
    {
        $bookObj = new Booking();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['review'];
            $data['VendorinfoId'] = ($this->route_params['id']);
            $data['userId'] = $_SESSION['user']['id'];
            $bookObj->insertData('review', $data);
            header('Location:./view');
        }
    }

    protected function before()
    {
        if (isset($_SESSION['user']['id'])) {
            return true;
        } else {
            header("Location:../../login");
            return false;
        }
    }
}
