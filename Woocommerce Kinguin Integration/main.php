<?php


/**
 * author: Andrzej Skowron
 * email: skwrn@outlook.com
 * 
 * Woocommerce - Kinguin API intergration
 */

require 'curl_helper.php';
require 'Products.php';
require 'Order.php';
require 'email.php';
require 'Settings.php';

 
function getConfigVar($var) {
    $ini = parse_ini_file('config.ini');
    
    return $ini[$var];
}

function ask_enqueue() {
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/Kinguin/main.js', array('jquery'),time() );
}
add_action( 'wp_enqueue_scripts', 'ask_enqueue' );


function getResponse(string $url, string $target, array $params, array $options,string $returnType,string $requestType = null) {

    $headers = [
        'api-ecommerce-auth: '.getConfigVar("api_auth"),
        'Content-Type: application/json',
    ];

    $curl = new \Kinguin\Http\CurlPost($url.$target.'?'.http_build_query($params),$options,$headers,$returnType,$requestType);

    try {
        // execute the request
        switch ($returnType) {
            case 'HTTP':
                return $curl([
                    'content_type' => 'application/json'
                ]);
                break;
            case 'body':
                return json_decode($curl([
                    'content_type' => 'application/json'
                ]),true);
                break;
            case 'both':
                return $curl([
                    'content_type' => 'application/json'
                ]);
                break;
        }
    } catch (\RuntimeException $ex) {
        // catch errors
        die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
    }
}

function getProductsByPage($page) {
    return getResponse(getConfigVar("api_url"), "products", ["limit" => "100", "page" => $page], [],'body');
}

// hook before payment
function ask_review_order_before_payment(){
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();

    foreach($items as $item => $values) { 
        $product =  wc_get_product( $values['data']->get_id()); 
        $name = $product->get_title();

        $_product = new \Kinguin\Products\Product($name);
        $_product->updateProduct();
    } 
}
add_action( 'woocommerce_review_order_before_payment', 'ask_review_order_before_payment', 10 );

function getAllProducts() {

    $_products = new \Kinguin\Products\Products();
    $productsNumber = $_products->getProductsNumber();

    $iterations = ceil($productsNumber/100);
    $currentIteration = 0;

    while($currentIteration <= $iterations){

        initializeProducts($currentIteration);

        echo $currentIteration;
        $currentIteration++;
    }
}

function initializeProducts() {

    $product = $_POST['product'];

    try {
        $objProduct;
        $objProduct = new WC_Product();
        $objProduct = new WC_Product_Simple();

        $objProduct->set_name($product["name"]);
        $objProduct->set_status("publish");  // can be publish,draft or any wordpress post status
        $objProduct->set_catalog_visibility('visible'); // add the product visibility status
        $objProduct->set_description($product["description"]);
        $objProduct->set_price($product["price"]); // set product price
        $objProduct->set_regular_price($product["price"]); // set product regular price
        $objProduct->set_manage_stock(true); // true or false
        $objProduct->set_stock_quantity($product["qty"]);
        $objProduct->set_stock_status('instock'); // in stock or out of stock value
        $objProduct->set_backorders('no');
        $objProduct->set_sku($product['kinguinId']);
        $objProduct->set_reviews_allowed(true);
        $objProduct->set_sold_individually(false);
        
        $productImagesIDs = array(); // define an array to store the media ids.
        $images = array($product["coverImage"]); // images url array of product
        foreach($images as $image){
            $mediaID = uploadMedia($image); // calling the uploadMedia function and passing image url to get the uploaded media id
            if($mediaID) $productImagesIDs[] = $mediaID; // storing media ids in a array.
        }
        if($productImagesIDs){
            $objProduct->set_image_id($productImagesIDs[0]); // set the first image as primary image of the product
            
            //in case we have more than 1 image, then add them to product gallery. 
            if(count($productImagesIDs) > 1){
                $objProduct->set_gallery_image_ids($productImagesIDs);
            }
        }
        
        $product_id = $objProduct->save(); // it will save the product and return the generated product id
        wp_set_object_terms( $product_id, $product['genres'], 'product_cat' );

        echo 'ok';
        
    } catch (Exception $e){
        error_log($e);
        die();
    }
    die();
    
}

