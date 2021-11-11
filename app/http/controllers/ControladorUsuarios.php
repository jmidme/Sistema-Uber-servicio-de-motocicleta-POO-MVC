<?php
class ControladorUsuarios extends SessionController{
    function __construct(){
        parent::__construct();
    }
    
    public function index(){ return $this->view('login/index.php'); }
    public function signup(){ return $this->view('login/signup.php'); }
    public function listar(){ return $this->view('dashboard/index'); }
    public function dashboard(){ return $this->view('dashboard/index'); }

    public function insertarUsuario(Request $request){
        $data = [$request->name, $request->password];
        if($this->getTypeData($data)){
            if($this->emptyFields($data)){
                $this->mensajes(EMensajes::ERROR_CAMPOS_VACIOS,'signup');
            }else{
                $usuarioModel = new Signup();
                $usuario = $usuarioModel->where("name","=",$data[0])->first();
                if($usuario!=NULL)
                    return $this->mensajes(EMensajes::ERROR_USUARIO_REGISTRADO,'signup');
                $request->password = $this->getHashedPassword($data[1]);
                $id = $usuarioModel->insert($request->all());
                if($id>0){
                    $usuarioMotocicletaModel = new UsuarioMotocicleta();
                    for ($i=1; $i <= 10 ; $i++) { 
                        $objeto = ["user_id"=>$id,"motor_id"=>$i];
                        $insert = $usuarioMotocicletaModel->insert($objeto);
                    }
                    $user = $usuarioModel->where("id","=",$id)->first();
                    $respuesta = new Respuesta();
                    $respuesta->setDatos($user);
                    $this->initialize($respuesta->datos);
                }else
                    return $this->mensajes(EMensajes::ERROR_INSERCION,'signup');
            }
        }else
            return $this->mensajes(EMensajes::ERROR,'signup');
    }
    public function autenticarUsuario(Request $request){
        $data = [$request->name, $request->password];
        if($this->getTypeData($data)){
            if($this->emptyFields($data)){
                return $this->mensajes(EMensajes::ERROR_CAMPOS_VACIOS,'');
            }else{
                $usuarioModel = new Signup();
                $usuario = $usuarioModel->where('name',"=",$data[0])->first();
                if($usuario != NULL){
                    if(password_verify($data[1], $usuario['password'])){
                        $respuesta = new Respuesta();
                        $respuesta->setDatos($usuario);
                        $this->initialize($respuesta->datos);
                    }else
                        return $this->mensajes(EMensajes::ERROR_PASSWORD_INCORRECTO,'');
                }else
                    return $this->mensajes(EMensajes::ERROR_USUARIO_INCORRECTO,'');
            }
        }else
            return $this->mensajes(EMensajes::ERROR,'');
    }
}