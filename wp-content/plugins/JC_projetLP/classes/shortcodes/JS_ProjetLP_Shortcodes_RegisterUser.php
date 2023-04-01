<?php

add_shortcode( "JC_ProjetLP_registerUser", array( "JS_ProjetLP_Shortcodes_RegisterUser", "registerUser" ) );

class JS_ProjetLP_Shortcodes_RegisterUser {

    public static function registerUser() {

        ?>

            <form action="./select" method="post" id="register" style="display:none">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select><br>

                <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname" required><br>

                <label for="firstname">First name:</label>
                <input type="text" id="firstname" name="firstname" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="birthdate">Date of birth:</label>
                <input type="date" id="birthdate" name="birthdate" required><br>

                <input type="submit" value="Submit">
            </form>

            <div id="prevData" style="display:none">


                <div id="regions_div" style="width: 900px; height: 500px;"></div>

            </div>

        <?php

    }

}