<?php
class Respuesta{
    public $codigo;
    public $mensaje;
    public $codificar;
    public $datos;

    function __construct($codigo=null, $mensaje=null, $codificar=null, $datos=null){
        if(isset($codigo) && empty($mensaje)){
            $respuesta = EMensajes::getMensaje($codigo);
            $this->codigo = $respuesta->codigo;
            $this->mensaje = $respuesta->mensaje;
            $this->codificar = $respuesta->codificar;
            $this->datos = $respuesta->datos;
            return;
        }
        if(is_string($codigo)){
            $temp = EMensajes::getMensaje($codigo);
            $codigo = $temp->codigo;
            $codificar = $temp->codificar;
        }
        $this->codigo = $codigo;
        $this->mensaje = $mensaje;
        $this->codificar = $codificar;
        $this->datos = $datos;
    }
    public function json($obj = null){
        header('Content-Type: application/json');
        if(is_array($obj) || is_object($obj)) return json_encode($obj);
        return json_encode($this);
    }
    function getCodigo(){   return $this->codigo;}
    function getMensaje(){  return $this->mensaje;}
    function getCodificar(){  return $this->mensaje;}
    function getDatos(){    return $this->datos;}
    function setCodigo($values){   $this->codigo = $values;}
    function setMensaje($values){  $this->mensaje = $values;}
    function setDatos($values){    $this->datos = $values;}
}