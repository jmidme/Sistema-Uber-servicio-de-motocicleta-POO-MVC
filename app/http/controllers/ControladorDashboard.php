<?php
class ControladorDashboard extends SessionController{
    function __construct(){
        parent::__construct();
    }

    public function dashboard(){
        $sessionuser = $this->getUserSessionData();
        return $this->view('dashboard/index', ['nombre'=>$sessionuser['name']]); 
    }

    public function finalizar(){
        $this->logout();
        $this->viewRedirect('');
    }
    public function obtenerDatos(){
        $sessionuser = $this->getUserSessionData();
        $usuarioModel = new UsuarioMotocicleta();
        $key = ["usuariomotocicleta.motor_id","usuariomotocicleta.user_id"];
        $value = ["motocicleta.idm",$sessionuser['id']];
        $array = array_combine($key, $value);
        $lista = $usuarioModel->join('motocicleta')->where($array)->groupBy('motor_id')->get();
        $v = count($lista);
        if($v){
            for ($i=0; $i <$v ; $i++) { 
                ($lista[$i]['status']==0 && $lista[$i]['quantity']==0)
                ?$disabled = 'disabled'
                :$disabled = '';
                $lista[$i]['disabled'] = $disabled;
            }
            return (new Respuesta())->json(["draw"=> 1, "recordsTotal"=> 10,
            "recordsFiltered"=> 10,'data'=>$lista]);
        } 
        else return NULL;
    }
    public function obtenerConductor(){
        $choferModel = new Chofer();
        $lista = $choferModel->get();
        $v = count($lista);
        if($v) return (new Respuesta())->json(['chofer'=>$lista]);
        else return NULL;
    }
    public function actualizar($id, Request $request){
        $array = explode('_', $id);
        if(count($array)==2 && intval($array[0])==1 && intval($array[1])){
            $status = 0;
            $user_motor_id = 0;
            $motocicleta = $array[1];
            $sessionuser = $this->getUserSessionData();
            $lista = $this->buscarUsuarioMotocicleta($sessionuser['id'], $motocicleta);
            if($lista!=NULL){
                if($lista['status']==1 && $lista['quantity']<3 && $lista['quantity']>=0){
                    $quantity = $lista['quantity']+1;
                    $availability = 1;
                    $excluir = ["idnum","motor_id","user_id"];
                    $excluir = array_combine($excluir, $excluir);
                    $request->__set('status',$status);
                    $request->__set('user_motor_id',$user_motor_id);
                    $usuarioModel = new UsuarioMotocicleta();
                    $key = ["user_id","motor_id"];
                    $value = [$sessionuser['id'],$motocicleta];
                    $array = array_combine($key, $value);
                    $updateusuario = $usuarioModel->where($array)->update($request->all(), $excluir);
                    if($updateusuario>=0){
                        $excluir = ["idm","schedule"];
                        $excluir = array_combine($excluir, $excluir);
                        $request->__set('availability',$availability);
                        $request->__set('quantity',$quantity);
                        $motocicletaModel = new Motocicleta();
                        $updatemotocicleta = $motocicletaModel->where('idm','=',$motocicleta)->update($request->all(),$excluir);
                        ($updatemotocicleta>=0)
                         ? $mensaje = $this->mensajes(EMensajes::ACTUALIZACION_EXITOSA,'dashboard')
                         : $mensaje = $this->mensajes(EMensajes::ERROR_ACTUALIZACION,'dashboard');
                        return $mensaje;
                    }else
                        return $this->mensajes(EMensajes::ERROR_ACTUALIZACION,'dashboard');
                }else
                    return $this->mensajes(EMensajes::ERROR_CANCELAR_SOLICITUD,'dashboard');
            }else
                return $this->mensajes(EMensajes::ERROR_USUARIO_CONDUCTOR_NO_EXISTE,'dashboard');
        }else if(count($array)==3 && intval($array[0])==0 && intval($array[1]) && strval($array[2])){
            $status = 1;
            $user_motor_nombre = $array[2];
            $motor_id = $array[1];
            $sessionuser = $this->getUserSessionData();
            $lista = $this->buscarUsuarioMotocicleta($sessionuser['id'], $motor_id);
            if($lista!=NULL){
                if($lista['status']==0 && $lista['availability']==0 && $lista['quantity']==0){
                    return $this->mensajes(EMensajes::ERROR_DISPONIBILIDAD,'dashboard');
                }else if($lista['status']==0 && $lista['quantity']<=3 && $lista['quantity']>0){
                    $lista['quantity']==1 ? $availability = 0 : $availability = 1;
                    $quantity = $lista['quantity']-1;
                    $status = 1;
                    $choferModel = new Chofer();
                    $choferPorNombre = $choferModel->where('nombres','=',$user_motor_nombre)->first();
                    if($choferPorNombre!=NULL){
                        $excluir = ["idnum","user_id","motor_id"];
                        $excluir = array_combine($excluir, $excluir);
                        $request->__set('status',$status);
                        $request->__set('user_motor_id',$choferPorNombre['idchofer']);
                        $usuarioModel = new UsuarioMotocicleta();
                        $key = ["user_id","motor_id"];
                        $value = [$sessionuser['id'],$motor_id];
                        $array = array_combine($key, $value);
                        $updateusuario = $usuarioModel->where($array)->update($request->all(), $excluir);
                        if($updateusuario>=0){
                            $excluir = ["idm","schedule"];
                            $excluir = array_combine($excluir, $excluir);
                            $request->__set('availability',$availability);
                            $request->__set('quantity',$quantity);
                            $motocicletaModel = new Motocicleta();
                            $updatemotocicleta = $motocicletaModel->where('idm','=',$motor_id)->update($request->all(),$excluir);
                            ($updatemotocicleta>=0)
                             ? $mensaje = $this->mensajes(EMensajes::ACTUALIZACION_EXITOSA,'dashboard')
                             : $mensaje = $this->mensajes(EMensajes::ERROR_ACTUALIZACION,'dashboard');
                           return $mensaje;
                        }else
                            return $this->mensajes(EMensajes::ERROR_ACTUALIZACION,'dashboard');
                    }else
                        return $this->mensajes(EMensajes::ERROR_CHOFER,'dashboard');
                }else
                    return $this->mensajes(EMensajes::ERROR,'dashboard');
            }else
                return $this->mensajes(EMensajes::ERROR_USUARIO_CONDUCTOR_NO_EXISTE,'dashboard');
        }else
            return $this->viewRedirect('dashboard');
    }
    private function buscarUsuarioMotocicleta($user, $moto){
        $usuarioModel = new UsuarioMotocicleta();
        $key = ["usuariomotocicleta.motor_id","user_id","idm"];
        $value = ["motocicleta.idm",$user,$moto];
        $array = array_combine($key, $value);
        $lista = $usuarioModel->join('motocicleta')->where($array)->first();
        $v = count($lista);
        if($v) return $lista;
        else return NULL;
    }

}