<?php
/**
 * Base controller
 * Load model, view
 */

class Controller
{
    public function model($model)
    {
        require_once "../app/models/$model.php";

        return new $model();
    }

    public function view($view, $data = [])
    {
        $view = str_replace('.', '/', $view);

        if(file_exists("../app/views/$view.php")) {
            extract($data);
            require_once "../app/views/$view.php";
        } else {
            die('View not exist');
        }
    }

    public function library($library)
    {
        if(file_exists('../app/libraries/' . ucwords($library) . '.php')) {
            return new $library();
        } else {
            die('Library not exist');
        }
    }
}