<?php

    $path = __DIR__;
    preg_match('/(.*)wp\-content/i', $path, $dir);
    require_once(end($dir). 'wp-load.php');

    $crud = new JC_ProjetLP_crud();
    $users = $crud->get_users();

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, array( 'genre', 'nom', 'prénom', 'mail', 'âge', 'code ISO' ));

    foreach ( $users as $user ) {

        $birthdate = new DateTime($user['birthdate']);
        $birthdate = $birthdate->format('Y-m-d');
        $today = date("Y-m-d");
        $age = date_diff(date_create($birthdate), date_create($today))->y;

        fputcsv($output, [$user['gender'],$user['name'], $user['firstname'], $user['email'], "$age" , $user['country_id']]);
    }