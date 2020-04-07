<?php

namespace App\Controllers\User;

use Core\View;

class Contactus extends \Core\Controller
{
    public function sendAction()
    {

        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
            $to = $_POST['email'];
            $body = $_POST['message'];
            $header = $_POST['name'];
            $subject  = $_POST['subject'];

            if (mail($to, $subject, $body, $header)) {
                header("Location:../contactus/view");
                echo "<script>alert('message send to $to successfully')</script>";
            } else {
                echo "Mail sending failed.";
            }
        } else {
            echo "enter in field";
        }
    }

    public function viewAction()
    {
        view::renderTemplate('user/contactus/view.html');
    }
}
