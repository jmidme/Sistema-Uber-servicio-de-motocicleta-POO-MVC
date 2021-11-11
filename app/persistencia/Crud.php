<?php
class Crud{
    protected $tabla;
    protected $conexion;
    protected $wheres = '';
    protected $sql = null;
    protected $join = '';
    protected $groupby = '';

    public function __construct($tabla = null){
        $this->conexion = (new Conexion())->conectar();
        $this->tabla = $tabla;
    }
    public function get(){
        try {
            $this->sql = "SELECT * FROM {$this->tabla} {$this->join} {$this->wheres} {$this->groupby}";
            $sth = $this->conexion->prepare($this->sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getTraceAsString();
        }
    }
    public function first(){
        $lista = $this->get();
        if(count($lista) > 0){
            return $lista[0];
        }else{
            return null;
        }
    }
    public function insert($obj){
        try {
            $campos = implode("`, `", array_keys($obj));
            $valores = ":".implode(", :", array_keys($obj));
            $this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})";
            $this->ejecutar($obj);
            $id = $this->conexion->lastInsertId();
            return $id;
        } catch (Exception $e) {
            print $e->getTraceAsString();
        }
    }
    public function ejecutar($obj = null){
        $sth = $this->conexion->prepare($this->sql);
        if($obj !== null){
            foreach($obj as $llave => $valor){
                if(empty($valor)){
                    $valor = null;
                }
                $sth->bindValue(":$llave", $valor);
            }
        }
        $sth->execute();
        $this->reiniciarValores();
        return $sth->rowCount();
    }
    public function update($obj){
        try {
            $campos = "";
            foreach($obj as $llave=>$valor){
                $campos .= "`$llave`=:$llave,"; 
            }
            $campos = rtrim($campos, ",");
            $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";
            $filasAfectadas = $this->ejecutar($obj);
            return $filasAfectadas;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function delete(){
        try {
            $this->sql = "DELETE FROM {$this->tabla} {$this->wheres}";
            $filasAfectadas = $this->ejecutar();
            return $filasAfectadas;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function join($table){
        $this->join .= " INNER JOIN `$table`";
        return $this;
    }
    public function groupBy($campo){
        $this->groupby .= (strpos($this->groupby, "GROUP BY")) ? ", " : "GROUP BY ";
        $this->groupby .= "$campo";
        return $this;
    }
    public function whereUnir($array){
        foreach($array as $key => $valor){
            $this->wheres .= (strpos($this->wheres,"WHERE")) ? " AND " : " WHERE " ;
            $this->wheres .= ((strpos($key,'.')) ? $key : "`$key`") ." = " . ((is_string($valor)) ? ((strpos($valor,'.')) ? $valor : "\"$valor\"") : $valor) . " " ;
        }
        return $this;
    }
    public function where($llave=null, $condicion=null, $valor=null){
        if(is_array($llave)) $this->whereUnir($llave);
        else if(is_string($llave)){
            $this->wheres .= (strpos($this->wheres,"WHERE")) ? " AND " : " WHERE " ;
            $this->wheres .= ((strpos($llave,'.')) ? $llave : "`$llave`") ." $condicion " . ((is_string($valor)) ? ((strpos($valor,'.')) ? $valor : "\"$valor\"") : $valor) . " " ;
        }
        return $this;
    }
    public function orWhere($llave, $condicion, $valor){
        $this->wheres .= (strpos($this->wheres,"WHERE")) ? " OR " : " WHERE " ;
        $this->wheres .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " " ;
        return $this;
    }
    private function reiniciarValores(){
        $this->wheres = '';
        $this->sql = null;
    }
}