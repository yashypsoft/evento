<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\Vendor as VendorModel;
use Core\View;

class Vendor extends \Core\Controller
{
    function indexAction()
    {
        $vendorObj = new VendorModel();

        $vendorData = $vendorObj->getAll('vendor');

        view::renderTemplate('admin/vendor/index.html', ['vendorData' => $vendorData]);
    }

    function addAction()
    {
        $vendorObj = new VendorModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['vendor'];
           
            if (
                $vendorObj->validate($data)
            ) {
                $vendorObj->insertData('vendor', $data);
                header("Location:../vendor/index");
            } else {
                $error = $vendorObj->getErrors();
                $parentvendor =
                    $vendorObj->getFieldData('category', 'name,id', ['parentId' => '0']);
                View::renderTemplate(
                    'admin/vendor/add.html',
                    ['errData' => $error, 'parentvendor' => $parentvendor]
                );
            }
        } else {
            $parentCategory =
                $vendorObj->getFieldData('category', 'name,id', ['parentId' => '0']);
            View::renderTemplate('admin/vendor/add.html', ['parentCategory' => $parentCategory]);
        }
    }

    function editAction()
    {
        $vendorObj = new VendorModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $_POST['vendor'];
        
            if ($vendorObj->validate($data)) {
                $vendorObj->updateQuery(
                    'vendor',
                    $data,
                    ['id' => $data['id']]
                );
                header("Location:../index");
            } else {
                $error = $vendorObj->getErrors();
                View::renderTemplate(
                    'admin/vendor/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $vendorObj->fetchRow('vendor', ['id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                $parentCategory =
                    $vendorObj->getFieldData('category', 'name,id', ['parentId' => '0']);
                View::renderTemplate(
                    'admin/vendor/add.html',
                    ['editData' => $editData, 'parentCategory' => $parentCategory]
                );
            }
        }
    }

    function deleteAction()
    {
        $vendorObj = new VendorModel();
        $id = ($this->route_params['id']);
        $vendorObj->deleteData('vendor', ['id' => $id]);
        // $vendorObj->deleteData('vendor', ['parentId' => $id]);
        header("Location: ../index");
    }

    function multipleDeleteAction()
    {
        $vendorObj = new VendorModel();

        if ($_POST['deleteId'] != '') {
            print_r($deleteItemArray = explode(',', $_POST['deleteId']));
    
            foreach ($deleteItemArray as $key => $value) {
                $vendorObj->deleteData('vendor', ['id' => $value]);
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
