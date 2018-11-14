<?php 


class Helper{
    public static function dump($var){
        echo "<pre>";
        var_dump($var);
    }

    public static function dateFr($date){
        return date('d/m/Y',time($date));
    }
}