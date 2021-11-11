<?php
class Motocicleta extends ModeloGenerico{
    protected $idm;
    protected $schedule;
    protected $availability;
    protected $quantity;

    function __construct($propiedades = null){
        parent::__construct('motocicleta', Motocicleta::class, $propiedades);
    }

    public function getIdm(){ return $this->idm; }
    public function getSchedule(){ return $this->schedule; }
    public function getAvailability(){ return $this->availability; }
    public function getQuantity(){ return $this->quantity; }
    public function setIdm($value){ return $this->idm = $value; }
    public function setSchedule($value){ return $this->schedule = $value; }
    public function setAvailability($value){ return $this->availability = $value; }
    public function setQuantity($value){ return $this->quantity = $value; }
}