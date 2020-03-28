<?php

namespace App\Controllers;

use App\Models\Users\Product as UserProduct;

class AddToCart extends \Core\Controller
{
    function indexAction()
    {
        
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $cart_id = session_id();

        

        $userProductObj = new UserProduct();

        $productData = $userProductObj->getFieldData(
            'products',
            'id as product_id,product_name,price',
            ['id' => $productId]
        );

        $isAvalaible = false;

        $productData[0]['quantity'] = $quantity;
        $productData[0]['total'] = $quantity * $productData[0]['price'];


        if (isset($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $key => $array) {
                if ($productId == $array['id']) {
                    $_SESSION['cart'][$key]['quantity'] = $productData[0]['quantity'];
                    $_SESSION['cart'][$key]['total'] = $productData[0]['total'];
                    $isAvalaible = true;
                    break;
                }
            }
        }

        if ($isAvalaible == false) {
            $_SESSION['cart'][] =  $productData[0];
        }
    }

    function displayCartDetails()
    {
        $result  = json_encode($_SESSION['cart']);

        echo $result;
    }

    function deleteCartItemAction()
    {
        $productId = $_POST['productId'];
        foreach ($_SESSION['cart'] as $key => $array) {
            if ($productId == $array['id']) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }


}
