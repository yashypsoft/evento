<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\Category as CategoryModel;
use Core\View;

class Category extends \Core\Controller
{
    function indexAction()
    {
        $categoryObj = new CategoryModel();

        $categoryData = $categoryObj->getAll('category');

        view::renderTemplate('admin/category/index.html', ['categoryData' => $categoryData]);
    }

    function addAction()
    {
        $categoryObj = new CategoryModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['category'];
            $checkFileValidation  =
                $categoryObj->fileUpload('category', 'image', Config::CATEGORIESPATH);
            if (
                $categoryObj->validate($data) && $checkFileValidation
            ) {

                $categoryObj->insertData('category', $data);
                header("Location:../category/index");
            } else {
                $error = $categoryObj->getErrors();
                $parentCategory =
                    $categoryObj->getFieldData('category', 'name,id', ['parentId' => '0']);
                View::renderTemplate(
                    'admin/category/add.html',
                    ['errData' => $error, 'parentCategory' => $parentCategory]
                );
            }
        } else {
            $parentCategory =
                $categoryObj->getFieldData('category', 'name,id', ['parentId' => '0']);
            View::renderTemplate('admin/category/add.html', ['parentCategory' => $parentCategory]);
        }
    }

    function editAction()
    {
        $categoryObj = new CategoryModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $_POST['category'];
            $checkFileValidation  =
                $categoryObj->fileUpload('category', 'image', Config::CATEGORIESPATH);
            if ($categoryObj->validate($data) && $checkFileValidation) {
                $categoryObj->updateQuery(
                    'category',
                    $data,
                    ['id' => $data['id']]
                );
                header("Location:../index");
            } else {
                $error = $categoryObj->getErrors();
                View::renderTemplate(
                    'admin/category/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $categoryObj->fetchRow('category', ['id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                $parentCategory =
                    $categoryObj->getFieldData('category', 'name,id', ['parentId' => '0']);
                View::renderTemplate(
                    'admin/category/add.html',
                    ['editData' => $editData, 'parentCategory' => $parentCategory]
                );
            }
        }
    }

    function deleteAction()
    {
        $categoryObj = new CategoryModel();
        $id = ($this->route_params['id']);
        $categoryObj->deleteData('category', ['id' => $id]);
        $categoryObj->deleteData('category', ['parentId' => $id]);
        header("Location: ../index");
    }

    function multipleDeleteAction()
    {
        $categoryObj = new CategoryModel();
        if ($_POST['deleteId'] != '') {
            print_r($deleteItemArray = explode(',', $_POST['deleteId']));
            foreach ($deleteItemArray as $key => $value) {
                $categoryObj->deleteData('category', ['id' => $value]);
                $categoryObj->deleteData('category', ['parentId' => $value]);
            }
        }
    }

    function showAction()
    {
        $routeKey = $this->route_params['urlkey'];

        $categoryObj = new CategoryModel();
        $displayData = $categoryObj->getFieldData('category', '*', ['url_key' => $routeKey, 'status' => 'ON']);

        view::renderTemplate('admin/category/show.html', ['displayData' => $displayData[0]]);
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
