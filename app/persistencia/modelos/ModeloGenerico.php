<?php
class ModeloGenerico extends Crud{
    private $className;
    private $excluir = ["className", "tabla", "conexion", "wheres", "sql", "excluir","groupby","join"];

    function __construct($tabla, $className, $propiedades = null){
        parent::__construct($tabla);
        $this->className = $className;
        if(empty($propiedades)) return;
        foreach($propiedades as $llave => $valor) $this->{$llave} = $valor;
    }
    protected function obtenerAtributos($incluir = null){
        if(is_array($incluir))
            $this->excluir = array_merge($this->excluir, $incluir);
        $variables = get_class_vars($this->className);
        $atributos = [];
        $max = count($variables);
        foreach($variables as $llave => $valor){
            if(!in_array($llave, $this->excluir)) $atributos[] = $llave;
        }
        if(is_array($incluir)){
            foreach($incluir as $llave => $valor){
                if(in_array($this->excluir[$llave], $this->excluir)){
                    unset($this->excluir[$llave]);
                }
            }
        }
        return $atributos;
    }
    protected function parsear($obj = null, $incluir = null){
        try {
            $atributos = $this->obtenerAtributos($incluir);
            $objetoFinal = [];
            if($obj == null){
                foreach($atributos as $indice => $llave){
                    if(isset($this->{$llave})){
                        $objetoFinal[$llave] = $this->{$llave};
                    }
                }
                return $objetoFinal;
            }
            foreach($atributos as $indice => $llave){
                if(isset($obj[$llave])){
                    $objetoFinal[$llave] = $obj[$llave];
                }
            }
            return $objetoFinal;
        } catch (Exception $ex) {
            throw new Exception("Error en ".$this->className . ".parsear() => ".$ex->getMessage());
        }
    }
    public function fill($obj){
        try {
            $atributos = $this->obtenerAtributos();
            foreach($atributos as $indice => $llave){
                if(isset($obj[$llave])){
                    $this->{$llave} = $obj[$llave];
                }
            }
        } catch (Exception $ex) {
            throw new Exception ("Error en ".$this->className . ".fill() => ".$ex->getMessage());
        }
    }
    public function insert($obj, $incluir = null){
        $obj = $this->parsear($obj,$incluir);
        return parent::insert($obj);
    }
    public function update($obj, $incluir = null){
        $obj = $this->parsear($obj, $incluir);
        return parent::update($obj);
    }
    public function __get($nombreAtributo){
        return $this->{$nombreAtributo};
    }
    public function __set($nombreAtributo, $valor){
        $this->{$nombreAtributo} = $valor;
    }
}