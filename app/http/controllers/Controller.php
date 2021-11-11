<?php
class Controller{
    protected $request;
    private $view;

    function __construct(){}

    public function view($file, $variables = null, $json=false){
        if(empty($this->view)) $this->view = new View();
        return $this->view->render($file, $variables, $json);
    }
    public function viewRedirect($route, $mensajes=array()){
        if(empty($this->view)) $this->view = new View();
        return $this->view->redirect($route, $mensajes);
    }
    public function getTypeData($data = array()){
        foreach($data as $value){
            if(gettype($value)!='string' && gettype($value)=='NULL' ) return false;
            elseif(gettype($data[count($data)-1])=='string') return true;
        }
    }
    public function emptyFields($fields = array()){
        foreach($fields as $field)
            if($field=='' || empty($field)) return true;
        return false;
    }
    public function mensajes($mensajes, $redirect){
        $mensaje = array(new Respuesta($mensajes));
        $variables = ['error'=>$mensaje[0]->codificar];
        return $this->viewRedirect($redirect, $variables);
    }
    public function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function subirImagen($tipo, $archivo, $nombre){
        if(strstr($tipo, 'image')){
            if(strstr($tipo, 'jpeg')) $extension = '.jpg';
            else if(strstr($tipo, 'png')) $extension = '.png';
            $tamImg = getimagesize($archivo);
            $anchoImg = $tamImg[0];
            $altoImg = $tamImg[1];
            $anchoImgDeseado = 420;
            if($anchoImg > $anchoImgDeseado){
                $nuevoAncho = $anchoImgDeseado;
                $nuevoAlto = ($altoImg/$anchoImg)*$nuevoAncho;
                $imgReajustada = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                switch ($extension) {
                    case '.jpg':
                        $imgOriginal = imagecreatefromjpeg($archivo);
                        imagecopyresampled($imgReajustada,$imgOriginal,0,0,0,0,$nuevoAncho,$nuevoAlto,$anchoImg,$altoImg);
                        $nombreExt = 'assets/imagenes/'.$nombre.$extension;
                        $nombreImg = 'assets/imagenes/'.$nombre;
                        imagejpeg($imgReajustada, $nombreExt, 100);
                        $this->borrar_imagen($nombreImg, '.jpg');
                        break;
                    case '.png':
                        $imgOriginal = imagecreatefrompng($archivo);
                        imagecopyresampled($imgReajustada,$imgOriginal,0,0,0,0,$nuevoAncho,$nuevoAlto,$anchoImg,$altoImg);
                        $nombreExt = 'assets/imagenes/'.$nombre.$extension;
                        $nombreImg = 'assets/imagenes/'.$nombre;
                        imagepng($imgReajustada, $nombreExt);
                        $this->borrar_imagen($nombreImg, '.jpg');
                        break;
                }
            }else{
                $destino = 'assets/imagenes/'.$nombre.$extension;
                move_uploaded_file($archivo, $destino) or die('No se pudo subir la imagen al servidor');
                $rutaImg = 'assets/imagenes/'.$nombre;
                $this->borrar_imagen($rutaImg,$extension);
            }
            $imagen = $nombre.$extension;
            return $imagen;
        }else{
            return false;
        }
    }
    public function borrar_imagen($ruta, $extension){
        switch ($extension) {
            case '.jpg':
                if(file_exists($ruta.'.png')) unlink($ruta.'.png');
                break;
            case '.png':
                if(file_exists($ruta.'.jpg')) unlink($ruta.'.jpg');
                break;
        }
    }
    public function getRequest(){ return $this->request; }
    public function setRequest($request){ $this->request = $request; }
}