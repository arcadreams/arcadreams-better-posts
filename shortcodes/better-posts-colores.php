<?php


function colores_bootstrap($color) {


	switch ($color) {
    	case "azul":
       		$color = "-primary";
        	break;
    	case "gris":
       		$color = "-secondary";
        	break;
    	case "verde":
       		$color = "-success";
        	break;
    	case "rojo":
       		$color = "-danger";
        	break;
		case "amarillo":
       		$color = "-warning";
        	break;
		case "turquesa":
       		$color = "-info";
        	break;
		case "blanco":
       		$color = "-light";
        	break;
		case "negro":
       		$color = "-dark";
        	break;
		case "link":
       		$color = "-link";
        	break;
		default:
       		$color = "-primary";
        	break;	
	}
	
	return $color;
}
    
    
    
function colores($color) {

// https://colorswall.com/palette/3/

// no, negro, blanco, azul_claro, azul, verde, amarillo, rojo.
	switch ($color) {
    	case "negro": 		$color = "#000000"; break;
    	case "blanco":		$color = "#ffffff"; break;
    //	case "azul_claro":	$color = "#d1ecf1"; break;
    	case "azul_claro":	$color = "#5bc0de"; break;
    	
    	
 		//case "azul":		$color = "blue";	break;
 		case "azul":		$color = "#007bff";	break;
 		
		case "verde":		$color = "green"; 	break;
 		case "verde_claro":	$color = "#00FFBB"; break;
		case "amarillo":	$color = "yellow"; 	break;
    	case "rojo":		$color = "#FF5C5C"; break;
    	case "no":			$color = ""; 	break;

			//default:	$color = "#d1ecf1";
	}
	
/*	switch ($color) {
    case "amarillo": $color = "yellow";break;
    case "azul": $color = "blue"; break;
    case "rojo": $color = "red"; break;
    case "verde": $color = "green"; break;
    case "negro": $color = "black"; break;
	}
*/	
	return $color;
}	
    