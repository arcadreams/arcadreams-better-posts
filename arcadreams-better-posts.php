<?php
/*
Plugin Name: Arca Dreams Better Posts
Plugin URI: https://arcadreams.com
GitHub Plugin URI: https://github.com/arcadreams/arcadreams-better-posts
Description: Publicaciones mejoradas mediante Shortcodes sencillos para usar en tus Posts.
Version: 1.0.6
Author: Arca Dreams
Author URI: https://arcadreams.com
License: LicenciaGPL
Text domain: arcadreams-better-posts
*/

if ( ! function_exists( 'ad_bp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function ad_bp_fs() {
        global $ad_bp_fs;

        if ( ! isset( $ad_bp_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $ad_bp_fs = fs_dynamic_init( array(
                'id'                  => '6882',
                'slug'                => 'arcadreams-better-posts',
                'type'                => 'plugin',
                'public_key'          => 'pk_fb4d42347ba90614148b121df1151',
                'is_premium'          => true,
                'premium_suffix'      => 'Better Posts Pro',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'first-path'     => 'plugins.php',
                    'support'        => false,
                ),
                // Set the SDK to work in a sandbox mode (for development & testing).
                // IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
                'secret_key'          => 'sk_Yd_-ZvEBm&PX8yYUpyT2dqsr9=Vt!',
            ) );
        }

        return $ad_bp_fs;
    }

    // Init Freemius.
    ad_bp_fs();
    // Signal that SDK was initiated.
    do_action( 'ad_bp_fs_loaded' );
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