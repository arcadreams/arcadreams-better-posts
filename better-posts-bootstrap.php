<?php


/**************************************************************************
 * 
 * 						        BOOTSTRAP
 * 
 * ************************************************************************/



// Incluir Bootstrap CSS
add_action( 'wp_enqueue_scripts', 'bootstrap_css');
function bootstrap_css() {

	wp_enqueue_style( 'bootstrap_css', 
  			'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', 
  			array(), 
  			'4.4.1'
  	); 
  					
}



// Incluir Bootstrap JS y dependencia popper
add_action( 'wp_enqueue_scripts', 'bootstrap_js');
function bootstrap_js() {

    wp_enqueue_script( 'popper_js', 
  					'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 
  					array(), 
  					'1.14.3', 
  					true); 


	wp_enqueue_script( 'bootstrap_js', 
  					'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', 
  					array('jquery','popper_js'), 
  					'4.4.1', 
  					true); 

}




// Integrate Bootstrap Responsive Table In WordPress Theme
// https://napitwptech.com/tutorial/wordpress-development/integrate-bootstrap-responsive-table-wordpress/
add_filter( 'the_content', 'theme_prefix_bootstrap_responsive_table' );
function theme_prefix_bootstrap_responsive_table( $content ) {
    $content = str_replace(
        [ '<table>', '</table>' ],
        [ '<div class="table-responsive"><table class="table table-bordered table-hover table-striped">', '</table></div>' ],
        $content
    );

    return $content;
}

add_filter( 'the_content', 'theme_prefix_bootstrap_responsive_table2' );
function theme_prefix_bootstrap_responsive_table2( $content ) {
    $content = str_replace(
        [ 'class="rwmb-button"'],
        [ 'class="btn btn-primary"'],
        $content
    );

    return $content;
}


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
    
    

// CAJA BOOTSTRAP
// https://getbootstrap.com/docs/4.4/components/alerts/
/*

ancho_completo="si"
margen="doble"

*/

add_shortcode( 'caja', 'shortcode_caja' );
function shortcode_caja ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'color' => 'vacio',
		    'color_propio' => 'vacio',
		    'texto' => 'vacio',
		    'borde' => 'vacio',
		    'centrado' => 'vacio',			
		    'negrita' => 'vacio',			
		    'ancho_completo' => 'vacio',
		    'margen' => 'vacio',			
	        ), $atts );

    $color = colores_bootstrap($a['color']);
    $color_fondo = "alert alert" . $color;

    $resultado = $ancho_completo = "";

    if (!function_exists('espacios_blanco')) return;	
	if (!function_exists('colores')) return;
	
	/*
	if (function_exists('mb_obtener_valor')) {
		$mb_color = mb_obtener_valor('caja_color_fondo','multi_tema_publico');
		$mb_texto = mb_obtener_valor('caja_color_texto','multi_tema_publico');	
	}
	*/
	
//	$color =  (empty($mb_color)) ? "#d1ecf1" : $mb_color;
//	$borde =  (empty($mb_color)) ? "#d1ecf1" : $mb_color;
//	$texto =  (empty($mb_texto)) ? "#000000" : $mb_texto;

	// ($a>$b) ? "A es Mayor que B":"B es Mayor que A";
	
	$color_propio = ($a['color_propio'] == "vacio") ? $a['color_propio'] : colores($a['color_propio']);
	$texto 		= ($a['texto'] == "vacio") ? $texto : colores($a['texto']);
	$centrado	= ($a['centrado'] == "si") ? " text-align:center;" : "";
	$negrita	= ($a['negrita'] == "si")  ? " font-weight: bold;" : "";
	$borde      = ($a['borde'] == "vacio") ? "" : " font-weight: bold;";
	$margen     = ($a['margen'] == "vacio") ? "" : " padding-top:20px; padding-bottom:20px;";

	if ($a['ancho_completo'] == "si") {
	    if (es_movil()) $ancho_completo	= " margin-right: -05vw; margin-left: -05vw;";
	    else    $ancho_completo	= " margin-right: -20vw; margin-left: -20vw;";
	}    
	else { $ancho_completo = ""; }   

        
    if ($a['borde'] == "vacio") {
        $borde = "";
    } else {
 	    $color_borde = colores($a['borde']);
        $borde = "border: 2px solid ". $color_borde;
    }

