<?php

function espacio_blanco() {
    
    return '&nbsp;';

}

function espacios_blanco() {
    
    return '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

}

function plugin_activo($nombre){
    $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
    foreach($active_plugins as $plugin){
        if(strrpos($plugin, $nombre)){
// $mensaje = 'Existe el plugin: ' . $plugin . ' buscado con el nombre: ' . $nombre . ' en ' . home_url() . '.';
// wp_mail( 'sergioromeroponce@hotmail.com', 'EXISTE PLUGIN', $mensaje );
            return true;
        }
    }
	$mensaje = 'Falta el plugin buscado con el nombre: ' . $nombre . ' en ' . home_url() . '.';
	// wp_mail( 'sergioromeroponce@hotmail.com', 'FALTA PLUGIN', $mensaje );

	return false;
}


// 	MOSTRAR URL
add_shortcode( 'mostrar', 'mostrar_shortcode' );
function mostrar_shortcode ($atts = [], $content = null) {
        $a = shortcode_atts( array(
		    'id' => 'vacio',
		    'url' => 'vacio',
	        ), $atts );
			
	$s = $_SERVER;
	$url_actual = $s['REQUEST_URI']; //  /plan-amigo/
	$url_actual = substr($url_actual,1);
	$url_actual = substr($url_actual,0,-1);  
	
	if ( $url_actual == $a['url']) return do_shortcode($content);
	
}

// 	OCULTAR URL
add_shortcode( 'ocultar', 'ocultar_shortcode' );
function ocultar_shortcode ($atts = [], $content = null) {
        $a = shortcode_atts( array(
		    'id' => 'vacio',
		    'url' => 'vacio',
	        ), $atts );
			
	$s = $_SERVER;
	$url_actual = $s['REQUEST_URI']; //  /plan-amigo/
	$url_actual = substr($url_actual,1);
	$url_actual = substr($url_actual,0,-1);  
	
	if ( $url_actual != $a['url']) return do_shortcode($content);
	
}


function obtener_icono($icono) {
  
	// estrella, corazon, check, contra, advertencia, idea, sync, euro, flechac, lista, info_circulo, info, reloj, comentario, comentarios, mapa, imagenes, email, llave, candado, candado_abierto, candado_cerrado, usuario, pulgar, mano_stop.     
	
	// https://fontawesome.com/icons
   	switch ($icono) {
		
	// FONT AWESOME

		case "casa":        $icono = "fas fa-home";     	$color = "black";  break;
		case "estrella":    $icono = "fas fa-star";     	$color = "yellow";  break;
    	case "corazon":	    $icono = "fas fa-heart";    	$color = "red";     break;
    	case "check": 	    $icono = "fas fa-check";    	$color ="green";    break;
     	case "contra":	    $icono = "fas fa-times-circle"; $color = "red";   break;
    	case "advertencia":	$icono = "fas fa-exclamation-triangle"; $color = "yellow";   								break;
    	case "idea":	    $icono = "fas fa-lightbulb"; 	$color = "yellow";   break;
   		case "sync":	    $icono = "fas fa-sync-alt"; 	$color = "black";   break;
    	case "euro":	    $icono = "fas fa-euro-sign"; 	$color = "black";   break;
    	case "flechac":	 	$icono = "fas fa-caret-square-right"; 	$color = "#d1ecf1";   								break;
    	case "lista":	    $icono = "fas fa-list"; 		$color = "black";   break;
    	case "info_circulo":$icono = "fas fa-info-circle"; 	$color = "black";   break;
   		case "info":	    $icono = "fas fa-info"; 		$color = "black";   break;
   		case "reloj":	    $icono = "far fa-clock"; 		$color = "black";   break;

   		case "comentario":	$icono = "far fa-comment"; 		$color = "black";   break;
   		case "comentarios":	$icono = "far fa-comments"; 	$color = "black";   break;
   		case "mapa":		$icono = "fas fa-map-marked-alt"; 	$color = "black";   break;
    	case "carretera":	$icono = "fas fa-road"; 		$color = "black";   break;
    	case "senal":		$icono = "fas fa-map-signs"; 	$color = "black";   break;
    	case "camara":		$icono = "fas fa-camera-retro"; $color = "black";   break;
    	case "personas":		$icono = "fas fa-users"; $color = "black";   break;

		case "imagenes":	$icono = "far fa-images"; 		$color = "black";   break;
   		case "email":		$icono = "fas fa-at"; 			$color = "black";   break;
   		case "llave":		$icono = "fas fa-key"; 			$color = "black";   break;
     	case "candado":	    $icono = "fab fa-expeditedssl"; $color = "black";   break;
     	case "candado_abierto":	    $icono = "fas fa-unlock-alt"; $color = "black";   break;
     	case "candado_cerrado":	    $icono = "fas fa-lock"; $color = "black";   break;
     	case "usuario":	    $icono = "far fa-user"; 		$color = "black";   break;
		// MANOS
		case "pulgar":	    $icono = "far fa-thumbs-up"; 	$color = "black";   break;
		case "pulgar_abajo":$icono = "far fa-thumbs-down"; 	$color = "black"; 	break;
     	case "mano_stop":   $icono = "far fa-hand-paper"; 	$color = "black";   break;
		
        // COMER
     	case "restaurante":   $icono = "fas fa-utensils"; 	$color = "black";   break;
        
     	case "wiki":   $icono = "fab fa-wikipedia-w"; 	$color = "black";   break;

		case "instagram":   $icono = "fab fa-instagram"; 	$color = "black";   break;

		default: $icono = "fas fa-star";     	$color = "yellow";  break;
	}
	
	return array( 'icono' => $icono,'color' => $color );
}	


