<?php
class EMensajes{
    const CORRECTO = "kmOG0P8zdlCiZuW=";
    const INSERCION_EXITOSA = "YwH14eJ0U5t97Vs=";
    const ACTUALIZACION_EXITOSA = "cPQGMQEJxjsnkyZ=";
    const ERROR_INSERCION = "ky9Y0bwXTCMjW1f==";
    const ERROR_CAMPOS_VACIOS = "08RD6qJMxP8HtK8==";
    const ERROR_USUARIO_REGISTRADO = "thXhfW6dB3nhfkS==";
    const ERROR_USUARIO_INCORRECTO = "Z79vXw6pje5Wegz==";
    const ERROR_PASSWORD_INCORRECTO = "u44q6MTlECHsQsc==";
    const ERROR_DISPONIBILIDAD = "nCCFZzzUyhMWslq==";
    const ERROR_USUARIO_CONDUCTOR_NO_EXISTE= "7qpV4br3SzQdLLB==";
    const ERROR_CANCELAR_SOLICITUD = "Ji2dflvExLozAOc==";
    const ERROR_ACTUALIZACION = "mYmEdwSpmYforoF==";
    const ERROR_CHOFER = "E7LpXufjZYndZ6w==";
    const ERROR = "oCxZdNwlFlvzaas==";
    
    private static $mensajesList = [
        EMensajes::CORRECTO,
        EMensajes::INSERCION_EXITOSA,
        EMensajes::ACTUALIZACION_EXITOSA,
        EMensajes::ERROR_INSERCION,
        EMensajes::ERROR_CAMPOS_VACIOS,
        EMensajes::ERROR_USUARIO_REGISTRADO,
        EMensajes::ERROR_USUARIO_INCORRECTO,
        EMensajes::ERROR_PASSWORD_INCORRECTO,
        EMensajes::ERROR_DISPONIBILIDAD,
        EMensajes::ERROR_USUARIO_CONDUCTOR_NO_EXISTE,
        EMensajes::ERROR_CANCELAR_SOLICITUD,
        EMensajes::ERROR_ACTUALIZACION,
        EMensajes::ERROR_CHOFER,
        EMensajes::ERROR
    ];
    
    public static function getMensaje($codigo){
        switch ($codigo) {
            case EMensajes::CORRECTO:
                return new Respuesta(1, "Se ha realizado la operacion de manera correcta", EMensajes::CORRECTO);
            case EMensajes::INSERCION_EXITOSA:
                return new Respuesta(1, "Se ha insertado el registro con exito", EMensajes::INSERCION_EXITOSA);
            case EMensajes::ACTUALIZACION_EXITOSA:
                return new Respuesta(1, "Se actualizo el registro con exito", EMensajes::ACTUALIZACION_EXITOSA);
            case EMensajes::ERROR:
                return new Respuesta(-1, "Se ha producido un error al realizar la operacion", EMensajes::ERROR);
            case EMensajes::ERROR_CAMPOS_VACIOS:
                return new Respuesta(-1, "Los campos estan vacios", EMensajes::ERROR_CAMPOS_VACIOS);
            case EMensajes::ERROR_INSERCION:
                return new Respuesta(-1, "Se ha producido un error al insertar el registro", EMensajes::ERROR_INSERCION);
            case EMensajes::ERROR_USUARIO_REGISTRADO:
                return new Respuesta(-1, "El nombre ya se encuentra registrado.", EMensajes::ERROR_USUARIO_REGISTRADO);
            case EMensajes::ERROR_USUARIO_INCORRECTO:
                return new Respuesta(-1, "El usuario es incorrecto", EMensajes::ERROR_USUARIO_INCORRECTO);
            case EMensajes::ERROR_PASSWORD_INCORRECTO:
                return new Respuesta(-1, "La contraseña es incorrecta", EMensajes::ERROR_PASSWORD_INCORRECTO);
            case EMensajes::ERROR_DISPONIBILIDAD:
                return new Respuesta(-1, "No hay disponibilidad, recargue la pagina", EMensajes::ERROR_DISPONIBILIDAD);
            case EMensajes::ERROR_USUARIO_CONDUCTOR_NO_EXISTE:
                return new Respuesta(-1, "El usuario o conductor no existe recargue la pagina", EMensajes::ERROR_USUARIO_CONDUCTOR_NO_EXISTE);
            case EMensajes::ERROR_CANCELAR_SOLICITUD:
                return new Respuesta(-1, "Ocurrio un error al cancelar la actualizar, intentelo de nuevo", EMensajes::ERROR_CANCELAR_SOLICITUD);
            case EMensajes::ERROR_ACTUALIZACION:
                return new Respuesta(-1, "Ocurrio un error actualizar la solicitud", EMensajes::ERROR_ACTUALIZACION);
            case EMensajes::ERROR_CHOFER:
                return new Respuesta(-1, "No se encontro al conductor, seleccione uno", EMensajes::ERROR_CHOFER);
        }
    }
    public static function existeValor($constante){
        if(in_array($constante, EMensajes::$mensajesList)) return true;
        else return false;
    }
}