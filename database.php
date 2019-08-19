<?php

global $wpdb;

$env = parse_ini_file('plugin.ini');

if($env['PLUGIN_STATUS'] == 1)
    return false;
else {
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE jmart_products (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            hotmart_id INTEGER(100) NOT NULL,
            UNIQUE KEY id (id)
        ) $charset_collate;";

    if ( ! function_exists('dbDelta') ) {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    }

    dbDelta( $sql );
}