//	$color = mb_obtener_valor( 'color_banner_post' , 'multi_tema_publico' );
//	$resultado .= '<div style="background: ' . $color . '; padding: 1em;"><strong>';
//	$resultado .= espacios_blanco();

	// font-size: 1.125rem;
	// background: '.$color.';
//	$resultado = '<div class="'.$color.'" role="alert" style="border: 1px solid '.$borde.'; margin-bottom: 1rem; margin-top: 1rem; padding: 20px; color: '.$texto.'; '.$negrita.' '.$centrado.' '.$ancho_completo.'">';

    $fondo = 'class="'.$color_fondo.'" role="alert"';
    if ($color_propio != "vacio") { $color_propio = "background-color:$color_propio;"; } else $color_propio = "";
    
	$resultado = '<div '.$fondo.' style="color: '.$texto.'; '.$negrita.' '.$centrado.' '.$borde.' '.$ancho_completo.' '.$color_propio.' '.$margen.'">';
    if ($a['titulo'] != 'vacio') {
        $resultado .= '<h4 class="alert-heading" style="margin-top:0px; font-weight:bold; text-align:center;">';
        $resultado .= $a['titulo'];
        $resultado .= '</h4>';
    }  

/*      

        
margin: 1em;
padding: 1em;
*/
	
	$resultado .= do_shortcode($content);
	$resultado .= '</div>';

	return $resultado;
}



// EVENTO
add_shortcode( 'evento', 'shortcode_evento' );
function shortcode_evento ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'color' => 'vacio',
		    'duracion' => 'vacio',
		    'recorrido' => 'vacio',
		    'lugar' => 'vacio',			
		    'bueno' => 'vacio',			
		    'malo' => 'vacio',			
		    'personas' => 'vacio',			
	        ), $atts );
	
	$contenido .= '[icono tipo="reloj"]' . $a['duracion'] . '<br>';

	$contenido .= '<div style="margin-top: 0.5em;">';
	$contenido .= '<div>' . '[icono tipo="mapa"]' . $a['lugar'] . '</div>';
	$contenido .= '</div>';
	
	if ($a['recorrido'] != "vacio") {
	$contenido .= '<div style="margin-top: 0.5em;">';
	$contenido .= '[icono tipo="carretera"]' . $a['recorrido'];
	$contenido .= '</div>';
	}
	
	if ($a['personas'] != "vacio") {
	$contenido .= '<div style="margin-top: 0.5em;">';
	$contenido .= '[icono tipo="personas"]' . $a['personas'];
	$contenido .= '</div>';
	}	
	
	$resumen .= '[icono tipo="pulgar"]' . $a['bueno'];
	if ($a['malo'] != "vacio") {
		$resumen .= '<div style="margin-top: 0.5em;">';
		$resumen .= '[icono tipo="pulgar_abajo"]' . $a['malo'];
		$resumen .= '</div>';	
	}	
	
	$resultado .= '[caja]' . $contenido . '[/caja]';
	$resultado .= '[caja color="blanco" centrado="si" borde="azul_claro"]' . $resumen . '[/caja]';
	
	return do_shortcode($resultado);
	
}


// LUGAR TOP
add_shortcode( 'top', 'shortcode_top' );
function shortcode_top ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'color' => 'vacio',
		    'titulo' => 'vacio',
		    'subtitulo' => 'vacio',
		    'texto' => 'vacio',			
	        ), $atts );

	$color 		= $a['color'];
	$titulo 	= $a['titulo'];
	$subtitulo 	= $a['subtitulo'];
	$texto 		= $a['texto'];

	//$contenido .= '<h3 style="margin-top:0px; font-size:1.10rem;">' . "&#x1F64C;  $titulo  &#x1F64C;" . '</h3>';

	$contenido .= '<h4 class="alert-heading" style="margin-top:0px; margin-bottom:0.5em; font-weight:bold; text-align:center;">';
	$contenido .= "&#x1F64C;  $titulo  &#x1F64C;";
	$contenido .= '</h4>';

	
	if ($subtitulo != "vacio") {
	    $contenido .= '<p style="font-weight:bold; margin-bottom:0.5em;">'.$subtitulo.'</p>';
	    //$contenido .= '<hr>';
	}
//	$contenido .= '<div style="margin-top: 0.5em;">';
    $contenido .= '<p class="mb-0">';	
	$contenido .= $texto;
    $contenido .= '</p>';	

