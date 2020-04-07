<?php
namespace Core;

class View
{
    //render a file
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            // echo "$file not found";
            throw new \Exception("$file not found");
        }
    }

    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;
        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
            
            if(isset($_SESSION['admin'])){
                $adminData = $_SESSION['admin'];
                $twig->addGlobal('admin',$adminData);
            }
            if(isset($_SESSION['vendor'])){
                $vendorData = $_SESSION['vendor'];
                $twig->addGlobal('vendor',$vendorData);
            }
            if(isset($_SESSION['user'])){
                $userData = $_SESSION['user'];
                $twig->addGlobal('user',$userData);
            }
        }
        echo $twig->render($template, $args);
    }
}
