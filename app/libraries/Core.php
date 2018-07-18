<?php

// creates url and loads core controller
// URL format : /controller/method/params

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'Index';
    protected $params = [];

    public function __construct()
    {
        //print_r($this->getURL());
        $url = $this->getUrl();

        //find corresponding controller if it exists set as current controller
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        
        // require controller and instantiate
        require_once '../app/controllers/'. $this->currentController . '.php';
        $this->currentController = new $this->currentController;


        
        //check second part of url


        if (isset($url[1])){
            //find corresponding method if it exists set as current method
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        
        //check parameters

        $this->params = $url ? array_values($url) : [];

        //callback with parameters

        call_user_func_array([
            $this->currentController,
            $this->currentMethod
        ], $this->params );
    }


    public function getURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
