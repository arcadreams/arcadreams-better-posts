<?php


// https://es.wordpress.org/plugins/iframe/
add_shortcode( 'codigos', 'info_post_shortcodes' );
function info_post_shortcodes() {

// if (!function_exists('espacios_blanco')) return;
// if (!function_exists('mb_obtener_valor')) return;
    $iframe = $resultado = "";
    
    plugin_activo('iframe');

	$iframe .= do_shortcode('[iframe src="https://arcadreams.com/codigos" id="content-wrapper"]');

	$resultado = do_shortcode('[acordeon titulo="Listado de códigos"]'.$iframe.'[/acordeon]');

    return $resultado;
}


// ********** INDICE
// PLUGIN: https://wordpress.org/plugins/shortcode-toc/
/*
			'content'      => null,
			'headers'      => 'h1, h2, h3, h4, h5, h6', // headers that you wish to target
			'speed'        => 200, // speed of sliding back to top
			'anchor-class' => 'anchor', // class of anchor links
			'anchor-text'  => '', // prepended or appended to anchor headings
			'top_class'    => '.top', // back to top button or link class
			'spy'          => false, // scroll spy
			'position'     => 'append', // position of anchor text
			'spy-offset'   => 0 // specify heading offset for spy scrolling
*/			
add_shortcode( 'indice', 'shortcode_indice' );
function shortcode_indice ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'color' => 'vacio',
		    'par2' => 'vacio',
	        ), $atts );

	plugin_activo('toc');
	
//	return do_shortcode('[toc content=".entry-content" headers="h1" top_class="Arriba" spy="yes"]');
	// return do_shortcode('[toc content=".entry-content" headers="h1,h2,h3" position="append" top_class="Arriba" spy="yes"]');

	return "<br>" . do_shortcode('[toc content=".entry-content" headers="h1,h2,h3" top_class="Arriba" spy="yes"]');	
}


// ********** COLUMNAS
// https://es.wordpress.org/plugins/lightweight-grid-columns/
// [col numero="1" total="2"]
// [lgc_column grid=”25″ tablet_grid=”50″ mobile_grid=”100″ style=”padding-left:0px;”]Some content[/lgc_column]
//add_shortcode( 'col', 'col_shortcode2' );
function col_shortcode2( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'numero' 	=> 'vacio',
		    'total' 	=> 'vacio',
		    'centrado' 	=> 'vacio',
		    'ancho_movil' 	=> 'vacio',
	        ), $atts );

	plugin_activo('lightweight');
    
    $resultado = "";

	if (!function_exists('es_movil')) return;	
	
    $numero = $a['numero'];
    $total = $a['total'];
    $ultima = ($numero == $total) ? true : false;
	$penultima = ( $numero == ($total-1) ) ? true : false;
	$style = "";
	$ancho_mv = ($a['ancho_movil'] == "vacio") ? $ancho_mv = "100" : $ancho_mv = $a['ancho_movil']; 
	
   	switch ($total) {
    	case "2": $ancho_pc = "50"; $ancho_tablet = "50"; $ancho_movil=$ancho_mv;  break;
    	case "3": $ancho_pc = "33"; $ancho_tablet = "33"; $ancho_movil=$ancho_mv;  break;
    	case "4": $ancho_pc = "25"; $ancho_tablet = "50"; $ancho_movil=$ancho_mv;  break;
    	case "5": $ancho_pc = "20"; $ancho_tablet = "50"; $ancho_movil=$ancho_mv;  break;
    	case "6": $ancho_pc = "16"; $ancho_tablet = "50"; $ancho_movil=$ancho_mv;  break;
	    default:  $ancho_pc = "33"; $ancho_tablet = "33"; $ancho_movil=$ancho_mv;  break;
	}

	$align = "";
	if ($a['centrado'] == "si") $align = " text-align: center;";
	
    $padding = " padding-left:0px; padding-right:30px;";
    
	if ($ultima) {
        $ultima = ' last="true"';
        $padding = " padding-left:15px; padding-right:0px;";
    }
	if ($penultima) {
	    $padding = " padding-left:0px; padding-right:15px;";
	}

	if (!es_movil()) $style = "margin-bottom: 0em; padding-bottom:25px;" . $padding;

	$style .= $align;
	
    $resultado .= '[lgc_column style="'.$style.'" grid="'.$ancho_pc.'" tablet_grid="'.$ancho_tablet.'" mobile_grid="'.$ancho_movil.'"'.$ultima.']';
//    $resultado .= $content . "[".$resultado."]";
    $resultado .= $content;
    $resultado .= '[/lgc_column]';

return do_shortcode($resultado);
}


// ********** FORMULARIO CONTACTO
// PLUGIN https://es.wordpress.org/plugins/very-simple-contact-form
add_shortcode( 'contacto', 'shortcode_contacto' );
function shortcode_contacto ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'email' => 'vacio',
		    'par2' => 'vacio',
	        ), $atts );

	plugin_activo('contact');
	
	if ($a['email'] == "vacio") $email = "sergioromerponce@hotmail.com";
	else $email = $a['email'];

	return do_shortcode('[contact email_to="'.$email.'" hide_subject="true" hide_captcha="true"]');	
}

// ********** GALLERY
// PLUGIN https://es.wordpress.org/plugins/justified-gallery
/*
// PLUGIN https://wordpress.org/plugins/responsive-gallery-grid/
// https://responsive-gallery-grid.bdwm.be/shortcode-parameters/
// https://responsive-gallery-grid.bdwm.be/shortcode-generator
ME DA ERROR CON LOS TABS TABBY, ME DESAPARECEN LAS IMÁGENES
*/
add_shortcode( 'galeria', 'shortcode_galeria' );
function shortcode_galeria ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'ids' => 'vacio',
		    'alto' => 'vacio',
	        ), $atts );

