<?php

/*
 *
 * Plugin name: Plugin Hotmart
 * Plugins uri: http://jmart.com.br
 * Description: ...
 * Version: 1.0
 * Author: Eliseu Wesley
 * License: Qualquer uma ai, por enquanto!
 *
 */

function startBagaca() {
//    $header = ['headers' => ['Authorization' => CONFIG['ACCESS_TOKEN']]];
//    $response = wp_remote_get('https://api-hot-connect.hotmart.com/product/rest/v2/436242', $header);
//    $request = wp_remote_retrieve_body( $response );

//    printf("<img src='".json_decode($request)->urlCoverPhoto."'/>");exit;
    global $wpdb;
//    $request = $wpdb->get_results("SELECT * FROM wp_users");
//
//    var_dump($request);exit;
}

add_action('init', 'startBagaca');

/**
 * Register a custom menu page.
 */
function customPageJMart(){
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Hotmart',
        'manage_options',
        'custompage',
        'my_custom_menu_page',
        plugins_url( 'myplugin/images/icon.png' ),
        6
    );
}
add_action( 'admin_menu', 'customPageJMart' );

/**
 * Display a custom menu page
 */
function my_custom_menu_page(){
    include("dash.php");
//    esc_html_e( , 'textdomain');
}

//add_menu_page('JMart Plugin Page', 'JMart Plugin', 'manage_options', 'jmart', 'test_init');