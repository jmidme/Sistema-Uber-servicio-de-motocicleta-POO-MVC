<?php
class Signup extends ModeloGenerico{
    protected $id;
    protected $name;
    protected $password;
    protected $role;

    function __construct($propiedades=null){
        parent::__construct("usuario", Signup::class, $propiedades);
    }
    public function getId(){ return $this->id; }
    public function getName(){ return $this->name; }
    public function getPassword(){ return $this->password; }
    public function setId($value){ $this->id = $value; }
    public function setName($value){ $this->name = $value; }
    public function setPassword($value){ $this->password = $value; }
}