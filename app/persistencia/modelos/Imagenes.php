<?php
class Imagenes extends ModeloGenerico{
    protected $idimg;
    protected $nombreimg;
    protected $url;

    function __construct($propiedades = null){
        parent::__construct("imagenes",Imagenes::class,$propiedades);
    }
    public function getIdImg()      { return $this->idimg; }
    public function getNombreImg()  { return $this->nombreimg; }
    public function getUrl()        { return $this->url; }
    public function setIdImg($values)    { return $this->idimg = $values; }
    public function setNombreImg($values){ return $this->nombreimg = $values; }
    public function setUrl($values)      { return $this->url = $values; }
}