//	$contenido .= '</div>';
//	$contenido .= '<div style="margin-top: 0.5em;">';
    $contenido .= '<p style="margin-top: 0.5em;">';	
	$contenido .= "&#x1F51D; &#x1F51D; &#x1F51D;"; 
	$contenido .= '</p>';
	
	$resultado = '[caja color="rojo" centrado="si"]' . do_shortcode($contenido) . '[/caja]';
	
	return do_shortcode($resultado);
	
}


// LUGAR PENDIENTE
add_shortcode( 'pendiente', 'shortcode_pendiente' );
function shortcode_pendiente ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'color' => 'vacio',
		    'titulo' => 'vacio',
		    'subtitulo' => 'vacio',
		    'texto' => 'vacio',			
	        ), $atts );

	$color 		= $a['color'];
	$titulo 	= $a['titulo'];
	$subtitulo 	= $a['subtitulo'];
	$texto 		= $a['texto'];

    // verde_claro está chulo
	$resultado .= '[caja color="verde"]';
	$resultado .= '<h4 class="alert-heading" style="margin-top:0px; font-weight:bold; text-align:center;">';
	$resultado .= '[icono tipo="idea"]' . "LUGAR PENDIENTE" ;
	if (es_movil()) $resultado .= '[icono tipo="idea"]' . '<br>';
	$resultado .= '[icono tipo="idea"]' . "RUTA ALTERNATIVA" . '[icono tipo="idea"]';
	$resultado .= '</h4>';
	$resultado .= '<p class="mb-0">' . $content . '</p>';
	$resultado .= '[/caja]';
	
	return do_shortcode($resultado);
	
}


/*
// VISITAS
add_shortcode( 'visitas', 'shortcode_visitas' );
function shortcode_visitas ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'dia' => 'vacio',
		    'texto' => 'vacio',
		    'resumen' => 'vacio',
	        ), $atts );

	$dia 		= $a['dia'];
	$texto 		= $a['texto'];
	$resumen 	= $a['resumen'];

	$contenido .= '[icono tipo="reloj"]' . $dia . '<br>';
	$contenido .= 
	$contenido .= '<h3 style="margin-top:0px; font-size:1.10rem;">' . "&#x1F64C;  $titulo  &#x1F64C;" . '</h3>';
	$contenido .= "<strong>$subtitulo</strong>";
	$contenido .= '<div style="margin-top: 0.5em;">';
	$contenido .= $texto;
	$contenido .= '</div>';
	$contenido .= '<div style="margin-top: 0.5em;">';
	$contenido .= "&#x1F51D; &#x1F51D; &#x1F51D;"; 
	$contenido .= '</div>';
	
	$resultado = '[caja color="rojo" centrado="si" borde="negro"]' . do_shortcode($contenido) . '[/caja]';
	
	return do_shortcode($resultado);
	
}
*/

