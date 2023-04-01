<?php

class JC_ProjetLP_ConfigView {

    public function __construct() {

        ?>

            <div class="wrap">
                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                <hr class="wp-header-end" />

                <div class="wrap">

                    <select name="country" id="countryconfig" multiple>
                        <?php
                            $crud = new JC_ProjetLP_crud();
                            $countries = $crud->get_countries();
                            foreach ( $countries as $country ) {
                                ?>
                                    <option value="<?= $country["ISO"]; ?>" <?php if ( $country["enabled"] ) echo 'selected'; ?>>
                                        <?= $country["countryNameFR"]; ?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>

                </div>


            <div>

        <?php

    }


}