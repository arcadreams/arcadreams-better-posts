<?php
/*
Plugin Name: Arca Dreams Better Posts
Plugin URI: https://arcadreams.com
Description: Publicaciones mejoradas mediante Shortcodes sencillos para usar en tus Posts.
Version: 1.0.0
Author: Arca Dreams
Author URI: https://arcadreams.com
License: LicenciaGPL
Text domain: arcadreams-better-posts
*/



function activate_my_plugin() {
    // Lo que quiero que haga el plugin cuando un usuario lo activa
}
register_activation_hook( __FILE__, 'activate_my_plugin' );

function deactivate_my_plugin() {
    // Lo que quiero que haga el plugin cuando un usuario lo desactiva
}
register_deactivation_hook( __FILE__, 'deactivate_my_plugin' );
