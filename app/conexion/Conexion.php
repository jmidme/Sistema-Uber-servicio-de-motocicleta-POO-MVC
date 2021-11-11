<?php
class Conexion{
    private $conexion;
    private $configuracion = [
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'ubermvc',
        'port'      => '3306',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8mb4'
    ];
    function __construct(){
        
    }
    public function conectar(){
        try {
            $CONTROLADOR    = $this->configuracion['driver'];
            $SERVIDOR       = $this->configuracion['host'];
            $BASE_DATOS     = $this->configuracion['database'];
            $PUERTO         = $this->configuracion['port'];
            $USUARIO        = $this->configuracion['username'];
            $CLAVE          = $this->configuracion['password'];
            $CODIFICACION   = $this->configuracion['charset'];

            $URL = "{$CONTROLADOR}:host={$SERVIDOR}:{$PUERTO};"."dbname={$BASE_DATOS};charset={$CODIFICACION}";
            $this->conexion = new PDO($URL,$USUARIO,$CLAVE);
            return $this->conexion;
        } catch (Exception $e) {
            print $e->getTraceAsString();
        }
    }



}