<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Helper
 *
 * @author blonder413
 */
class Helper {

    public static function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            return $_SERVER['REMOTE_ADDR'];
    }

    // -------------------------------------------------------------------------------------------------------------------
    // Cortar textos sin cortar palabras
    // Original PHP code by Chirp Internet: www.chirp.com.au
    // Please acknowledge use of this code by including this header.
    public static function myTruncate($string, $limit, $break = " ", $pad = "...") {
        // return with no change if string is shorter than $limit
        if (strlen($string) <= $limit) {
            return $string;
        }
        // is $break present between $limit and the end of the string?
        if (false !== ($breakpoint = strpos($string, $break, $limit))) {
            if ($breakpoint < strlen($string) - 1) {
                $string = substr($string, 0, $breakpoint) . $pad;
            }
        }
        return $string;
    }
    // -------------------------------------------------------------------------------------------------------------------
    // Obtengo los textos limpios para usarlos como url
	public static function limpiaUrl($entra) {
		$traduce = array (
				'á' => 'a',
				'é' => 'e',
				'í' => 'i',
				'ó' => 'o',
				'ú' => 'u',
				'Á' => 'A',
				'É' => 'E',
				'Í' => 'I',
				'Ó' => 'O',
				'Ú' => 'U',
				'ñ' => 'n',
				'Ñ' => 'N',
				'ä' => 'a',
				'ë' => 'e',
				'ï' => 'i',
				'ö' => 'o',
				'ü' => 'u',
				'Ä' => 'A',
				'Ë' => 'E',
				'Ï' => 'I',
				'Ö' => 'O',
				'Ü' => 'U' 
		);
		$sale = strtr ( $entra, $traduce );
		
		$texto = str_replace ( " ", "-", $sale );
		
                $texto = strtolower($texto);
                
		return $texto;
	}
}
