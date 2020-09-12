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

if ( ! function_exists( 'abp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function abp_fs() {
        global $abp_fs;

        if ( ! isset( $abp_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $abp_fs = fs_dynamic_init( array(
                'id'                  => '6882',
                'slug'                => 'arcadreams-better-posts',
                'type'                => 'plugin',
                'public_key'          => 'pk_fb4d42347ba90614148b121df1151',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'arcadreams-better-posts',
                    'account'        => false,
                    'support'        => false,
                    'parent'         => array(
                        'slug' => 'tools.php',
                    ),
                ),
            ) );
        }

        return $abp_fs;
    }

    // Init Freemius.
    abp_fs();
    // Signal that SDK was initiated.
    do_action( 'abp_fs_loaded' );
}

defined('ABSPATH') or die("Por aquí no vamos a ninguna parte");
define('ADBP_DIR',plugin_dir_path(__FILE__));

require_once plugin_dir_path(__FILE__) . 'shortcodes/better-posts-bootstrap.php';
require_once plugin_dir_path(__FILE__) . 'shortcodes/better-posts-colores.php';
require_once plugin_dir_path(__FILE__) . 'shortcodes/better-posts-propios.php';
require_once plugin_dir_path(__FILE__) . 'shortcodes/better-posts-terceros.php';




function activate_my_plugin() {
    // Lo que quiero que haga el plugin cuando un usuario lo activa
}
register_activation_hook( __FILE__, 'activate_my_plugin' );

function deactivate_my_plugin() {
    // Lo que quiero que haga el plugin cuando un usuario lo desactiva
}
register_deactivation_hook( __FILE__, 'deactivate_my_plugin' );


// add_action( 'admin_menu', 'rjc_menu_administrador' );
function rjc_menu_administrador() {
add_submenu_page('tools.php','Gestión de Roles','Arca Dreams BETTER POSTS','administrator',ADBP_DIR.'/admin/gestionar.php');
}