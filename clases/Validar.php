<?php

class Validar {
    
    static function isCorreo($v){
        return filter_var($v, FILTER_VALIDATE_EMAIL);
    }
    static function isEntero(){
        return filter_var($v, FILTER_VALIDATE_INT);
    }
    static function isNumero($v){
        return filter_var($v, FILTER_VALIDATE_FLOAT);
    }
    
    static function isTelefono($v){
    }
    
    static function isURL($v){
        return filter_var($v, FILTER_VALIDATE_URL);
    }
    
    static function isIP($v){
        return filter_var($v, FILTER_VALIDATE_IP);
    }
    
    static function isFecha($v){
    }
    
    static function isDNI($v){
    }
    
    static function isCP($v){
    }
    
    static function isLongitud($v, $lmin=1, $lmax=-1){
    }
        
    static function isLogin($v){
         return self::isCondicion($v, '/^[A-Za-z][A-Za-z0-9]{4,8}[A-Za-z]$/');
         //1º principio /
         //2º final /
         //^x empieza con x
         //x$ acaba con x
    }
    
    static function isClave($v){
        return self::isCondicion($v, '/[A-Za-z0-9]{6,10}$/');
    }
    
    static function isCondicion($v, $condicion){
        return preg_match($condicion, $v);
    }
    
    static function isAltaUsuario($login, $clave, $claveconfirmada, $nombre, $apellidos, $correo){
        return self::isLogin($login) && ($clave == $claveconfirmada) && self::isCorreo($correo)
                && self::isClave($clave) && strlen($nombre) > 1 && strlen($apellidos) > 3;
    }
}