add_shortcode( 'icono', 'icono_shortcode' );
function icono_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'tipo' => 'vacio',
		'bar' => 'vacio',
	), $atts );

	if (!function_exists('obtener_icono')) return;	

 	$tipo = $a['tipo'];
    $valores = obtener_icono($tipo);

	return '<i class="'.$valores['icono'].'" style="color: '.$valores['color'].'; text-align: center; padding-right: 0.5em; padding-left: 0.5em;"></i>';

}

add_shortcode( 'emoji', 'emoji_shortcode' );
function emoji_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'tipo' => 'vacio',
	), $atts );  

	// https://www.w3schools.com/charsets/ref_emoji.asp
   	switch ($a['tipo']) {
	// EMOJIS
     	case "top":			$icono = "&#x1F51D;";	break;
     	case "sonrisa":		$icono = "&#x1F60A;";	break;
     	case "lloro":		$icono = "&#x1F602;";	break;
     	case "sudor":		$icono = "&#x1F613;";	break;
     	case "beso":		$icono = "&#x1F618;";	break;
     	case "broma":		$icono = "&#x1F61C;";	break;
     	case "enfado":		$icono = "&#x1F621;";	break;
     	case "asombro":		$icono = "&#x1F631;";	break;
     	case "broma":		$icono = "&#x1F61C;";	break;
     	case "espana":		$icono = "&#x1F1EA;";	break;
     	case "rezo":		$icono = "&#x1F64F;";	break;
     	case "broma":		$icono = "&#x1F61C;";	break;
			
			
	}
	
	return $icono;
}


