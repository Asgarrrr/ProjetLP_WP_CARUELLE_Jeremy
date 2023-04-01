<?php

class JC_ProjetLP_Admin {

    public function __construct() {

        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }

    public function enqueue_scripts() {

        wp_enqueue_script( 'JC_ProjetLP_Admin', plugins_url( '../assets/JS/JC_ProjetLP_Admin.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_style( 'JC_ProjetLP_Admin', plugins_url( '../assets/CSS/JC_ProjetLP_Front.css', dirname( __FILE__ ) ), array(), '1.0.0', 'all' );
        wp_localize_script( 'JC_ProjetLP_Admin', 'JC_ProjetLP_Admin', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'JC_ProjetLP_Admin' )
        ) );

    }

    public function add_menu() {

        add_menu_page(
            __( 'Configuration', 'projetlp' ),
            'Configuration',
            'manage_options',
            'projetlp',
            array( $this, 'config' ),
            'dashicons-admin-generic',
            2
        );

        add_submenu_page(
            'projetlp',
            __( 'Gestion pays', 'projetlp' ),
            __( 'Gestion pays', 'projetlp' ),
            'manage_options',
            'projetlp-config',
            array( $this, 'page' )
        );

        add_submenu_page(
            'projetlp',
            __( 'Gestion prospects', 'projetlp' ),
            __( 'Gestion prospects', 'projetlp' ),
            'manage_options',
            'projetlp-liste',
            array( $this, 'prospects' )
        );

    }

    public function config() {

        $view = new JC_ProjetLP_ConfigView();

        return false;

    }

    public function page() {

        $view = new JC_ProjetLP_CountryListView();

        return false;

    }

    public function prospects() {

        $view = new JC_ProjetLP_Prospects();

        return false;

    }

}

