<?php
class Chofer extends ModeloGenerico{
    protected $idchofer;
    protected $nombres;
    protected $codigo;
    protected $precio;

    function __construct($propiedades = null){
        parent::__construct("chofer", Chofer::class, $propiedades);
    }
    public function getIdChofer()   { return $this->idchofer;   }
    public function getNombre()     { return $this->nombres;    }
    public function getCodigo()     { return $this->codigo;     }
    public function getPrecio()     { return $this->precio;     }
    public function setIdChofer($value) { $this->idchofer = $value; }
    public function setNombre($value)   { $this->nombres = $value;  }
    public function setCodigo($value)   { $this->codigo = $value;   }
    public function setPrecio($value)   { $this->precio = $value;   }
}