<?php

    class OperacaoData{

        public static function converterDataUSAtoBR($data){
            if(self::isStringDataUSAFormat($data) == 1){
                return date('d/m/Y', strtotime($data));
            }
            return 0;
        }

        public static function isStringDataUSAFormat($data) {
            $padrao = "/^(\d{1,2})\/(\d{1,2})\/(\d{2})$/";
            if(preg_match($padrao, $data) && is_string($data)){
                $arr  = explode('/', $data);
                if (checkdate($arr[0], $arr[1], $arr[2])) {
                    return 1;
                }
            }
            return 0;
        }
    }


?>