add_action('wp_ajax_initializeProducts', 'initializeProducts');


function uploadMedia($image_url){
    require_once(ABSPATH.'wp-admin/includes/image.php');
    require_once(ABSPATH.'wp-admin/includes/file.php');
    require_once(ABSPATH.'wp-admin/includes/media.php');
    $media = media_sideload_image($image_url,0);
    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'post_status' => null,
        'post_parent' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC'
    ));
    return $attachments[0]->ID;
}

// update the price every time the product is shown
function filterWoocommerceGetPriceHtml( $price, $instance ) { 
    global $wpdb;
    $product = new \Kinguin\Products\Product($instance->get_name());
    $taxRate = get_option( 'ask_option_margin','0' );
    $product->updateProduct();
    return $product->getPrice()+$taxRate['margin']; 
}; 

function woocommerce_template_display_tax() {
    global $product;
    $tax_rates = WC_Tax::get_rates( $product->get_tax_class() );
    if (!empty($tax_rates)) {
        $tax_rate = reset($tax_rates);
        return  $tax_rate['rate'];
    }
}

// add the filter 
add_filter( 'woocommerce_get_price_html', 'filterWoocommerceGetPriceHtml', 10, 2 ); 

// update the stock every time the product is shown
function filterWoocommerceGetStockHtml( $html, $instance  ) { 

    $product = new \Kinguin\Products\Product($instance->get_name());
    $product->updateProduct();

    return $product->getStock(); 
}; 

add_filter( 'woocommerce_get_stock_html', 'filterWoocommerceGetStockHtml', 10, 2 ); 

//hook after the order is made:
function ask_status_pending($order_id){

    $order = wc_get_order( $order_id );
    $items = $order->get_items();

    foreach ( $items as $item ) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        $product_variation_id = $item->get_variation_id();

        $product = new \Kinguin\Products\Product($product_name);
        $kinguinPrice = $product->getPrice();

        $wcproduct = wc_get_product( $product_id );
        $shopPrice = $item->get_price();
        $shopStock = $item->get_stock_quantity();

        // check if price is the same on Kinguin...
        if($shopPrice == $kinguinPrice){
            return;
        } else {
            // ...and update it if different
            $product = new WC_Product( $product_id );
            $product->set_price( $kinguinPrice );
            $product->save();
        }
    }
}
add_action( 'woocommerce_new_order', 'ask_status_pending',  1, 1  );

// hook after payment is confirmed
function ask_payment_complete( $order_id ){
    
    $order = wc_get_order( $order_id );
    $items = $order->get_items();

    $order = new stdClass();
    $order->products = [];

     // create arr with products:
    $productsArr = [];

    foreach ($items as $item){

        // get Kinguin stock
        $product_name = $item->get_name();
        $product = new \Kinguin\Products\Product($product_name);
        $kinguinStock = $product->getStock();

        // get shop stock
        $product_id = $item->get_product_id();
        $wcproduct = wc_get_product( $product_id );
        $shopStock = $wcproduct->get_stock_quantity();

        // update stock on Kinguin
        if($shopStock == $kinguinStock){
            return;
        } else {
            if(isset($wcproduct) && $wcproduct !== null && $wcproduct !== false){
                $wcproduct->set_stock_quantity( $wcproduct, $kinguinStock);
                $wcproduct->save();
            }
        }
        //    push products to array as objects
        $productObj = new stdClass();
        $item_product = $item->get_product(); 
        $product->kinguinId = (int)$item_product->get_sku();
        $product->qty = $item->get_quantity();
        $product->price = (float)$item_product->get_price();
        $product->name = $product_name;

        array_push($productsArr, $product);
    }

    $order->products = $productsArr;

    // and let's make an order on Kinguin
    $kinguinOrder = new \Kinguin\Order\Orders($order,$order_id);

    $kinguinOrder->sendKinguinOrder();

}
add_action( 'woocommerce_order_status_completed', 'ask_payment_complete',99 );


