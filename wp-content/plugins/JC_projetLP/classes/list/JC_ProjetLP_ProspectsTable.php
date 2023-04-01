<?php

if ( !class_exists( "WP_List_Table" ) ) {
    require_once( ABSPATH . "wp-admin/includes/class-wp-list-table.php" );
    require_once( ABSPATH . "wp-admin/includes/screen.php" );
}

class JC_ProjetLP_ProspectsTable extends WP_List_Table {

    public $_tableName = "jc_users";
    public $_screen;

    public function __construct( ) {

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;

        parent::__construct( [
            'singular' => __('Item', 'sp'),
            'plural'   => __('Items', 'sp'),
            'ajax'     => false
        ]);

    }

    public function prepare_items() {

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $data = $this->table_data();
        $currentPage = $this->get_pagenum();

        $perPage = 10;
        $this->set_pagination_args(array(
            'total_items' => count($data),
            'per_page'    => $perPage
        ));

        $data = array_slice($data, (($currentPage-1)*$perPage), $perPage);

        $this->items = $data;

    }

    public function get_columns($columns = array()) {

        $columns[ "Prospect" ]    = __( "Prospect" );
        $columns[ "country_id" ]    = __( "ISO Pays" );

        global $wpdb;
        $data = $wpdb->prefix . $this->_tableName;

        $sql = "SELECT DISTINCT valeur FROM `$data` WHERE valeur <> '';";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $col) {
            $columns[$col['valeur']] = __($col['valeur']);
        }

        return $columns;

    }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array())
    {
        global $wpdb;

        $sql = "SELECT DISTINCT `valeur` FROM " . $wpdb->prefix . 'jc_users' . " WHERE `valeur` != ''";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ( $result as $value )
            $sortable[ $value[ 'valeur' ] ] = array( $value[ 'valeur' ], true );

        $sortable[ "Prospect" ] = array( 'Prospect', true );
        $sortable[ "country_id" ] = array( 'country_id', true );

        return $sortable;
    }

    public function table_data( $per_page=10, $page_number=1, $orderbydefault=false ) {

        global $wpdb;

        $sql = "SELECT * FROM " . $wpdb->prefix . $this->_tableName;

        if (!empty($_REQUEST['orderby'])) {
			$sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
			$sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results( $sql, 'ARRAY_A' );

        return $result;

    }

    public function column_default( $item, $column_name ) {


        switch ( $column_name ) {
            case 'Prospect': {

                $birthdate = new DateTime($item['birthdate']);
                $now = new DateTime();
                $interval = $now->diff($birthdate);
                $age = $interval->y;

                return ( $item[ "gender" ] == "male" ? "M. " : "Mme " ) . $item['name'] . ' ' . $item['firstname'] . ' (' . $item['email'] . ')' . ' (' . $age . ' ans)';
            }
            case 'country_id': {
                return $item['country_id'];
            }
                
        }
        
        return @$item[$column_name];

    }

}