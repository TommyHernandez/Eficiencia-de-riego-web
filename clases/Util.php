<?php

class Util {

    public static function getSiNo($seleccionado = "", $id = "", $name = "", $blanco = false) {
        $valores[] = array("0", "no");
        $valores[] = array("1", "sí");
        //$valores[] = array("-1", "banneado");
        return self::getSelect($valores, $seleccionado, $id, $name, $blanco);
    }

    public static function getRol($seleccionado = "", $id = "", $name = "", $blanco = false) {
        $valores[] = array("administrador", "Administrador");
        $valores[] = array("usuario", "Usuario normal");
        if ($seleccionado === "") {
            $seleccionado = "usuario";
        }
        return self::getSelect($valores, $seleccionado, $id, $name, $blanco);
    }

    public static function getSelect($valores, $seleccionado = "", $id = "", $name = "", $blanco = true) {
        $r = "<select name=\"$name\" id=\"$id\" >";
        if ($blanco)
            $r .= "<option value=\"\">&nbsp;</option>";
        foreach ($valores as $indice => $valor) {
            $selected = "";
            if (is_array($valor)) {
                if ($valor[0] === $seleccionado)
                    $selected = "selected=\"selected\"";
                $r .= "<option $selected value=\"$valor[0]\">$valor[1]</option>";
            }
            else {
                if ($valor === $seleccionado) {
                    $selected = "selected=\"selected\"";
                }
                $r .= "<option $selected value=\"$valor\">$valor</option>";
            }
        }
        $r .= "</select>";
        return $r;
    }

}
