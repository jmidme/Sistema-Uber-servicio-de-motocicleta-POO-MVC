<?php
class UsuarioMotocicleta extends ModeloGenerico{
    protected $idum;
    protected $user_id;
    protected $motor_id;
    protected $status;
    protected $user_motor_id;

    function __construct($propiedades = null){
        parent::__construct('usuariomotocicleta', UsuarioMotocicleta::class, $propiedades);
    }
    public function getIdUm()      { return $this->idum;          }
    public function getUserId()     { return $this->user_id;        }
    public function getMotorId()    { return $this->motor_id;       }
    public function getStatus()     { return $this->status;         }
    public function getUserMotorId(){ return $this->user_motor_id;  }
    public function setIdUm($value){ return $this->idum = $value; }
    public function setUserId($value){ return $this->user_id = $value; }
    public function setMotorId($value){ return $this->motor_id = $value; }
    public function setStatus($value){ return $this->status = $value; }
    public function setUserMotorId($value){ return $this->user_motor_id = $value; }
}