function montar_una_tabla($array_tabla , $td_estilo , $a_estilo ) {

//    $resultado .= '<table style="width:100%">';
    $resultado .= '<table>';

	$columnas = count($array_tabla);
	// echo " COLUMNAS TABLE: " . $columnas . " .";
	$filas = count($array_tabla[0]);
	// echo " FILAS TABLE: " . $filas . " .";

	// Cabecera
	$resultado .= '<tr>';
	for($r=0;$r<$columnas;$r++) {
		$resultado .= '<th>'.$array_tabla[$r][0].'</th>';
	}	
	$resultado .= '</tr>';	

	// Cuerpo
	// No pongo k=0 porque el 0 lo he escrito antes, la cabecera, por si quiero darle formato distino al resto del cuerpo
	for($k=1;$k<$filas;$k++) {   // CUENTO NUMERO DE COLUMNAS AQUÍ
	    //echo "For: " . $k . '<br>';

    $resultado .= '<tr>';
		$resultado .= '<td '.$td_estilo.'>'.$array_tabla[0][$k].'</td>'; 
		$resultado .= '<td '.$td_estilo.'>'.$array_tabla[1][$k].'</td>';                   			
		$resultado .= '<td '.$td_estilo.'>'.$array_tabla[2][$k].'</td>';                
      	$resultado .= '<td '.$td_estilo.'>'.$array_tabla[3][$k].'</td>';                   
      	$resultado .= '<td '.$td_estilo.'>'.$array_tabla[4][$k].'</td>';                   
      	$resultado .= '<td '.$td_estilo.'>'.$array_tabla[5][$k].'</td>';                   
      	$resultado .= '<td '.$td_estilo.'>'.$array_tabla[6][$k].'</td>';                   
      	$resultado .= '<td '.$td_estilo.'>'.$array_tabla[7][$k].'</td>';                   
      	$resultado .= '<td '.$td_estilo.'>'.$array_tabla[8][$k].'</td>';                   
	$resultado .= '</tr>';
	
    }   // FIN FOR PRINCIPAL
	
    $resultado .= '</table>';

	return $resultado;
}


// GOOGLE MAPS PROPIOS
add_shortcode( 'mapa_google', 'mapa_google_shortcode' );
function mapa_google_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'id' => 'vacio',
		'bar' => 'vacio',
	), $atts );


 	$id = $a['id'];

    return '<iframe src="https://www.google.com/maps/d/u/0/embed?mid='.$id.'" width="640" height="480"></iframe>';

	//return '<i class="'.$valores['icono'].'" style="color: '.$valores['color'].'; text-align: center; padding-right: 0.5em; padding-left: 0.5em;"></i>';

}



/**************************************************************************
 * 
 * 							DETECTOR DISPOSITIVO
 * 
 * ************************************************************************/

// 	SHORTCODE MOVIL
add_shortcode( 'movil', 'movil_shortcode' );
function movil_shortcode ($atts = [], $content = null) {
        $a = shortcode_atts( array(
		    'id' => 'vacio',
		    'titulo' => 'vacio',
	        ), $atts );
	
	if ( es_movil() or es_tablet() ) return do_shortcode($content);
	
}

// 	SHORTCODE PC
add_shortcode( 'pc', 'pc_shortcode' );
function pc_shortcode ($atts = [], $content = null) {
        $a = shortcode_atts( array(
		    'id' => 'vacio',
		    'titulo' => 'vacio',
	        ), $atts );
	
	if ( !es_movil() and !es_tablet() ) return do_shortcode($content);
	
}






// https://www.lije-creative.com/detection-avancee-des-mobiles-en-php/
/*
https://www.lije-creative.com/detection-avancee-des-mobiles-en-php/
    isAndroid()
    isAndroidtablet()
    isIphone()
    isIpad()
    isBlackberry()
    isBlackberrytablet()
    isPalm()
    isWindowsphone()
    isWindows()
    isGeneric()
    if ($detect->isAndroid()) {
    echo "Hey, je tourne sur android";
}

include("Mobile_Detect.php");
$detect = new Mobile_Detect();
if ($detect->isMobile()) {
    echo "coucou, je suis un mobile";
}
*/
/*
			require_once("Mobile_Detect.php");

			$detect = new Mobile_Detect();

			if ($detect->isMobile()){
				echo "Mobile !";}

			if ($detect->isTablet()){
				echo "Tablet !";}

			if (
				$detect->isAndroid()
			)

			if (
				$detect->isIpad()
			)
*/

