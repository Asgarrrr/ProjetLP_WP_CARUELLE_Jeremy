<?php

class JC_ProjetLP_Admin {

    public function __construct() {

        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        wp_enqueue_script( 'projetlp-admin', plugins_url( '../assets/JS/JC_ProjetLP_Admin.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0.0', true );
        wp_localize_script( 'projetlp-admin', 'projetlp_admin', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'projetlp_admin' )
        ) );
    }

    public function add_menu() {

        add_menu_page(
            __( 'ProjetLP', 'projetlp' ),
            'Configuration',
            'manage_options',
            'projetlp',
            array( $this, 'page' ),
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
            array( $this, 'page' )
        );

    }

    public function page() {

        $view = new JC_ProjetLP_CountryListView();

        return false;

    }

}

