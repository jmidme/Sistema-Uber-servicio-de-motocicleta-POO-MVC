<?php
class ControladorImagenes extends SessionController{

    function __construct(){
        parent::__construct();
    }

    public function imagenes(){ return $this->view('imagenes/index'); }
    
    public function registrarimagenes(Request $request){
        $imagenGenerica = 'amigo.png';
        $data = $request->request;
        $tipo = $data['archivo']['type'];
        $archivo = $data['archivo']['tmp_name'];
        $subirImagen = $this->subirImagen($tipo, $archivo, $data['nombreimg']);
        $imagen = empty($archivo) ? $imagenGenerica : $subirImagen;
        $request->__set('url',$imagen);
        $imagenModel = new Imagenes();
        $insertImagen = $imagenModel->insert($request->all());
        return $this->viewRedirect('imagenes');
    }
}