// show custom field with keys
add_filter( 'woocommerce_billing_fields' , 'add_field_keys', 20, 1 );
function add_field_keys ( $fields ) {
     $fields['keys'] = array(
        'label'       => __('Kinguin Games Keys', 'woocommerce'),
        'placeholder' => _x('Kinguin Games Keys', 'placeholder', 'woocommerce'),
        'class'       => array('form-row-wide'),
     );

     return $fields;
}

add_filter( 'woocommerce_order_details_after_order_table' , 'ask_create_field_keys', 20, 1 ); // Front
add_action( 'woocommerce_admin_order_data_after_billing_address', 'ask_create_field_keys', 20, 1 ); // Admin
function ask_create_field_keys( $order ){
    $codice_snep = $order->get_meta('keys', true );
    if( ! empty( $codice_snep ) ){
        $label = __('Kinguin Keys');
        if( is_admin() ){ 
            echo '<p><strong>' . $label . ':</strong> ' . $codice_snep . '</p>';
        }
        else { 
            echo '<table class="woocommerce-table"><tbody><tr>
                <th>' . $label . ':</th><td>' . $codice_snep . '</td>
            </tr></tbody></table>';
        }
    }
}

add_action( 'wp_ajax_nopriv_createCSV', 'createCSV' );
add_action('wp_ajax_createCSV', 'createCSV');
function createCSV() {
    global $post;
 
    $jsonString = $_POST['batch'];
    $iteration = $_POST['iteration'];

    if ($error = json_last_error()) {
        $errorReference = [
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
            JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
            JSON_ERROR_SYNTAX => 'Syntax error.',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
            JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
            JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
            JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
        ];
        $errStr = isset($errorReference[$error]) ? $errorReference[$error] : "Unknown error ($error)";
        error_log('exception');
        error_log(print_r($errStr,true));
        return;
    }
 
    jsontocsv($jsonString['results'],$iteration);

}
function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
   }

function jsontocsv($data,$iteration) {
    $csvData = array();
    $csvHeader = array();

    $csvFileName = $_SERVER["DOCUMENT_ROOT"] . '/kinguin/wp-content/uploads/CSV/KinguinProducts'.$iteration.'-'.rand(999,999999).'.csv';
    $fp = fopen($csvFileName, 'w+');

    foreach ($data as $singularProduct){
        $preparedArr = prepareProductArray($singularProduct);
        $csvData = iterateOverJson($preparedArr);

        $csvString = implode('||',$csvData);
        $csvString = str_replace('\/\/','//',$csvString);
        $csvString = str_replace('\/','/',$csvString);
        $csvString = str_replace('\\\\\\','\\',$csvString);
        $csvString = str_replace('\\\\','\\',$csvString);
        $csvString = str_replace('\u00a0',' ',$csvString);
        $csvString = str_replace('_cover.','_cover_original.',$csvString);

        $csvData = stripslashes($csvString);
        $csvData = explode('||',$csvString);

        fputcsv($fp, $csvData,'~');
    }

    fclose($fp);

    wp_send_json_success(array(
      ));
}

function prepareProductArray($data){

    $preparedArr = array();

    $validArrKeys = [
        "name","description","coverImage","developers","publishers","genres","platform","stock","qty","price","activationDetails","kinguinId","originalName","regionId","status","type"
    ];
    // prepare nulls
    foreach($validArrKeys as $key){
        $preparedArr[$key] = "NULL";
    }
    ksort($preparedArr);

    foreach($data as $key => $value) {
        if(in_array($key,$validArrKeys)){
  
            if($value == NULL){
                $preparedArr[$key] = "NULL";
            } else {
                $preparedArr[$key] = $value;
            }
        }
    }
    return $preparedArr;
}

function iterateOverJson($data){

    $csvHeader = array();
    $csvData = array();

    foreach($data as $key => $value) {
        if ($value === null) {
            $csvData[] = "NULL";
        } else {
            $value = json_encode($value);
            $csvData[] = $value;
        }
    }
    return $csvData;
}
