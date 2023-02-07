<?php

class JC_ProjetLP_crud {

    public function __construct() {


    }

    // Insert a country in the database
    public function add_country( string $ISO, string $countryNameFR, int $notation = 0, int $majorOnly = 0 ) {

        global $wpdb;
        $tableName = $wpdb->prefix . "projetlp_country";
        $succes = $wpdb->insert(
            $tableName,
            array(
                'ISO'           => $ISO,
                'countryNameFR' => $countryNameFR,
                'notation'      => $notation,
                'majorOnly'     => $majorOnly
            )
        );

        return $succes;

    }

}