$alto = "";

    if (!empty($a['alto'])) {
    
    switch ($a['alto']) {
    	case "xl":
    	case "XL": 
            $alto = 360; break;
    	case "m":
    	case "M": 
            $alto = 260; break;
    	case "s":
    	case "S": 
    	    $alto = 160; break;
		default:
		    $alto = 260;
    }
    
    $altura = ' rowheight="'.$alto.'"';
    }

	// plugin_activo('contact');
	return do_shortcode('[gallery ids="'.$a['ids'].'"'.$altura.']');
	
	// return do_shortcode('[gallery ids="'.$a['ids'].'" lastrowbehavior="center" margin="2" scale="1.1" maxrowheight="200" rowspan="0" intime="100" outtime="100" captions="overlay-hover-show" linked_image_size="full" orderby="menu_order" link="file" size="medium" lightbox="swipebox" effect="bubble" lastrowbehavior="last_row_same_height" captions_effect="slide_up" captions_intime="200" captions_outtime="200"]');
}



/**************************************************************************
 * 
 * 							  FIN OTROS SHORTCODES
 * 
 * ************************************************************************/



/**************************************************************************
 * 
 * 								   TABS
 * 
 * ************************************************************************/
// https://es.wordpress.org/plugins/tabby-responsive-tabs/

add_shortcode( 'tab', 'shortcode_tab' );
function shortcode_tab ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'icono' => 'vacio',
	        ), $atts );

	plugin_activo('tabby');
	if ($a['icono'] != "vacio") {
		$value = obtener_icono($a['icono']);
		$icono = ' icon="' . $value['icono'] . '"';
	}
	$resultado = '[tabby title="'.$a['titulo'].'"'.$icono .']';
    return do_shortcode($resultado);
}

add_shortcode( 'fin_tab', 'shortcode_fin_tab' );
function shortcode_fin_tab ( $atts, $content = null ) {
        $a = shortcode_atts( array(
		    'titulo' => 'vacio',
		    'par2' => 'vacio',
	        ), $atts );
	
    return do_shortcode('[tabbyending]');
}


function montar_tab($array_tab) {

    // CONTENIDO TITULO ICONO
	if (function_exists('debug')) {
    if (debug()) {
    echo "CONTENIDO TITULO ICONO"."<br>";
    echo "0-0 " . $array_tab[0][0]."  ".$array_tab[0][1]."  ".$array_tab[0][2]."<br>";
    echo "1-0 " . $array_tab[1][0]."  ".$array_tab[1][1]."  ".$array_tab[1][2]."<br>";
    echo "2-0 " . $array_tab[2][0]."  ".$array_tab[2][1]."  ".$array_tab[2][2]."<br><br>";
    
    
    echo " Count array total: " . count($array_tab) ."<br>";
    echo " Count array 0: " . count($array_tab[0]) ."<br>";
    echo " Count array 1: " . count($array_tab[1]) ."<br>";
    }
	}
	
    $existe_tab = false;
    
    if(!empty($array_tab)) {
    
    for($r=0;$r<count($array_tab);$r++) {
	//echo "For: " . $r . '<br>';
        if (!empty($array_tab[$r][0])) {    // SIN CONTENIDO NO HAY TAB
		//echo "Hay contenido: " . $array_tab[$r][0] . '<br>';             
            if (!empty($array_tab[$r][1])) {    // SIN TITULO NO HAY TAB
			   	//echo "Hay titulo: " . $array_tab[$r][1] . '<br>'; 
				$existe_tab = true;
                if (!empty($array_tab[$r][2])) {    // ICONO
					if (!function_exists('obtener_icono')) return;	
					$icono = obtener_icono($array_tab[$r][2]);
					$icono = ' icon="' . $icono['icono'] . '"';
		$resultado .= '[tabby title="'.$array_tab[$r][1].'"'.$icono.']'.$array_tab[$r][0];   
		$resultado .= '<br>';
					//echo "[".$resultado."]";
				}        
                else {

                    $resultado .= '[tabby title="'.$array_tab[$r][1].'"]'.$array_tab[$r][0];
               }
            }
        }
        
    }   // FIN FOR
	if ($existe_tab) $resultado .= '[tabbyending]';
	
    }
	else return "No hay ningún Tab para mostrar.";
   
	if (function_exists('debug')) {
   
    if (debug()) {
    $tab_inicio = '[su_tabs style="modern-orange" active="1"]';
    $tab_fin = '[/su_tabs]';
    
    $resultado1 .= $tab_inicio;
 
    for($r=0;$r<count($array_tab);$r++) {
        if (!empty($array_tab[$r][0])) {    // SIN CONTENIDO NO HAY TAB
            if (!empty($array_tab[$r][1])) {    // SIN TITULO NO HAY TAB
                if (!empty($array_tab[$r][2])) {    // SIN ICONO
                    $resultado1 .= '[su_tab title="'.$array_tab[$r][1].'" disabled="no" anchor="" url="" target="blank" class=""]'.$array_tab[$r][0].'[/su_tab]';
                }        
                else {
                    $resultado1 .= '[su_tab title="'.$array_tab[$r][1].'" disabled="no" anchor="" url="" target="blank" class=""]'.$array_tab[$r][0].'[/su_tab]';
                }
            }
        }
        
    }   // FIN FOR
    
    $resultado .= $tab_fin;
    }
		} // Fin si no existe la funcion debug
	
	
  return do_shortcode($resultado);
}


/**************************************************************************
 * 
 * 								   TABS
 * 
 * ************************************************************************/



