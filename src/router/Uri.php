<?php
class Uri{
    public $uri;
    public $method;
    public $function;
    public $matches;
    protected $request;
    protected $response;

    public function __construct($uri, $method, $function){
        $this->uri = $uri;
        $this->method = $method;
        $this->function = $function;
    }
    public function match($url){
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->uri);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false; 
        }
        if($this->method != $_SERVER['REQUEST_METHOD'] && $this->method = 'ANY')
        return false;
        array_shift($matches);
        if(count($matches)>0){
            $er = strpos(end($matches),'=');
            $er1 = EMensajes::existeValor(end($matches)) ? 'verdadero' : 'falso';
            if(strpos(end($matches),'=') && !EMensajes::existeValor(end($matches))){
                return false;
            }
        }
        $this->matches = $matches;
        return true;
    }
    public function call(){
        try {
            $this->request = array_merge($_REQUEST, $_FILES);
            if(is_string($this->function)) $this->functionFromController();
            else $this->execFunction();
            $this->printResponse();
        } catch (Exception $e) {
            throw new Exception("Hubo un error . $e", -1);
        }
    }
    private function functionFromController(){
        $parts = $this->getParts();
        $class = $parts['class'];
        $method = $parts['method'];
        if(!$this->importController($class)) return;
        $this->parseRequest();
        $classInstance = new $class();
        $classInstance->setRequest($this->request);
        $launch = array($classInstance, $method);
        if(is_callable($launch))
            $this->response = call_user_func_array($launch, $this->matches);
        else
            throw new Exception("El metodo $class.$method no existe", -1);
    }
    private function getParts(){
        $parts = array();
        if(strpos($this->function, '@')){
            $methodParts = explode('@', $this->function);
            $parts['class'] = $methodParts[0];
            $parts['method'] = $methodParts[1];
        }else{
            $parts['class'] = $this->function;
            $parts['method'] = ($this->uri == '/') ? 'index' : $this->formatCamelCase($this->uri);
        }
        return $parts;
    }
    private function formatCamelCase($string){
        $parts = preg_split("[-|_]", strtolower($string));
        $finalString = '';
        $i = 0;
        foreach($parts as $part){
            $finalString .= ($i==0) ? strtolower($part) : ucfirst($part);
            $i++;
        }
        return $finalString;
    }
    public function importController($class){
        $file = PATH_CONTROLLERS . $class . '.php';
        if(!file_exists($file)){
            throw new Exception("El controlador {$file} no existe.");
            return false;
        }
        require_once $file;
        return true;
    }
    private function parseRequest(){
        $this->request = new Request($this->request);
        $this->matches[] = $this->request;
    }
    private function execFunction(){
        $this->parseRequest();
        $this->response = call_user_func_array($this->function, $this->matches);
    }
    private function printResponse(){
        if(is_string($this->response)) print $this->response;
        else if(is_object($this->response) || is_array($this->response)){
            $res = new Respuesta();
            print $res->json($this->response);
        }
    }
}