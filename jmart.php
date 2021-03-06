<?php

/*
 *
 * Plugin name: Plugin Hotmart
 * Plugins uri: http://jmart.com.br
 * Description: Plugin de integração com a hotmart, para listagem de produtos
 * Version: 1.0
 * Author: Eliseu Wesley
 * License: Qualquer uma ai, por enquanto!
*
*/
function startBagaca()
{
}

add_action('init', 'startBagaca');

//Register a custom menu page.
function customPageJMart()
{
    add_menu_page(
        __('Custom Menu Title', 'textdomain'),
        'Hotmart',
        'manage_options',
        'custompage',
        'my_custom_menu_page',
        plugins_url('myplugin/images/icon.png'),
        6
    );
}

add_action('admin_menu', 'customPageJMart');

/**
 * Display a custom menu page
 */
function my_custom_menu_page()
{
    global $wpdb;
    $products = $wpdb->get_results("SELECT * FROM jmart_products");
    include("dash.php");
}

function signup()
{
    register_rest_route('jmart', '/signup', array(
        'methods' => 'POST',
        'callback' => 'jmart_signup',
    ));
}
add_action('rest_api_init', 'signup');

function jmart_signup() {
    $data = [
        'headers' => [
            'Authorization' => 'Bearer ' . config('ACCESS_TOKEN')->value,
            'Content-Type' => 'application/json; charset=utf-8'
        ],
        'body' => json_encode($_POST),
        'method'      => 'POST',
        'data_format' => 'body',
    ];

    $response = wp_remote_post('https://api-hot-connect.hotmart.com/user/rest/v2/signup', $data);
    $request = wp_remote_retrieve_body($response);

    return $request;
}

function accessToken()
{
    register_rest_route('jmart', '/access-token', array(
        'methods' => 'GET',
        'callback' => 'generateAccessToken',
    ));
}
add_action('rest_api_init', 'accessToken');

function generateAccessToken() {
    try {
        $data = [
            'headers' => [
                'Authorization' => 'Basic ' . config('BASIC')->value,
                'Content-Type' => 'application/json; charset=utf-8'
            ],
            'body' => [
                'client_id' => config('CLIENT_ID')->value,
                'client_secret' => config('CLIENT_SECRET')->value
            ],
            'method'      => 'POST',
            'data_format' => 'body',
        ];

        $response = wp_remote_post('https://api-sec-vlc.hotmart.com/security/oauth/token?grant_type=client_credentials', $data);
        $request = wp_remote_retrieve_body($response);

        global $wpdb;

        $existent = findProduct($data->id);
        if ($existent)
            throw new Exception('Produto já cadastrado!');

        $wpdb->update('jmart_configs', [
            'value' => json_decode($request)->access_token,
        ], ['key_name' => 'ACCESS_TOKEN']);
    } catch (Exception $e) {
        throw $e;
    }

    return 'success';
}

// Register route for store product on database
function jmart_store_product_api()
{
    register_rest_route('jmart', '/product/store', array(
        'methods' => 'POST',
        'callback' => 'jmart_store_product',
    ));
}

add_action('rest_api_init', 'jmart_store_product_api');

// Method called by registered routed for store product
function jmart_store_product($data)
{
    $header = ['headers' => ['Authorization' => 'Bearer ' . config('ACCESS_TOKEN')->value]];

    $response = wp_remote_get('https://api-hot-connect.hotmart.com/product/rest/v2/' . $data->get_params()['id'], $header);
    $request = wp_remote_retrieve_body($response);

    productStore(json_decode($request));

    return $request;
}

// Store product on Database after check if there exists
function productStore($data)
{
    global $wpdb;

    $existent = findProduct($data->id);
    if ($existent)
        throw new Exception('Produto já cadastrado!');

    $wpdb->insert('jmart_products', [
        'hotmart_id' => $data->id,
        'name' => $data->name,
        'category' => $data->category->name,
        'status' => 1
    ], ['%s', '%s', '%s']
    );

    return $data;
}

