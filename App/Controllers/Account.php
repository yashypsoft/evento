<?php

namespace App\Controllers;

use App\Models\User;
use Core\View;

class Account extends  \Core\Controller
{
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $data = $_POST['users'];
            if ($userObj->validate($data)) {
                $checkEmail =   $userObj->checkData('admin','email',$data['email']);
                $checkPassword = $userObj->checkData('admin','password',$data['password']);
                $userData = $userObj->fetchRow('admin',['email'=>$data['email'],
                                'password'=>$data['password']]);
                $_SESSION['admin'] = $userData; 

                if($checkEmail && $checkPassword){ 
                 
                    View::renderTemplate(
                        '/account/login.html',
                        ['user' => $userData]
                    );
                    header("Location: ../admin/categories/index");  
                
                }else{
                    View::renderTemplate(
                        '/account/login.html',
                        ['loginErr' => "Enter valid email And password"  ]
                    );
                }

            }
            else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    '/account/login.html',
                    ['errData' => $error]
                );
            }
        }
        else{
            View::renderTemplate('account/login.html');
        }
    }

    function logout(){
        unset($_SESSION['admin']);
        header("Location: ../"); 
    } 

    public function registerAction()
    {
        View::renderTemplate('account/register.html');
    }
   
}
