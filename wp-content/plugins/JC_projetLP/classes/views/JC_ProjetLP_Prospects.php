<?php

class JC_ProjetLP_Prospects {

    public function __construct() {

        ?>

            <div class="wrap">
                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                <hr class="wp-header-end" />

                    <div class="wrap">
                        <form method="post" action="<?= plugins_url( PROJETLP_PLUGIN_NAME.'/classes/export/JC_ProjetLP_ExportCSV.php' ); ?>">
                            <input type="submit" class="button button-primary" value="Export CSV">
                        </form>
                    </div>

                    <div class="wrap" id="list-table">
                        <form id="list-table-form" method="post">
                            <?php
                                $Wp_List = new JC_ProjetLP_ProspectsTable( );
                                $Wp_List->prepare_items();
                                $Wp_List->display();
                            ?>
                        </form>
                    </div>

                </div>


            <div>

        <?php

    }


}