<?php

class JC_ProjetLP_crud {

    public function __construct() {


    }

    // Insert a country in the database
    public function add_country( string $ISO, string $countryNameFR, int $notation = 0, int $majorOnly = 0 ) {

        global $wpdb;
        $tableName = $wpdb->prefix . "JC_country";
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

    // Delete a country from the database
    public function delete_country( string $countryID ) {

        global $wpdb;
        $tableName = $wpdb->prefix . "JC_country";
        $succes = $wpdb->delete(
            $tableName,
            array(
                'ISO' => $countryID
            )
        );

        return $succes;

    }

    // Get all the countries from the database
    public function get_countries() {

        global $wpdb;
        $tableName = $wpdb->prefix . "JC_country";
        $sql = "SELECT * FROM `$tableName`;";
        $result = $wpdb->get_results( $sql, "ARRAY_A" );

        return $result;

    }

    // Get all the countries from the database that are enabled
    public function get_availableCountries() {

        global $wpdb;
        $tableName = $wpdb->prefix . "JC_country";
        $sql = "SELECT * FROM `$tableName` WHERE enabled = 1;";
        $result = $wpdb->get_results( $sql, "ARRAY_A" );

        return $result;

    }

    public function set_countryMajorOnly( string $countryID ) {

        global $wpdb;
        $tableName = $wpdb->prefix . "jc_country";
        $sql = "SELECT majorOnly FROM `$tableName` WHERE ISO = '$countryID';";
        $result = $wpdb->get_results( $sql, "ARRAY_A" );

        $majorOnly = $result[0]['majorOnly'] == 0 ? 1 : 0;

        $succes = $wpdb->update(
            $tableName,
            array(
                'majorOnly' => $majorOnly
            ),
            array(
                'ISO' => $countryID
            )
        );


    }

    public function set_countryNotation( string $countryID, int $notation ) {

        // Error handling
        if ( $notation < 0 || $notation > 5 ) {
            return false;
        }

        global $wpdb;
        $tableName = $wpdb->prefix . "jc_country";
        $succes = $wpdb->update(
            $tableName,
            array(
                'notation' => $notation
            ),
            array(
                'ISO' => $countryID
            )
        );

    }

    public function get_countriesNotationAndName( string $countryID ) {

        global $wpdb;
        $tableName = $wpdb->prefix . "jc_country";
        $sql = "SELECT notation, countryNameFR FROM $tableName where ISO = '$countryID';";
        $result = $wpdb->get_results( $sql, "ARRAY_A" );

        return [
            'notation' => $result[0]['notation'],
            'countryNameFR' => $result[0]['countryNameFR']
        ];

    }

    public function set_countryEnabled( array $countryID )
    {

        global $wpdb;
        $tableName = $wpdb->prefix . "jc_country";
        $countries = $this->get_countries();

        foreach ( $countries as $country ) {

            if ( in_array( $country['ISO'], $countryID ) ) {
                $wpdb->update(
                    $tableName,
                    array( 'enabled' => 1 ),
                    array( 'ISO' => $country['ISO'] )
                );
            } else {
                $wpdb->update(
                    $tableName,
                    array( 'enabled' => 0 ),
                    array( 'ISO' => $country['ISO'] )
                );
            }

        }

    }

}