function es_movil() {
	$detect = new Mobile_Detect();
	if ($detect->isMobile()) return true;
	else return false;
}	

function es_tablet() {
	$detect = new Mobile_Detect();
	if ($detect->isTablet()) return true;
	else return false;
}

class Mobile_Detect
	{
		protected $accept;
		protected $userAgent;
		protected $isMobile = false;
		protected $isAndroid = null;
		protected $isAndroidtablet = null;
		protected $isIphone = null;
		protected $isIpad = null;
		protected $isBlackberry = null;
		protected $isBlackberrytablet = null;
		protected $isOpera = null;
		protected $isPalm = null;
		protected $isWindows = null;
		protected $isWindowsphone = null;
		protected $isGeneric = null;
		protected $isKindle = null;
		protected $tablet = array(
			"androidtablet" => "android(?!.*mobile)",
			"blackberrytablet" => "rim tablet os",
			"kindle" => "(kindle)",
			"ipad" => "(ipad)",
		);
		protected $mobile = array(
			"android" => "android.*mobile",
			"blackberry" => "blackberry",
			"iphone" => "(iphone|ipod)",
			"palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
			"windows" => "windows ce; (iemobile|ppc|smartphone)",
			"windowsphone" => "windows phone os",
			"generic" => "(mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
		);

		public function __construct()
		{
			$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
			$this->accept = $_SERVER['HTTP_ACCEPT'];

			if (
				isset($_SERVER['HTTP_X_WAP_PROFILE']) ||
				isset($_SERVER['HTTP_PROFILE'])) {
				$this->isMobile = true;
			}
			else if (
				strpos($this->accept, 'text/vnd.wap.wml') > 0
				OR strpos($this->accept, 'application/vnd.wap.xhtml+xml') > 0)
			{
				$this->isMobile = true;
			}
			else
			{
				foreach ($this->tablet as $tablet => $regexp) {
					if (
						$this->isDevice($tablet)
					)
					{
						$this->isTablet = true;
					}
				}
				foreach ($this->mobile as $mobile => $regexp) {
					if (
						$this->isDevice($mobile)
					)
					{
						$this->isMobile = true;
					}
				}

			}
		}

		/**
		 * isAndroid() | isAndroidtablet() | isIphone() | isIpad() | isKindle() | isBlackberry() | isBlackberrytablet() | isPalm() | isWindowsphone() | isWindows() | isGeneric() par isDevice()
		 *
		 * @param string $name
		 * @param array $arguments
		 * @return bool
		 */
		public function __call($name, $arguments)
		{
			$device = substr($name, 2);

			$deviceList = array_merge($this->tablet,$this->mobile);

			if (
				$name == "is" . ucfirst($device)
				AND array_key_exists(strtolower($device), $deviceList)
			)
			{
				return $this->isDevice($device);
			}
			else
			{
				trigger_error("Methode $name inconnue", E_USER_WARNING);
			}
		}

		/**
		 * Retourne true si c'est un mobile, peu importe le type
		 * @return bool
		 */
		public function isMobile()
		{
			return $this->isMobile;
		}
		public function isTablet()
		{
			return $this->isTablet;
		}

		protected function isDevice($device)
		{
			$deviceList = array_merge($this->tablet,$this->mobile);

			$var = "is" . ucfirst($device);
			$return = $this->$var === null ? (bool) preg_match("/" . $deviceList[strtolower($device)] . "/i", $this->userAgent) : $this->$var;

			if (
				$device != 'generic' && $return == true
			)
			{
				$this->isGeneric = false;
			}

			return $return;
		}
}
/**************************************************************************
 * 
 * 							FIN DETECTOR DISPOSITIVO
 * 
 * ************************************************************************/
 
 
