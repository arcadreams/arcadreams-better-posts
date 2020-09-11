<?php
/*
Plugin Name: Arca Dreams Better Posts
Plugin URI: https://arcadreams.com
GitHub Plugin URI: https://github.com/arcadreams/arcadreams-better-posts
Description: Publicaciones mejoradas mediante Shortcodes sencillos para usar en tus Posts.
Version: 1.0.2
Author: Arca Dreams
Author URI: https://arcadreams.com
License: LicenciaGPL
Text domain: arcadreams-better-posts
*/


// ==============================================
//  Prevent Direct Access of this file
// ==============================================

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if this file is accessed directly



require_once plugin_dir_path(__FILE__) . 'includes/mfp-functions.php';

function activate_my_plugin() {
    // Lo que quiero que haga el plugin cuando un usuario lo activa
}
register_activation_hook( __FILE__, 'activate_my_plugin' );

function deactivate_my_plugin() {
    // Lo que quiero que haga el plugin cuando un usuario lo desactiva
}
register_deactivation_hook( __FILE__, 'deactivate_my_plugin' );
