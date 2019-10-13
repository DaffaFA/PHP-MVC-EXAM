<?php

class App {

    public $url;
    private $controller = 'Home';
    private $method = 'index';

    public function __construct()
    {
        $this->parseUrl();
        $this->wController();
        var_dump($this->url);
    }

    public function parseUrl()
    {
        if ( isset($_GET['url']) ) {
            $this->url = rtrim($_GET['url'], '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', $this->url);
        }
    }

    public function wController()
    {
        if ( isset($this->url[0]) ) {
            if ( file_exists("../App/Http/Controller/{$this->url[0]}.php") ) {
                require_once "../App/Http/Controller/{$this->url[0]}.php";
                $this->controller = new $this->url[0];
            }
        }

        if ( isset($this->url[1]) ) {
            if ( method_exists($this->controller, $this->url[1]) ) {
                $this->controller->{$this->url[1]}();
            }
        }
    }
    
}