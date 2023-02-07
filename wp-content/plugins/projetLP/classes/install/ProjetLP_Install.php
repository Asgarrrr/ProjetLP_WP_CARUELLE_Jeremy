<?php

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

class ProjetLP_Install {

    public function __construct() {

    }

    public function tableAlreadyExists( $table_name = '' ) {

        global $wpdb;

        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name )
            return true;

        return false;

    }

    public function setup() {

    }

}