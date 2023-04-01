<?php

    // Select all countries from the database and return them as an XML file
    $path = __DIR__;
    preg_match('/(.*)wp\-content/i', $path, $dir);
    require_once(end($dir). 'wp-load.php');

    global $wpdb;
    $tableName = $wpdb->prefix . "jc_country";
    $sql = "SELECT * FROM `$tableName`;";
    $result = $wpdb->get_results( $sql, "ARRAY_A" );

    $xml = new SimpleXMLElement('<xml/>');

    foreach( $result as $country ) {

        $countryXML = $xml->addChild('country');
        $countryXML->addChild('ISO', $country['ISO']);
        $countryXML->addChild('countryNameFR', $country['countryNameFR']);
        $countryXML->addChild('notation', $country['notation']);
        $countryXML->addChild('majorOnly', $country['majorOnly']);
    }

    header('Content-type: text/xml');
    echo $xml->asXML();

    ob_start();
    ob_end_flush();


?>