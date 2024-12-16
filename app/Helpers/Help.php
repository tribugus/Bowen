<?php

use Illuminate\Support\Facades\Cookie;

define('R1', '$2y$12$bpshgxeagffwstam5ofgtofwlyscnf7glphgmum0aibqzzrvmsxgk');
define('R2', '$2y$12$ysisfixri0apyrigjxvpbome0irmb7xuvasbi.b8ytbt7w5h.whzk');
define('R3', '$2y$12$rmmqt.0x2xp7bxho5izcmucbxyu9k8bwpcqqxkk4ic.7sakd9lmia');
define('R4', '$2y$12$hjm5isyu2zabgoja/yvrs.8q/ef3zsiuw85k9/a.i6fx1acwdb61g');
define('R5', '$2y$12$ul.ixp9smdxlr5edeqg7c.95vx0mcc.qqd7dh/9czehamgyiwlkee');
define('R6', '$2y$12$kkqx33ap/cqtshtyyqxw2ob6u1kwzjzciki2hovdixl1ahirsip6.');
define('R7', '$2y$12$yai5mrqqxxcklt72mtzcrov3jwnbkx7m/esmmn4t/sbvjwlauniro');


if (! function_exists('User')) {
    function User($param) {

        $jsonString = Cookie::get('usuario');
        $object = json_decode($jsonString, $assoc = false, $depth = 512, $options = 0);
        return $object->$param;

    }
}

if (! function_exists('HAR')) {
    function HAR() {
        return mb_strtolower(User('roll') ? User('roll')->hash : '×');
    }
}

if (! function_exists('THEME')) {
    function THEME() {
        return $theme = $_COOKIE['theme'] ?? null; 
    }
}


if (! function_exists('PUR')) {
    function PUR($permiso) {
        $pos = strpos($permiso, HAR());
        if($pos === false) {
            return false;
        } else {
            return true;
        }
    }
}


if (! function_exists('CURL')) {
    function CURL($array,$cur) {
        $pos = array_filter($array, function($valor) use ($cur) {
            return strpos($cur, $valor) !== false;
        });
        if (!empty($pos)) {
            return true;
        } else {
            return false;
        }
    }
}


if (! function_exists('mesEnNumero')) {
    function mesEnNumero($mes) {
        // Array que mapea los meses en letra a su número
        $meses = [
            'enero' => 1,
            'febrero' => 2,
            'marzo' => 3,
            'abril' => 4,
            'mayo' => 5,
            'junio' => 6,
            'julio' => 7,
            'agosto' => 8,
            'septiembre' => 9,
            'octubre' => 10,
            'noviembre' => 11,
            'diciembre' => 12
        ];
        // Convertir el mes a minúsculas para evitar problemas con mayúsculas
        $mes = strtolower(trim($mes));
        // Verificar si el mes existe en el array y devolver su valor con formato de 2 dígitos
        if (array_key_exists($mes, $meses)) {
            return str_pad($meses[$mes], 2, '0', STR_PAD_LEFT); // Agregar el 0 si es necesario
        } else {
            return null; // Si el mes no es válido, regresa null
        }
    }
}



if (! function_exists('foFech')) {
    function foFech($miter,$string) {
        $ex = explode($miter,trim( str_replace(' ', '', $string ) ));

        $n = substr_count(str_replace(' ', '', $string ), $miter);

        if($n>1){
            $date = $ex[2]."-".mesEnNumero($ex[0])."-".$ex[1];
        }else{
            $date = mesEnNumero($ex[0])."-".$ex[1];
        }
        return $date;
    }
}



        
        



//str_contains($cUrl, 'roles')