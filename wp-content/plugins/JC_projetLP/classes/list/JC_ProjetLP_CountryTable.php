<?php

if ( !class_exists( "WP_List_Table" ) ) {
    require_once( ABSPATH . "wp-admin/includes/class-wp-list-table.php" );
    require_once( ABSPATH . "wp-admin/includes/screen.php" );
}

class JC_ProjetLP_CountryTable extends WP_List_Table {

    public $_tableName = "projetlp_country";
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

        $columns[ "ISO" ]           = __( "ISO" );
        $columns[ "countryNameFR" ] = __( "Nom du pays" );
        $columns[ "notation" ]      = __( "Notation" );
        $columns[ "majorOnly" ]     = __( "Uniquement pour les majeurs" );

        global $wpdb;
        $data = $wpdb->prefix . $this->_tableName;

        $sql = "SELECT DISTINCT valeur FROM `$data` WHERE valeur <> '';";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $col) {
            $columns[$col['valeur']] = __($col['valeur']);
        }

        $columns["delete"] = __("Delete");

        return $columns;

    }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array())
    {
        global $wpdb;

        $sql = "SELECT DISTINCT `valeur` FROM " . $wpdb->prefix . 'insset_subscribers' . " WHERE `valeur` != ''";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ( $result as $value )
            $sortable[ $value[ 'valeur' ] ] = array( $value[ 'valeur' ], true );

        $sortable[ "ISO" ]              = array( 'ISO', true );
        $sortable[ "countryNameFR" ]    = array( 'countryNameFR', true );
        $sortable[ "notation" ]         = array( 'notation', true );
        $sortable[ "majorOnly" ]        = array( 'majorOnly', true );

        return $sortable;
    }

    public function table_data( $per_page=10, $page_number=1, $orderbydefault=false ) {

        global $wpdb;

        $sql = "SELECT * FROM " . $wpdb->prefix . $this->_tableName;

        if (!empty($_REQUEST['orderby'])) {
			$sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
			$sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item, $column_name ) {

        if(preg_match('/delete/i',$column_name))
            return self::getDelete($item['ISO']);

        if(preg_match('/majorOnly/i',$column_name))
            return sprintf( '<input type="checkbox" name="majorOnly" id="%s" %s>', $item['ISO'], $item['majorOnly'] == 1 ? 'checked' : '' );

        if(preg_match('/notation/i',$column_name))
            return sprintf( '<select name="notation" id="%s" class="notation">%s</select>', $item['ISO'], $this->getNotation($item['notation']) );

        return @$item[$column_name];

    }

    private function getNotation($notation){
        $notation = (int)$notation;
        $notation = $notation > 5 ? 5 : $notation;
        $notation = $notation < 1 ? 1 : $notation;
        $notation = $notation == 0 ? 1 : $notation;

        $html = '';
        for($i = 1; $i <= 5; $i++){
            $html .= sprintf( '<option value="%d" %s>%d</option>', $i, $notation == $i ? 'selected' : '', $i );
        }

        return $html;
    }

    private function getDelete($id){
        if(!$id)
            return;
        return sprintf( '<button id="%d" class="button-secondary button-small delbtn"><span class="dashicons dashicons-trash"></span></i></button>', $id );

    }




}