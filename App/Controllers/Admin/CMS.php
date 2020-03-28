<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\Cmsmodel;
use Core\View;

class Cms extends \Core\Controller
{
    public function indexAction(){
        
        $cmsObj = new Cmsmodel();
        $cmsData = $cmsObj -> getAll('cms_pages');    
        View::renderTemplate('admin/cms/index.html',['cmsData' => $cmsData]);
    }

    public function addAction(){
        $cmsObj = new Cmsmodel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['cms'];

            if ($cmsObj->validate($data)) {
                $cmsObj->insertData('cms_pages',($data));
                header("Location:../cms/index"); 
            } else {
                $error = $cmsObj->getErrors(); 
    
                View::renderTemplate(
                    'admin/cms/add.html',
                    ['errData' => $error]
                );
            }    
        }
        else{

            View::renderTemplate('admin/cms/add.html');
        } 
    }

    public function editAction()
    {
        $cmsObj = new Cmsmodel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['cms'];
          
            if ($cmsObj->validate($data)) {
                $cmsObj->updateQuery('cms_pages',
                     $data, ['id' => $data['id']]);
                header("Location:../index");
            } else {
                $error = $cmsObj->getErrors();
                View::renderTemplate(
                    'admin/cms/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $cmsObj->fetchRow('cms_pages', ['id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                View::renderTemplate('admin/cms/add.html',
                     ['editData' => $editData]);
            }
        }
    }
    
    public function deleteAction()
    {
        $cmsObj = new Cmsmodel();
        $id = ($this->route_params['id']);
        $cmsObj->deleteData('cms_pages', ['id' => $id ]);
        header("Location: ../index");
    }

    function multipleDeleteAction()
    {
        $cmsObj = new Cmsmodel();
        if ($_POST['deleteId'] != '') {
            print_r($deleteItemArray = explode(',',$_POST['deleteId']));
            foreach($deleteItemArray as $key => $value){
                $cmsObj->deleteData('cms_pages', ['id' => $value]);  
            }
        }
    }

    function showAction(){
        $routeKey = $this->route_params['urlkey'];
        $cmsObj = new Cmsmodel();
        $displayData = $cmsObj->getFieldData('cms_pages','*',['url_key'=>$routeKey,'status'=>'ON']);
        view::renderTemplate('admin/cms/show.html',['displayData'=>$displayData[0]]);
    }

    function before()
    {
        // if(isset($_SESSION['admin'])){
        //     return true;
        // }
        // else{
        //     header("Location:../../users/login");
        // }
    }
}
