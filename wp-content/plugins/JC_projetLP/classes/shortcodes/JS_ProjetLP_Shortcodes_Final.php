<?php

add_shortcode( "JS_ProjetLP_Shortcodes_Final", array( "JS_ProjetLP_Shortcodes_Final", "final" ) );

class JS_ProjetLP_Shortcodes_Final {

    public static function final() {

        // Define the required fields
        $required_fields = array('gender', 'lastname', 'firstname', 'email', 'birthdate', 'country1');

        // Check if all required fields are present
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                // If a required field is missing, redirect the user to an error page
                echo "<script>window.location.href = '../';</script>";
                exit;
            }
        }

        // If all required fields are present, do something with the post data
        $gender     = $_POST['gender'];
        $lastname   = $_POST['lastname'];
        $firstname  = $_POST['firstname'];
        $email      = $_POST['email'];
        $birthdate  = $_POST['birthdate'];


        $crud = new JC_ProjetLP_crud();

        ?>

            <div>

                <form id="commandResume">

                    <fieldset>
                        <legend> Informations personelles </legend>

                        <label for="gender">Civilité</label>
                        <input name="gender" type="text" value="<?= $gender ?>" readonly>

                        <label for="lastname">Nom</label>
                        <input name="lastname" type="text" value="<?= $lastname ?>" readonly>

                        <label for="firstname">Prénom</label>
                        <input name="firstname" type="text" value="<?= $firstname ?>" readonly>

                        <label for="email">Email</label>
                        <input name="email" type="text" value="<?= $email ?>" readonly>

                        <label for="birthdate">Date de naissance</label>
                        <input name="birthdate" type="text" value="<?= $birthdate ?>" readonly>

                    </fieldset>

                    <fieldset>
                        <legend> Destinations </legend>

                        <table>
                            <thead>
                                <tr>
                                    <th>Pays</th>
                                    <th>Notation</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                    for ( $i = 1; $i <= 5; $i++ ) {

                                        if ( array_key_exists( 'country' . $i , $_POST )  && !empty( $_POST[ 'country' . $i ] ) ) {

                                            $country = $crud->get_countriesNotationAndName( $_POST[ 'country' . $i ] )

                                            ?>

                                                <tr>
                                                    <input type="hidden" name="country<?= $i ?>" data-country="<?= Locale::getDisplayRegion( "-" . $_POST[ 'country' . $i ], 'en' ) ?>" value="<?= $_POST[ 'country' . $i ] ?>">
                                                    <td><?= Locale::getDisplayRegion( "-" . $_POST[ 'country' . $i ], 'fr' ) ?></td>
                                                    <td><?php

                                                        for ( $j = 0; $j < 5; $j++ ) {

                                                            if ( $j < $country['notation'] ) {
                                                                ?> <span class="dashicons dashicons-star-filled"></span> <?php
                                                            } else {
                                                                ?> <span class="dashicons dashicons-star-empty"></span> <?php
                                                            }

                                                        }


                                                    ?></td>
                                                </tr>

                                            <?php

                                        }

                                    }

                                ?>

                            </tbody>
                        </table>

                    </fieldset>

                    <button type="button" id="validate">Valider mes choix</button>

                </form>

                <div id="modal" style="display:none;"></div>

            </div>

        <?php

    }


}
