<?php
namespace App\Controllers;
use App\Models\User;
use Core\View;
class Vendor extends  \Core\Controller
{
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $data = $_POST['vendor'];
            if ($userObj->validate($data)) {
                $checkEmail =   $userObj->checkData('vendor', 'emailId', $data['emailId']);
                $checkPassword = $userObj->checkData('vendor', 'password', $data['password']);
                $userData = $userObj->fetchRow('vendor', [
                    'emailId' => $data['emailId'],
                    'password' => $data['password']
                ]);
                $_SESSION['vendor'] = $userData;

                if ($checkEmail && $checkPassword) {
                    View::renderTemplate(
                        '/vendor/login.html',
                        ['user' => $userData]
                    );
                    // header("Location:../vendor/register");
                } else {
                    View::renderTemplate(
                        '/vendor/login.html',
                        ['loginErr' => "Enter valid email And password"]
                    );
                }
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    '/vendor/login.html',
                    ['errData' => $error]
                );
            }
        } else {
            View::renderTemplate('vendor/login.html');
        }
    }

    function logout()
    {
        unset($_SESSION['user']);
        header("Location: ../");
    }

    public function registerAction()
    {
        $userObj = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['user'];
            if ($userObj->validate($data)) {
                $userObj->insertData('vendor', $data);
                header("Location:../vendor/login");
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'vendor/register.html',
                    ['errData' => $error]
                );
            }
        } else {
            View::renderTemplate('vendor/register.html');
        }
    }
}
