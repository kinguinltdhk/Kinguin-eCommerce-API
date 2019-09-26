<?php


function ask_admin_js() {
    $url = get_bloginfo('template_directory') . '/Kinguin/localforage.min.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'ask_admin_js');


add_action('admin_menu', 'add_menu_page_for_big_import');

function add_menu_page_for_big_import() {
    add_menu_page('Import all the products', 'Kinguin Imports', 'manage_options', 'product-imports', 'all_the_products_import_output','dashicons-welcome-add-page' ,22);
}

function getProductsNumber(){
    $_products = new \Kinguin\Products\Products(0);
    $productsNumber = $_products->getProductsNumber();
    echo ceil($productsNumber);
    die();
}
add_action('wp_ajax_getProductsNumber', 'getProductsNumber');
add_action('wp_ajax_nopriv_getProductsNumber', 'getProductsNumber');


function getProductsBatch() {
    $iteration = $_POST['iteration'];
    $_products;
    $_products = new \Kinguin\Products\ProductsBatch(intval($iteration));
    $productsIteration = $_products->getProductsBatch();
    echo json_encode($productsIteration);
    $_products = null;
    die();

}
add_action('wp_ajax_getProductsBatch', 'getProductsBatch');
add_action('wp_ajax_nopriv_getProductsBatch', 'getProductsBatch');




function all_the_products_import_output(){
    wp_enqueue_media();
    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('jquery-timing','//creativecouple.github.io/jquery-timing/jquery-timing.min.js',array('jquery'));
    wp_enqueue_script('jquery-ui-progressbar');
    wp_enqueue_style('jquery-ui-smoothness-style','//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css');
    ?>

    <div class="wrap">

    <style>

        .loader {
            position: relative;
            width: 40px;
            display:none;
            margin:40px 0 100px 0;
            }
            .loader .circle {
            position: absolute;
            width: 38px;
            height: 38px;
            opacity: 0;
            transform: rotate(225deg);
            animation-iteration-count: infinite;
            animation-name: orbit;
            animation-duration: 5.5s;
            }
            .loader .circle:after {
            content: '';
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 5px;
            background: #666;
            /* Pick a color */
            }
            .loader .circle:nth-child(2) {
            animation-delay: 240ms;
            }
            .loader .circle:nth-child(3) {
            animation-delay: 480ms;
            }
            .loader .circle:nth-child(4) {
            animation-delay: 720ms;
            }
            .loader .circle:nth-child(5) {
            animation-delay: 960ms;
            }
            @keyframes orbit {
            0% {
                transform: rotate(225deg);
                opacity: 1;
                animation-timing-function: ease-out;
            }
            7% {
                transform: rotate(345deg);
                animation-timing-function: linear;
            }
            30% {
                transform: rotate(455deg);
                animation-timing-function: ease-in-out;
            }
            39% {
                transform: rotate(690deg);
                animation-timing-function: linear;
            }
            70% {
                transform: rotate(815deg);
                opacity: 1;
                animation-timing-function: ease-out;
            }
            75% {
                transform: rotate(945deg);
                animation-timing-function: ease-out;
            }
            76% {
                transform: rotate(945deg);
                opacity: 0;
            }
            100% {
                transform: rotate(945deg);
                opacity: 0;
            }
        }
    </style>
    <h2>Import Products from Kinguin API</h2>
        <div class="loader">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
        <div id="success"></div>
        <p>First, click "Download products from Kinguin" and after it finishes, click "Upload products to the shop" <br/><strong>Adjusting max execution time on the php engine may be required</strong></p>
        <p>check the console log for more info</p>
        <h3>In order to download CSV files, click the button below and files will be downlaoded do /uploads/CSV folder and will be accessible through the "Media" section in admin panel</h3></h3>
    <form name="import_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input id="download_csv_button" type="button"   value="Download CSV file" />
        <input id="download_button" type="button" value="Download products from Kinguin" />
        <input id="results" type="hidden" />
        <input id="goimport" type="button" value="Upload products to the shop" />
    </form>
    <?php //} ?>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script>

    var ajaxGetItems = function(_iteration) {
        return new Promise(function(resolve, reject) {
            jQuery.ajax({
                type: 'POST',
                url: "<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php",
                data: {
                    action: 'getProductsBatch',
                    iteration: _iteration
                },
                success: function( data ) {
                    jQuery('.loader').css('display','none');
                    
                    jQuery('#success').html('data successfully downloaded');
            
                    localforage.setItem('products'+_iteration, JSON.parse(data)).then(function (value) {
                        resolve();
               
                    }).catch(function(err) {
                        console.log(err);
                        jQuery('#success').html('Error occured: '+err);
                    });
                }
                
            });
       
        });
    }

var ItemProductFinal = class  {

    constructor(adminUrl,obj) { 
        this.adminUrl = adminUrl;
        this.obj = obj;
    } 


    setItems = function() {
       let ajaxBatch = ajaxSetItem(this.obj).then(function(value) {
            console.log('batch set'); 
        })
        
       ajaxSetItem = function(obj) {
           
            return new Promise(function(resolve, reject) {
                // send chunk of products to php
                jQuery.ajax({
                    type: 'POST',
                    url: adminUrl+"/wp-admin/admin-ajax.php",
                    data: {
                        action: 'initializeProducts',
                        product: obj
                    },
                    success: function( data ) {
                        jQuery('.loader').css('display','none');
                        jQuery('#success').html('products successfully added to the shop');
                        resolve();
                    },
                    error: function(data) {
                        console.log(data);
                        resolve();
                    }
                });
            })
        };

     
    };
}

    var setItems = function(obj) {

        var batch10items = new ItemProductFinal(adminUrl,obj);
        batch10items.setItems();
    };

    const adminUrl = "<?php echo get_home_url(); ?>";

    var ajaxSetItem = function(obj) {
        return new Promise(function(resolve, reject) {
            // send chunk of products to php
            jQuery.ajax({
                type: 'POST',
                url: adminUrl+"/wp-admin/admin-ajax.php",
                data: {
                    action: 'initializeProducts',
                    product: obj
                },
                success: function( data ) {
                    jQuery('.loader').css('display','none');
                    jQuery('#success').html('products successfully added to the shop');
                    resolve();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        })
    };

    jQuery(document).ready(function($) {

        $('#goimport').click(function(event){
            event.preventDefault();
            
            let products;
            localforage.keys().then(function(keys) {
                // An array of all the key names in local storage;

                var fn = iterateOverLocalStorage,
                    count = keys.length,
                    ms = 240000;
                    data = products

                repeatWithParams(fn, count,ms,products);

            }).catch(function(err) {
                console.log(err);
            });
        });

        function iterateOverLocalStorage(y,products){
            localforage.getItem('products'+y).then(function(value) {

                var aktval,i,j,temparray,chunk = 10;

                // iterate over all items in local storage

                const start = async () => {
                    await asyncForEach(value.results, async (obj) => {
                        await waitFor(50);

                        var fn = setItems;
                        var count = value.results.length;
                        var ms = 2000;
                        var data = obj;

                        repeatWithParam(fn, count, ms, data);
                    });
                console.log('Done');
                }
                start();
                
            }).catch(function(err) {
                console.log(err);
            });
        }

        

        const waitFor = (ms) => new Promise(r => setTimeout(r, ms));

        async function asyncForEach(array, callback) {
            for (let index = 0; index < array.length; index++) {
                await callback(array[index], index, array);
            }
        }

        var products;

        jQuery('#download_button').click(function(e) {

            jQuery('.loader').css('display','block')

            currIteration = 0;
            maxIterations = 1;                                                                      
        
            jQuery.ajax({
                type: 'POST',
                url: "<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php",
                data: {
                    action: 'getProductsNumber',
                },
                success: function( data ) {
                    maxIterations = Math.ceil(data/100);

                    var fn = iterate;
                    var count = maxIterations;
                    var ms = 2400;

                    repeat(fn, count, ms);
                
                }
            });
        });
        jQuery('#download_csv_button').click(function(e) {

            jQuery('.loader').css('display','block')

            currIteration = 0;
            maxIterations = 1;
        
            jQuery.ajax({
                type: 'POST',
                url: "<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php",
                data: {
                    action: 'getProductsNumber',
                },
                success: function( data ) {
                    maxIterations = Math.ceil(data/100);

                    var fn = iterateOverLocalStorageCSV;
                    var count = maxIterations;
                    var ms = 24000;

                    repeatWithParams(fn, count, ms, 'csv');
                }
            });
        });
    });

    waitFor = (ms) => new Promise(r => setTimeout(r, ms));

    function iterateOverLocalStorageCSV(count){
        console.log('inside iterateOverLocalStorageCSV');
        console.log('count: ' + count);
            jQuery.ajax({
                type: 'POST',
                url: "<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php",
                data: {
                    action: 'getProductsBatch',
                    iteration: count
                },
                success: function( data ) {
                    jQuery('.loader').css('display','none');
                    
                    jQuery('#success').html('data successfully downloaded');
                 
                    console.log('inside success 1 ');

                    return new Promise(function(resolve, reject) {
                        console.log('inside Promise');

                            products = JSON.parse(data);

                            // console.log('products: ' + products);
                            console.log('count: ' + count);
                            jQuery.ajax({
                                type: 'POST',
                                url: adminUrl+"/wp-admin/admin-ajax.php",
                                data: {
                                    action: 'createCSV',
                                    batch: products,
                                    iteration: count
                                },
                                success: function( data ) {
                                    console.log('inside second ajax');

                                    jQuery('.loader').css('display','none');
                                    jQuery('#success').html('products successfully added to the shop');
                                    resolve();
                                },
                                error: function(data) {
                                    console.log(data);
                                    resolve();
                                }
                            });
                    });
                }
            });
    }

    function iterate(currIteration,csv = null){
        if(csv === null){
            console.log('current iteration: '+currIteration);
            ajaxGetItems(currIteration).then(function(value) {
            })
        } else {
            console.log('currIteration');
            console.log(currIteration);
            ajaxGetItems(currIteration).then(function(value) {
                localforage.keys().then(function(keys) {
                    // An array of all the key names in local storage;
                    let products;
                    var fn = iterateOverLocalStorageCSV,
                        count = keys.length,
                        ms = 240000;

                    repeatWithParams(fn, count,ms,null);

                }).catch(function(err) {
                    console.log(err);
                });
            })

        }
        return currIteration++;
    }



    function repeatWithParam(fn, count,ms,data){
        var i = 0;

        function f() {
            fn(data);
            i += 1;
            setTimeout(function() {
            if (i < count) {
                f(data);
            }
            }, ms);
        }
        f(data);
    }

    function repeatWithParams(fn, count,ms,data){
        var i = 0;
        function f() {
            fn(i,data);
            i += 1;
            setTimeout(function() {
            if (i < count) {
                f(i,data);
            }
            }, ms);
        }
        f(i,data);
    }

    function repeat(fn, count, ms) {
        var i = 0;

        function f() {
            fn(i);
            i += 1;
            setTimeout(function() {
            if (i < count) {
                f(i);
            }
            }, ms);
        }
        f(i);
    }
        
    </script>
</div>

<?php 
// additional button for the product admin page to update product attributes
add_action( 'post_submitbox_misc_actions', 'ask_extra_button_on_product_page');

function ask_extra_button_on_product_page() {
  global $product;
    
  echo "<script type='text/javascript' >

    $('#updateProductAttributes').click(function(){
        var data = {
            action: 'update_product_attributes',
            id: getUrlParameter('post')
        };

        $.post(ajaxurl, data, function(response) {
            
            alert('Got this from the server: ' + response);
        });
    });

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    </script>";

  echo '<a style="
  display: inline-block;
  text-decoration: none;
  font-size: 13px;
  line-height: 26px;
  height: 28px;
  margin: 0;
  padding: 0 10px 1px;
  cursor: pointer;
  border-width: 1px;
  border-style: solid;
  -webkit-appearance: none;
  border-radius: 3px;
  white-space: nowrap;
  box-sizing: border-box;
  margin: 20px 30px;
  background: #ef7d13;
  border-color: #aa6400 #996700 #997c00;
  box-shadow: 0 1px 0 #995800;
  color: #fff;
  text-decoration: none;
  text-shadow: 0 -1px 1px #ef7d13, 1px 0 1px #ef7d13, 0 1px 1px #ef7d13, -1px 0 1px #ef7d13;
  height: 30px;
  line-height: 28px;
  padding: 0 12px 2px;
  vertical-align: top;
  " id="updateProductAttributes" href="">Update product attributes</a>';
}

add_action('wp_ajax_update_product_attributes', 'update_product_attributes_callback');

function update_product_attributes_callback() {
     global $wpdb; // this is how you get access to the database

    $productId = $_POST['id'];
    $product = wc_get_product( $productId);

    $_product = new \Kinguin\Products\Product($product->get_title());
    $_product->updateProductAttributesAll();

    echo '1';
    exit();
}

// block currency change
function change_woocommerce_currency( $currency ) {
    $currency = 'EUR';
    return $currency;
}
apply_filters( 'woocommerce_currency', 'change_woocommerce_currency' ); 

}

add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_status_actions_button', 100, 2 );
function add_custom_order_status_actions_button( $actions, $order ) {

    $action_slug = 'retrieve_order';
    $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

    global $post;
    echo '
        <form action="'.esc_url( admin_url('admin-post.php') ) .'?action=retrieve_order&order_id=' . $order_id.'" method="post">
        <input name="name" type="text" hidden>
        <button type="submit" class="btn btn-primary">Retrieve Order</button>
    </form>
    ';
}

add_action( 'admin_head', 'add_custom_order_status_actions_button_css' );


function add_custom_order_status_actions_button_css() {
   
    $action_slug = "retrieve_order"; 
    echo '<style>.wc-action-button-'.$action_slug.'::after { font-family: woocommerce !important; content: "\e029" !important; }</style>';
}


// action try the dispatch again
add_action('wp_ajax_try_retrieve_order', 'try_retrieve_order');
function try_retrieve_order(){
    error_log('$_POST');
    error_log(print_r($_POST,true));
    $productId = $_POST['order_id'];

    $order = wc_get_order($productId);
    // create order object
    try{
        $order->get_meta('_order_id_kinguin');
        
        // Get order keys
        $kinguinOrder = new \Kinguin\Order\Orders(null,$order);
        $orderKeys = $kinguinOrder->getOrderKeys();
        
        if($orderKeys == false){
        // dispatch
            $kinguinOrder->dispatchKinguinOrder();
            echo 'done';
            die();
        } else {
            echo 'done';
            die();
        }
    }
    catch(Exception $e){
        error_log(print_r($e,true));
    }
}
