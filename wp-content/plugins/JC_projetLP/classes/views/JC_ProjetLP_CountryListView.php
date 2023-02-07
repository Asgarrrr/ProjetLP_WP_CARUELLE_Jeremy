<?php

class JC_ProjetLP_CountryListView {

    public function __construct() {

        ?>

            <div class="wrap">
                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                <hr class="wp-header-end" />
                <div class="notice notice-info notice-alt is-dismissible hide delete-confirmation">
                    <p><?php _e('Updated done!'); ?></p>
                </div>
                <div class="wrap" id="list-table">
                    <form id="list-table-form" method="post">
                        <?php
                            $Wp_List = new JC_ProjetLP_CountryTable( );
                            $Wp_List->prepare_items();
                            $Wp_List->display();
                        ?>
                    </form>
                </div>
            <div>

        <?php

    }


}