//  BOTON Y POPUP
//	https://getbootstrap.com/docs/4.1/components/buttons/
add_shortcode( 'boton', 'boton_shortcode' );
function boton_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'url' => 'vacio',
		'texto' => 'vacio',
		'color' => 'vacio',
		'contorno' => 'vacio',
		'centrado' => 'vacio',
		'titulo' => 'vacio',
		'medida' => 'vacio',
        'ancho_completo' => 'vacio',
        
		'popup' => 'vacio',
		'popup_titulo' => 'vacio',
		'popup_contenido_id' => 'vacio',
		'popup_contenido_url' => 'vacio',
		'popup_contenido_tipo' => 'vacio',
		'popup_contenido' => 'vacio',
		'popup_url' => 'vacio',
		'popup_texto' => 'vacio',
		'popup_medida' => 'vacio',
	), $atts );


    // BOTON

	$url = $color = $texto = $tamano = $centrado = $contorno = $popup = $ancho = "";

	$url = $a['url']; 
	//if ($url == 'vacio') return;
	
	$texto = $a['texto'];
	if ($texto == 'vacio') return;



	// $icono = $a['icono'];
	
	if ($a['contorno'] == "si") $contorno = "-outline"; 
	
	if ($a['ancho_completo'] == "si") $ancho = " btn-block"; 

    $color = colores_bootstrap($a['color']);
		
	switch ($a['medida']) {
    	case "pequeño":
       		$medida = "btn-sm";
        	break;
    	case "mediano":
       		$medida = "btn-md";
        	break;
    	case "grande":
       		$medida = "btn-lg";
        	break;
    	case "muy_grande":
            $medida = "btn-xl";
        	break;
        default:
       		$medida = "btn-md";
        	break;	
	}	

	//$popup = ($a['popup'] == "si") ? " modal-link" : "";

	$boton = "btn" . " " . "btn" . $contorno . $color . $ancho . " " . $medida;
	$boton_popup = "btn" . " " . "btn" . $contorno . $color . $ancho . " btn-md";
	
	// . $popup " text-xs-center center-block text-center"
		


    // BOTON
    if ($a['popup'] != "si") {
	    
	    $centrado = $a['centrado'];
        if ($centrado == "si") $resultado .= '<div style="text-align: center;">';
	    else $resultado .= '<div>';
	
//	    $resultado .= '<button class="'.$boton.'" href="'.$url.'">'.$texto.'</button>';	

        $resultado .= '<a href="'.$url.'" >';
	    $resultado .= '<button type="button" class="'.$boton.'">'.$texto.'</button>';	
        $resultado .= '</a>';

	    $resultado .= '</div>';
	
	    return $resultado;
    }


	
	// POPUP
    if ($a['popup'] == "si") {
        
        $medida_popup = "";
        
        $rand = rand();

        $texto_ir = ($a['popup_texto'] == "vacio") ? "Más Información" : $a['popup_texto'];
	
	    $contenido = $a['popup_contenido']; 
	
	    if ($contenido == "vacio") { // Si $contenido está lleno ya me vale $contenido, si no busco contenido por id

            if ($a['popup_contenido_id'] != "vacio") $contenido = do_shortcode('[obtener_post id="'.$a['popup_contenido_id'].'"]');
            else {
        
    	        $contenido_url = $a['popup_contenido_url']; 
                $contenido_tipo = ($a['popup_contenido_tipo'] == "vacio") ? "page" : $a['popup_contenido_tipo'];

              //  if ($a['popup_contenido_url'] != "vacio") $contenido = do_shortcode('[content name="'.$a['popup_contenido_url'].'"]');
                //else return; // No hay contenido ni en contenido, ni por id ni por url...               
                
                if ($a['popup_contenido_url'] != "vacio") $contenido = do_shortcode('[obtener_post url="'.$a['popup_contenido_url'].'" tipo="'.$contenido_tipo.'"]');
                else return; // No hay contenido ni en contenido, ni por id ni por url...
            }
	    }
	    
	    switch ($a['popup_medida']) {
    	    case "pequeño":
       		    $medida_popup = "modal-sm";
        	    break;
    	    case "mediano":
       		    $medida_popup = "modal-md";
        	    break;
    	    case "grande":
       		    $medida_popup = "modal-lg";
        	    break;
    	    case "muy_grande":
        		$medida_popup = "modal-xl";
        	    break;
	    }
	    
	    if (empty($medida_popup)) {
            
            $longitud = strlen($contenido);
                
            switch (true) {
    	        case $longitud < 300:
       		        $medida_popup = "modal-sm";
        	        break;
    	        case ( $longitud > 300 and $longitud < 1000 ):
       		        $medida_popup = "modal-md";
        	        break;
    	        case ( $longitud > 1000 and $longitud < 2000 ):
       		        $medida_popup = "modal-lg";
        	        break;
    	        case ( $longitud > 2000 ):
        		    $medida_popup = "modal-xl";
        	        break;
	        }
        }

        if ($a['centrado'] == "si") $resultado .= '<div style="text-align: center;">';
        $resultado .= '<button type="button" class="'.$boton.'" data-toggle="modal" data-target="#exampleModal'.$rand.'">';
        $resultado .= $a['texto'];
        $resultado .= '</button>';
        if ($a['centrado'] == "si") $resultado .= '</div>';
		else $resultado .= ""; //'<br>';

        $resultado .= '<div class="modal fade" id="exampleModal'.$rand.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        $resultado .= '<div class="modal-dialog modal-full-height modal-right '.$medida_popup.'" role="document">';
        // modal-dialog-centered modal-dialog-scrollable
        $resultado .= '<div class="modal-content">';
        
        if ($a['popup_titulo'] != "vacio") {
            $resultado .= '<div class="modal-header">';
            $resultado .= '<h5 class="modal-title" id="exampleModalLabel">' . $a['popup_titulo'] . '</h5>';
            $resultado .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $resultado .= '<span aria-hidden="true">&times;</span>';
            $resultado .= '</button>';
            $resultado .= '</div>';
        }    
        
        $resultado .= '<div class="modal-body">';
        $resultado .= $contenido;
        // "MEDIDA: $longitud . $medida_popup" .
        $resultado .= '</div>';
        
        $resultado .= '<div class="modal-footer">';
        $resultado .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
        if ($a['url'] != "vacio") {
         // $resultado .= '<button type="button" class="btn btn-primary">Save changes</button>';
        $resultado .= '<a href="'.$a['url'].'" >';
	    $resultado .= '<button type="button" class="'.$boton_popup.'">'.$texto_ir.'</button>';		  $resultado .= '</a>';
        }    
        $resultado .= '</div>';
        
        $resultado .= '</div>';
        $resultado .= '</div>';
        $resultado .= '</div>';

	    return $resultado;

        } // FIN POPUP

}

