<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\User as UserModel;
use Core\View;

class User extends \Core\Controller
{
    function indexAction()
    {
        $userObj = new UserModel();

        $userData = $userObj->getAll('user');

        view::renderTemplate('admin/user/index.html', ['userData' => $userData]);
    }

    function addAction()
    {
        $userObj = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['user'];
            if (
                $userObj->validate($data)
            ) {
                $userObj->insertData('user', $data);
                header("Location:../user/index");
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'admin/user/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            View::renderTemplate('admin/user/add.html');
        }
    }

    function editAction()
    {
        $userObj = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $_POST['user'];
            if ($userObj->validate($data)) {
                $userObj->updateQuery(
                    'user',
                    $data,
                    ['id' => $data['id']]
                );
                header("Location:../index");
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'admin/user/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $userObj->fetchRow('user', ['id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                View::renderTemplate(
                    'admin/user/add.html',
                    ['editData' => $editData]
                );
            }
        }
    }

    function deleteAction()
    {
        $userObj = new UserModel();
        $id = ($this->route_params['id']);
        $userObj->deleteData('user', ['id' => $id]);
        header("Location: ../index");
    }

    function multipleDeleteAction()
    {
        $userObj = new UserModel();
        if ($_POST['deleteId'] != '') {
            print_r($deleteItemArray = explode(',', $_POST['deleteId']));
            foreach ($deleteItemArray as $key => $value) {
                $userObj->deleteData('user', ['id' => $value]);
            }
        }
    }

   

    function before()
    {
        // if (isset($_SESSION['admin'])) {
        //     return true;
        // } else {
        //     header("Location:../../users/login");
        // }
    }
}
