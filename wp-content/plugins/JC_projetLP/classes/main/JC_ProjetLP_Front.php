<?php

class JC_ProjetLP_Front {

    public function __construct() {

        add_action( "wp_enqueue_scripts", array( $this, "enqueue_scripts" ) );


    }

    public function enqueue_scripts() {

        wp_enqueue_script( 'JC_ProjetLP_Front', plugins_url( '../assets/JS/JC_ProjetLP_Front.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_style( 'JC_ProjetLP_Front', plugins_url( '../assets/CSS/JC_ProjetLP_Front.css', dirname( __FILE__ ) ), array(), '1.0.0', 'all' );
        wp_enqueue_script( 'handlebars', 'https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js', array(), '4.7.6', true );

        wp_localize_script( 'JC_ProjetLP_Front', 'JC_ProjetLP_Front', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'ajax_nonce_security' )
        ) );

    }

}