//        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>

// BOOTSTRAP PROS
// https://getbootstrap.com/docs/4.4/components/card/
add_shortcode( 'pros', 'pros_shortcode' );
function pros_shortcode( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'fecha' => 'vacio',
	        ), $atts );


	$titulo = ($a['titulo'] == "vacio") ? "Pros" : $a['titulo']; 

    $resultado .= '<div class="card">';
    $resultado .= '<div class="card-header" style="background-color:#3be863; color:#FFFFFF; font-weight:bold">'. $titulo . '</div>';
    $resultado .= '<div class="card-body">';
    //$resultado .= '<h5 class="card-title">Special title treatment</h5>';
    $resultado .= '<p class="card-text">' . $content . '</p>';
    //$resultado .= '<a href="#" class="btn btn-primary">Go somewhere</a>';
    $resultado .= '</div>';
    $resultado .= '</div>';

	// $resultado .= '[su_box title="'.$titulo.'" style="default" box_color="#3be863" title_color="#FFFFFF" radius="3"]';

	return do_shortcode(wpautop($resultado));
}


// BOOTSTRAP CONTRAS
add_shortcode( 'contras', 'contras_shortcode' );	
function contras_shortcode( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'fecha' => 'vacio',
	        ), $atts );
	

	$titulo = ($a['titulo'] == "vacio") ? "Contras" : $a['titulo']; 

    $resultado .= '<div class="card">';
    $resultado .= '<div class="card-header" style="background-color:#F73F43; color:#FFFFFF; font-weight:bold">'. $titulo . '</div>';
    $resultado .= '<div class="card-body">';
    //$resultado .= '<h5 class="card-title">Special title treatment</h5>';
    $resultado .= '<p class="card-text">' . $content . '</p>';
    //$resultado .= '<a href="#" class="btn btn-primary">Go somewhere</a>';
    $resultado .= '</div>';
    $resultado .= '</div>';
		
	return do_shortcode(wpautop($resultado));
}


// ACORDEON INDIVIDUAL
// https://getbootstrap.com/docs/4.4/components/collapse
add_shortcode( 'acordeon', 'acordeon_shortcode' );
function acordeon_shortcode( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'abierto' => 'vacio',
		    'ancho_completo' => 'vacio',

	        ), $atts );

    $resultado = "";
    $rand = rand();

    $titulo = $a['titulo'];
    $abierto = $a['abierto'];

    if ($titulo=='vacio') $titulo="";; 

    if ($a['ancho_completo'] == "si") $ancho = " btn-block"; 
    if ($a['abierto'] == "si") $abierto = "true";
    else $abierto = "false";

$resultado .= '<p>';
//   $resultado .= '<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">';
//   $resultado .= $titulo;
//   $resultado .= '</a>';
  $resultado .= '<button class="btn btn-primary'.$ancho.'" . " type="button" data-toggle="collapse" data-target="#collapseExample'.$rand.'" aria-controls="collapseExample'.$rand.'" aria-expanded="true">';
  $resultado .= $titulo;
  $resultado .= '</button>';
$resultado .= '</p>';

$resultado .= '<div class="collapse" id="collapseExample'.$rand.'">';
  $resultado .= '<div class="card card-body">';
    $resultado .= $content;
  $resultado .= '</div>';
$resultado .= '</div>';

return do_shortcode($resultado);
}


// CARD
add_shortcode( 'card', 'card_shortcode' );
function card_shortcode( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'abierto' => 'vacio',
	        ), $atts );

$resultado = "";
$rand = rand();

$titulo = $a['titulo'];
$abierto = $a['abierto'];

if ($titulo=='vacio') $titulo="";; 

