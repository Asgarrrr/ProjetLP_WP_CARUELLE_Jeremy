<?php

/*
Plugin Name: ProjetLP
Plugin URI: https://site-du-plugin.fr/
Description: Ce plugin WordPress sert à rien
Author: CARUELLE Jérémy
Author URI: jeremycaruelle.fr
Version: 1.0
*/

if ( !defined( "ABSPATH" ) )
    exit;

define( "PROJETLP_VERSION", "1.0.0" );
define( "PROJETLP_FILE", __FILE__ );
define( "PROJETLP_DIR", dirname( PROJETLP_FILE ) );
define( "PROJETLP_BASENAME", pathinfo( ( PROJETLP_FILE ) )['filename'] );
define( "PROJETLP_PLUGIN_NAME", PROJETLP_BASENAME );

// Autoload classes
foreach ( glob( PROJETLP_DIR ."/classes/*/*.php" ) as $filename )
    if ( !preg_match( "/export|cron/i", $filename ) )
        if ( !@require_once $filename )
            throw new Exception( sprintf( __( "Failed to include %s" ), $filename ) );


// Activation hook
register_activation_hook( PROJETLP_FILE, function() {
    $ProjetLP_Install = new ProjetLP_Install();
    $ProjetLP_Install->setup();
});

if ( is_admin() )
    new ProjetLP_Admin();
else
    new ProjetLP_Front();