// Method called by registered routed for store product
function jmart_user_authenticate()
{
    $sessdir = dirname(dirname(__FILE__)) . '/session_dir';
    ini_set('session.save_path', $sessdir);

    session_start();

    if (isset($_GET['code'])) {
        try {
            $code = $_GET['code'];
            $redirect_uri = site_url();
            $client_id = config('CLIENT_ID')->value;
            $basic = config('BASIC')->value;

            $header = ['headers' => ['Authorization' => 'Basic ' . $basic]];

            $response = wp_remote_post('https://api-sec-vlc.hotmart.com/security/oauth/token?grant_type=authorization_code&code=' . $code
                . '&client_id=' . $client_id . '&redirect_uri=' . $redirect_uri, $header);

            $request = wp_remote_retrieve_body($response);
            $data = json_decode($request);

            $parts = str_split($data->access_token, 128);

            $_SESSION['access_token'] = [];

            foreach ($parts as $key => $string) {
                $_SESSION['access_token'][] = $string;
            }

            $_SESSION['user'] = hotmart_user();
            checkSubscriber($_SESSION['user']->email);
        } catch (Exception $e) {
            throw $e;
        }
    }
}

add_action('init', 'jmart_user_authenticate');

// Register route for logout user
add_action('rest_api_init', function () {
    register_rest_route('jmart', '/logout', array(
        'methods' => 'GET',
        'callback' => 'logoutUser',
    ));
});

function getToken()
{
    $token = null;
    if (isset($_SESSION['access_token']))
        $token = implode('', $_SESSION['access_token']);
    return $token;
}

function products_list($atts)
{
//    extract(shortcode_atts(['category' => 'any'], $atts, 'multilink'));

    return displayProducts();
}

add_shortcode('products', 'products_list');

function displayProducts($category)
{
    global $wpdb;
//    $products = $wpdb->get_results("SELECT * FROM jmart_products WHERE category LIKE '%{$category}%'");
    $products = $wpdb->get_results("SELECT * FROM jmart_products WHERE category LIKE '%ebook%'");
    include("products.php");
}

function topBar()
{
//    var_dump(checkSubscriber(get_user()->email));exit;
    include("topBar.php");
}
add_shortcode('top_bar', 'topBar');

function signupForm()
{
    include("authenticate.php");
}
add_shortcode('signup_form', 'signupForm');

function formSearch()
{
    include("search.php");
}

add_shortcode('search_form', 'formSearch');

add_action('rest_api_init', function () {
    register_rest_route('jmart', '/post-search', array(
        'methods' => 'GET',
        'callback' => 'misha_filter_function',
    ));
});

function misha_filter_function()
{
    return require_once("post-list.php");
}

function getSubscribers() {
    $data = [
        'headers' => ['Authorization' => 'Bearer ' . config('ACCESS_TOKEN')->value]
    ];

    $response = wp_remote_get('https://api-hot-connect.hotmart.com/subscriber/rest/v2', $data);
    $request = wp_remote_retrieve_body($response);

    if ($request->error && $request->error == 'invalid_token') {
        if(generateAccessToken() == 'success')
            getSubscribers();
        else
            throw new \Exception($request->error);
    }

    return $request;
}

function checkSubscriber($reference) {
    $subscribers = json_decode(getSubscribers());

    foreach($subscribers->data as $item) {
        if($item->subscriber->email == $reference)
            $_SESSION['subscription'] = $item->plan;
    }

    if($_SESSION['subscription'] == null)
        return [];

    return $_SESSION['subscription'];
}


// Find for product by ID
function findProduct($id)
{
    global $wpdb;
    $product = $wpdb->get_results("SELECT * FROM jmart_products WHERE hotmart_id = '{$id}'");
    return $product[0];
}

// Get config plugin by key name
function config($key)
{
    global $wpdb;
    $configs = $wpdb->get_results("SELECT * FROM jmart_configs WHERE key_name = '{$key}'");
    return $configs[0];
}

function get_user()
{
    return $_SESSION['user'];
}

// DESTROY USER ACCESS TOKEN VARIABLE FROM SESSION
function logoutUser()
{
    unset($_SESSION['access_token']);
    unset($_SESSION['user']);
    unset($_SESSION['subscription']);
    $response = new WP_REST_Response();
    $response->set_status(200);

    return $response;
}

function hotmart_user()
{
    try {
        $token = getToken();
        $header = ['headers' => ['Authorization' => 'Bearer ' . $token]];

        $request = wp_remote_get('https://api-hot-connect.hotmart.com/user/rest/v2/me', $header);
        $user = wp_remote_retrieve_body($request);

        if ($user->error) {
            throw new \Exception($user->error);
        }
    } catch (Exception $e) {
        throw $e;
    }

    return json_decode($user);
}