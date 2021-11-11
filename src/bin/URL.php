<?php
class URL{
    public static function base(){
        $base_dir = str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
        $baseURL = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$base_dir}";
        return trim($baseURL, "/");
    }
    public static function to($url){
        $url = trim($url, "/");
        return URL::base() . "/{$url}";
    }
    public static function getFull(){
        return (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    }
    public static function getMessages(){
        $basename = basename(URL::getFull());
        if(strpos($basename, '=')>=15){
            $mensaje = array(new Respuesta($basename));
            return [$mensaje[0]->codigo, $mensaje[0]->mensaje];
            // strpos($basename,'==')
            //  ?'<div class="alert alert-warning text-center" role="alert">'.$mensaje[0]->mensaje.'</div>' 
            //  : '<div class="alert alert-success text-center" role="alert">'.$mensaje[0]->mensaje.'</div>' ;
            // strpos($basename,'==')
            //  ? '<input type="hidden" id="error" value="'.$mensaje[0]->mensaje.'">'
            //  : '<input type="hidden" id="success" value="'.$mensaje[0]->mensaje.'">';
        }
    }
}