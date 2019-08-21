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

function startBagaca() {}

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


function jmart_store_product_api(){
    register_rest_route( 'jmart', '/product/store', array(
        'methods' => 'POST',
        'callback' => 'jmart_store_product',
    ));
}
add_action( 'rest_api_init', 'jmart_store_product_api');

// Rota para criação de um novo produto no banco de dados
function jmart_store_product($data) {
    $header = ['headers' => ['Authorization' => 'Bearer '.config('ACCESS_TOKEN')->value]];

    $response = wp_remote_get('https://api-hot-connect.hotmart.com/product/rest/v2/'.$data->get_query_params()['id'], $header);
    $request = wp_remote_retrieve_body( $response );

    productStore($request);

    return $request;
}

/**
 * Display a custom menu page
 */
function my_custom_menu_page(){
//    $configs = $wpdb->get_results("SELECT * FROM jmart_products");
    $products = $wpdb->get_results("SELECT * FROM jmart_products");
//        var_dump($products);exit;

    include("dash.php");
//    esc_html_e( , 'textdomain');
}

//add_menu_page('JMart Plugin Page', 'JMart Plugin', 'manage_options', 'jmart', 'test_init');


public function productStore($request) {

}

function config($key) {
    global $wpdb;
    $configs = $wpdb->get_results("SELECT * FROM jmart_configs WHERE key_name = '{$key}'");
    return $configs[0];
}