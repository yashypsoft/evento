<?php

namespace App\Controllers\User;

use Core\View;

class AboutUs extends \Core\Controller
{
    
    public function viewAction()
    {
        view::renderTemplate('user/contactus/view.html');
    }
}
