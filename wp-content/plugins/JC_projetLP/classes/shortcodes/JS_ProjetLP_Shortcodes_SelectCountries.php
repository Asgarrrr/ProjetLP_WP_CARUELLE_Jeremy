<?php

add_shortcode( "JC_ProjetLP_selectCountries", array( "JS_ProjetLP_Shortcodes_SelectCountries", "selectCountries" ) );

class JS_ProjetLP_Shortcodes_SelectCountries {

    public static function selectCountries() {

        // Define the required fields
        $required_fields = array('gender', 'lastname', 'firstname', 'email', 'birthdate');

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
        $countries = $crud->get_availableCountries();

        ?>

        <form action="./final" method="post" id="selectCountriesForm">

            <!-- Save all previous data in hidden  -->
            <input type="hidden" name="gender" value="<?php echo esc_attr( $gender ); ?>">
            <input type="hidden" name="lastname" value="<?php echo esc_attr( $lastname ); ?>">
            <input type="hidden" name="firstname" value="<?php echo esc_attr( $firstname ); ?>">
            <input type="hidden" name="email" value="<?php echo esc_attr( $email ); ?>">
            <input type="hidden" name="birthdate" value="<?php echo esc_attr( $birthdate ); ?>">

            <?php

                for ( $i = 1; $i <= 5; $i++ ) {

                    ?>
                        <div id="country<?php echo $i; ?>Div">
                            <label for="country<?php echo $i; ?>">Country <?php echo $i; ?>:</label>
                            <select id="country<?php echo $i; ?>" name="country<?php echo $i; ?>" <?php if ( $i == 1 ) { echo 'required'; } ?>>
                                <option value="">Select</option>

                                <?php

                                foreach ( $countries as $country ) {

                                    ?>

                                        <option value="<?php echo $country['ISO']; ?>"><?php echo $country['countryNameFR']; ?></option>

                                    <?php

                                }

                                ?>

                            </select><br>
                        </div>

                    <?php

                }

            ?>

            <input type="submit" value="Valider" class="float-right">
        </form>

        <?php

    }


}