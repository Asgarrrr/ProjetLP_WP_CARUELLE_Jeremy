<?php

add_action( "wp_ajax_JC_ProjetLP_majorOnly", array( "JC_ProjetLP_Actions", "set_countryMajorOnly" ));
add_action( "wp_ajax_JC_ProjetLP_notation", array( "JC_ProjetLP_Actions", "set_countryNotation" ));
add_action( "wp_ajax_JC_ProjetLP_enabled", array( "JC_ProjetLP_Actions", "set_countryEnabled" ));

add_action( "wp_ajax_nopriv_JC_ProjetLP_validate", array( "JC_ProjetLP_Actions", "save_validate" ));
add_action( "wp_ajax_JC_ProjetLP_validate", array( "JC_ProjetLP_Actions", "save_validate" ));

class JC_ProjetLP_Actions {

    public function __construct() {

    }

    public static function set_countryMajorOnly() {

        // Check if the user is allowed to do this action
        $nonce = $_POST[ "nonce" ];

        if ( !wp_verify_nonce( $nonce, "JC_ProjetLP_Admin" ) )
            die( 'Security check' );

        // Get the country ID
        $countryID = $_POST['countryID'];

        // Get the country majorOnly value
        $crud = new JC_ProjetLP_crud();
        $majorOnly = $crud->set_countryMajorOnly( $countryID );

    }

    public static function set_countryNotation() {

        // Check if the user is allowed to do this action
        $nonce = $_POST[ "nonce" ];

        if ( !wp_verify_nonce( $nonce, "JC_ProjetLP_Admin" ) )
            die( 'Security check' );

        // Get the country ID
        $countryID = $_POST['countryID'];
        // Get the country notation value
        $notation = $_POST['notation'];

        $crud = new JC_ProjetLP_crud();
        $crud->set_countryNotation( $countryID, $notation );


    }

    public static function set_countryEnabled() {

        // Check if the user is allowed to do this action
        $nonce = $_POST[ "nonce" ];

        if ( !wp_verify_nonce( $nonce, "JC_ProjetLP_Admin" ) )
            die( 'Security check' );

        // Get the country ID
        $countryID = $_POST['countryID'];
        // CountryID is a array of countries ID, each country ID must be enabled, and each country not in the array must be disabled

        $crud = new JC_ProjetLP_crud();
        $crud->set_countryEnabled( $countryID );

    }

    public static function save_validate() {

        check_ajax_referer( 'ajax_nonce_security', 'nonce' );

        echo "<script id=\"scriptModal\" type=\"text/x-handlebars-template\" src=\"".plugins_url( PROJETLP_PLUGIN_NAME."/assets/js/handlebar/JC_ProjetLP_ConfirmModal.hbs")."\"></script>";
        exit;
        // $crud = new JC_ProjetLP_crud();
        // $crud->save_validate();


    }

}