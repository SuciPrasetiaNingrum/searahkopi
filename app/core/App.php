<?php 
class App {
    protected $controller = 'Home'; 
    protected $method = 'index'; 
    protected $params = []; 

    public function __construct() {
        $url = $this->parseURL();

        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = 'ErrorController';
                $this->method = 'show404';
            }
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

    
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
               
                $this->controller = 'ErrorController';
                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
                $this->method = 'show404';
            }
        }
        if (!empty($url)) {
            $this->params = array_values($url);
        }
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Parse URL
    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}




// class App{
//     protected $controller = 'Home'; //Controller Default
//     protected $method ='index'; //Method Default
//     protected $params = [];
//    public function __construct()
//    {
//     $url = $this->parseURL();
//     //cek controller
//     if (isset($url[0])){

// 		if (file_exists('../app/controllers/' . $url[0] . '.php')){
// 			$this->controller = $url[0];
// 			unset($url[0]);
			
// 		}
// 	}
//     require_once '../app/controllers/'.$this->controller . '.php';
//     $this->controller = new $this->controller;

//     //cek method
//     if(isset($url[1])){
//         if(method_exists($this->controller,$url[1])){
//             $this->method = $url[1];
//             unset($url[1]);
//         }
//     }

//     //Pramameter
//     if(!empty($url)){
//         $this->params = array_values($url);
//     }
//     call_user_func_array([$this->controller,$this->method],$this->params);

//    }
//    //Parse URL
//    public function parseURL(){
//     if(isset($_GET['url'])){
//         $url = rtrim($_GET['url'],'/');
//         $url = filter_var($url, FILTER_SANITIZE_URL);
//         $url = explode('/',$url);
//         return $url;
//     }
//    }
// }