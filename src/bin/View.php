<?php
class View{
    public $variables;
    protected $output;

    function __construct(){}

    public function render($file, $variables=null, $json){
        $this->variables = $variables;
        $file = PATH_VIEWS . $file;
        ob_start();
        $this->includeFile($file,$json);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    private function includeFile($file,$json){
        if(isset($this->variables) && is_array($this->variables)){
            foreach($this->variables as $key => $value){
                global ${$key};
                ${$key} = ($json) ? json_encode($value) : $value;
            }
        }
        if(file_exists($file)) return include $file;
        else if(file_exists($file.'.php')){
            require 'assets/plantilla/modulos/head.php';
            require 'assets/plantilla/modulos/nav.php';
            require 'assets/plantilla/modulos/menu.php';
            require $file.'.php';
            require 'assets/plantilla/modulos/pie.php';
            require 'assets/plantilla/modulos/body.php';
        }
        else if(file_exists($file.'.html')) return include $file.'.html';
        else if(file_exists($file.'.htm')) return include $file.'.html';
        else print "<h2>No existe el archivo: $file</h2>";
    }
    public function redirect($route, $mensajes=array()){
        $data = [];
        $params = '';
        if(isset($mensajes) && is_array($mensajes)){
            foreach($mensajes as $key => $mensaje){
                $route === '' ? $mensaje = $mensaje : $mensaje = '/'.$mensaje;
                array_push($data, $mensaje);
                global ${$key};
                ${$key} = $mensaje;
                $this->{$key} = $mensaje;
                $this->variables = $mensaje;
            }
            $params = implode($data);
        }
        header("Location: ".URL::to($route).$params);
    }


}