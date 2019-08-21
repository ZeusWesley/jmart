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

//Register a custom menu page.
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
    global $wpdb;
    $products = $wpdb->get_results("SELECT * FROM jmart_products");
    include("dash.php");
}

// Register route for store product on database
function jmart_store_product_api(){
    register_rest_route( 'jmart', '/product/store', array(
        'methods' => 'POST',
        'callback' => 'jmart_store_product',
    ));
}
add_action( 'rest_api_init', 'jmart_store_product_api');

// Method called by registered routed for store product
function jmart_store_product($data) {
    $header = ['headers' => ['Authorization' => 'Bearer '.config('ACCESS_TOKEN')->value]];

    $response = wp_remote_get('https://api-hot-connect.hotmart.com/product/rest/v2/'.$data->get_params()['id'], $header);
    $request = wp_remote_retrieve_body( $response );

    productStore(json_decode($request));

    return $request;
}

// Store product on Database after check if there exists
function productStore($data) {
    global $wpdb;

    $existent = findProduct($data->id);
    if($existent)
        throw new Exception('Produto já cadastrado!');

    $wpdb->insert('jmart_products',
        [
            'hotmart_id'    => $data->id,
            'name'          => $data->name,
            'category'      => $data->category->name,
            'status'        => 1
        ],['%s', '%s', '%s']
    );

    return $data;
}

// Find for product by ID
function findProduct($id) {
    global $wpdb;
    $configs = $wpdb->get_results("SELECT * FROM jmart_products WHERE hotmart_id = '{$id}'");
    return $configs[0];
}

// Get config plugin by key name
function config($key) {
    global $wpdb;
    $configs = $wpdb->get_results("SELECT * FROM jmart_configs WHERE key_name = '{$key}'");
    return $configs[0];
}