$resultado .= '<p>';
//   $resultado .= '<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">';
//   $resultado .= $titulo;
//   $resultado .= '</a>';
  $resultado .= '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample'.$rand.'" aria-expanded="false" aria-controls="collapseExample'.$rand.'">';
  $resultado .= $titulo;
  $resultado .= '</button>';
$resultado .= '</p>';

$resultado .= '<div class="collapse" id="collapseExample'.$rand.'">';
  $resultado .= '<div class="card card-body">';
    $resultado .= $content;
  $resultado .= '</div>';
$resultado .= '</div>';



$resultado = '<section id="what-we-do">';
$resultado .= '<div class="container-fluid">';
$resultado .= '<div class="card">';
$resultado .= '<div class="card-block block-4">';
$resultado .= '<h3 class="card-title">Special title</h3>';
$resultado .= '<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>';
$resultado .= '<a class="read-more" title="Leer más">Read more<i class="fa fa-angle-double-right ml-2"></i></a>';

$resultado .= '</div>';
$resultado .= '</div>';
$resultado .= '</div>';
$resultado .= '</section>';

return do_shortcode($resultado);
}






// COLUMNAS BOOTSTRAP
// https://getbootstrap.com/docs/4.4/layout/grid/
// [col numero="1" total="2"] op: ancho="8"
/*
row align-items-start
row align-items-center
row align-items-end

*/
add_shortcode( 'col', 'col_shortcode' );
function col_shortcode( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'numero' 	=> 'vacio',
		    'total' 	=> 'vacio',
		    'ancho' 	=> 'vacio',
		    'centrado' 	=> 'vacio',
		    'fondo' 	=> 'vacio',
		    'posicion' 	=> 'vacio',
	        ), $atts );

	switch ($a['posicion']) {
    	case "arriba":  $posicion =  " align-items-start";  break;
    	case "medio":   $posicion =  " align-items-center"; break;
    	case "abajo":   $posicion =  " align-items-end";    break;
		default:        $posicion =  " align-items-center"; break;
	}
	
    $numero = $a['numero'];
    $total  = $a['total'];
    $ancho  = $a['ancho'];
    $centrado  = $a['centrado'];
    
    $ancho      = ($ancho == "vacio") ? "" : "-" . $ancho;
    $centrado   = ($centrado == "vacio") ? "" :  " text-align:center;";
    $fondo      = ($fondo == "vacio") ? "" :  "background:'.$color.';";

    $div = '<div class="col-md'.$ancho.'" style="'.$centrado.'">';
    
    if ($numero == 1)  {
        $resultado = '<div class="container style="'.$centrado.'">';
        $resultado .= '<div class="row'.$posicion.'">';
        $resultado .= $div. $content .'</div>';
    }    

    if ( ($numero > 1) and ($numero < $total) )  {
        $resultado .= $div . $content .'</div>';
    } 
 
    if ($numero == $total)  {
        $resultado .= $div . $content .'</div>';
        $resultado .= '</div>';
        $resultado .= '</div>';
    }    

    return do_shortcode(wpautop($resultado));
}


//montar_tabla($array_listado , $td_estilo , $a_estilo)
function montar_tabla($array_tabla, $color_texto) {

    $resultado = "";
    $existe_tabla = false;
    $ncolumna = 1;

    // TÍTULO - ( SLUG - NOMBRE ) ETC.
    $color_texto = colores($color_texto);
    $color_texto = " color:$color_texto;";
    $margen = " margin-top:5px;";
    
    for ($i=0; $i<count($array_tabla); $i++) {   // CUENTO NUMERO DE COLUMNAS AQUÍ
        
        $existe_tabla = true;
        
        $nlistado = ( count($array_tabla[$i]) - 1 ); // Le resto el título 

        $resultado .= '[col numero="'.$ncolumna.'" total="'.count($array_tabla).'" centrado="si" posicion="arriba"]';

        $resultado .= '<div style="font-weight:bold; margin-bottom:5px; margin-top:10px;">' . $array_tabla[$i][0] . '</div>'; // Titulo
        
        for ($k=1; $k<$nlistado; $k+=2) {
		    $resultado .= '<div style="'.$margen.'"><a href="'.$array_tabla[$i][$k].'" style="'.$color_texto.'">'.$array_tabla[$i][$k+1].'</a></div>';
        }        

        $resultado .= '[/col]'; 
        $ncolumna++;
    
    } 
    
	if ($existe_tabla) return $resultado;
	else return "No hay ninguna Tabla para mostrar.";
}


