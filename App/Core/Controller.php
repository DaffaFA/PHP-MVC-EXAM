<?php


class Controller {

    /**
     * 
     * @method returning view for client-side
     * @param string $view
     * @param array $data
     */
    public function view($view, $passData=null)
    {
        $data = $passData;
        require_once "../App/Views/{$view}.php";
    }

    /**
     * 
     * @method Call model to interact with database
     * @param string $model
     */
    public function model($model)
    {
        require_once "../Http/{$model}.php";
        return new $model;
    }

}