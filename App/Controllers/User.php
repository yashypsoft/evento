<?php
namespace App\Controllers;
use App\Models\User as UserModel;
use Core\View;
class User extends  \Core\Controller
{
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new UserModel();
            $data = $_POST['user'];
            if ($userObj->validate($data)) {
                $checkEmail =   $userObj->checkData('user', 'email', $data['email']);
                $checkPassword = $userObj->checkData('user', 'password', $data['password']);
                $userData = $userObj->fetchRow('user', [
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
                $_SESSION['user'] = $userData;

                if ($checkEmail && $checkPassword) {
                   
                    header("Location:../user/explore/index");
                } else {
                    View::renderTemplate(
                        '/user/login.html',
                        ['loginErr' => "Enter valid email And password"]
                    );
                }
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    '/user/login.html',
                    ['errData' => $error]
                );
            }
        } else {
            View::renderTemplate('user/login.html');
        }
    }

    function logout()
    {
        unset($_SESSION['user']);
        header("Location: ../");
    }

    public function registerAction()
    {
        $userObj = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['user'];
            $data['type'] = "user";
            if ($userObj->validate($data)) {
                $userObj->insertData('user', $data);
                header("Location:../user/login");
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'user/register.html',
                    ['errData' => $error]
                );
            }
        } else {
            View::renderTemplate('user/register.html');
        }
    }

}
