<?php


/**
 * author: Andrzej Skowron
 * email: skwrn@outlook.com
 * 
 * Woocommerce - Kinguin API intergration
 */

namespace Kinguin\Products;

class ProductsBatch{
    private $products,
            $iteration,
            $page;

    public function __construct(int $page) {
        $this->page = $page;
    }

    public function getProductsBatch() {
        try {
            $response = getResponse(getConfigVar("api_url"), "products", ["limit" => "100", "page" => $this->page], [],'body');
            return $response;
        } catch(Exception $e){
            error_log($e);
        }
    }
}
class Products{
    function getProductsNumber() {
        $response = getResponse(getConfigVar("api_url"), "products", [], [],'body');
        return $response["item_count"];
    }
}

class Product{
    private $product;
    public $price;
    public $qty;

    public function __construct(string $product) {
        $this->product = $product;
    }

    // function updateProduct has to be triggered whenever the price is visible
    function updateProduct() {

        $params = [
            'name' => $this->product
        ];
    
        $response = getResponse(getConfigVar("api_url"), "products", $params, [],'body');
    
        $this->qty = $response["results"][0]["qty"];
        $this->price = $response["results"][0]["price"];
        
        $product = get_page_by_title( $this->product, OBJECT, 'product' );
    
        $productID = $product->ID;
        
        update_post_meta( $productID, "_stock", $this->qty );
        update_post_meta( $productID, "_price", $this->price );
    }

    function updateProductAttributesAll() {

        $params = [
            'name' => $this->product
        ];
    
        $response = getResponse(getConfigVar("api_url"), "products", $params, [],'body');
    
        $this->qty = $response["results"][0]["qty"];
        $this->price = $response["results"][0]["price"];
     
        $objProduct;
        $objProduct = new WC_Product();
        $objProduct = new WC_Product_Simple();

        $objProduct->set_description( $response["results"][0]["description"]);
        $objProduct->set_price($response["results"][0]["price"]); // set product price
        $objProduct->set_regular_price($response["results"][0]["price"]); // set product regular price
  
        $objProduct->set_stock_quantity($response["results"][0]["qty"]);
        $objProduct->set_sku($response['results'][0]['kinguinId']);
        
        $productImagesIDs = array(); // define an array to store the media ids.
        $images = array($response['results'][0]["coverImage"]); // images url array of product
        foreach($images as $image){
            $mediaID = uploadMedia($image); // calling the uploadMedia function and passing image url to get the uploaded media id
            if($mediaID) $productImagesIDs[] = $mediaID; // storing media ids in a array.
        }
        if($productImagesIDs){
            $objProduct->set_image_id($productImagesIDs[0]); // set the first image as primary image of the product
            
            //in case we have more than 1 image, add them to product gallery. 
            if(count($productImagesIDs) > 1){
                $objProduct->set_gallery_image_ids($productImagesIDs);
            }
        }
        
        $product_id = $objProduct->save(); // it will save the product and return the generated product id
        wp_set_object_terms( $product_id, $response["results"][0]['genres'], 'product_cat' );
    }

    function getPrice() {
        return $this->price;
    }

    function getStock() {
        return $this->qty;
    }

}
