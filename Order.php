<?php


/**
 * author: Andrzej Skowron
 * email: skwrn@outlook.com
 * 
 * Woocommerce - Kinguin API intergration
 */

namespace Kinguin\Order;

class Orders{
    private $ordersObj,
            $orderIDKinguin,
            $dispatchID,
            $woo_order_id,
            $wrappedKeys;

    public function __construct($orders = NULL,$woo_order_id) {
        $this->ordersObj = $orders;
        $this->woo_order_id = $woo_order_id;
    }

    public function createProductsJson() {
        foreach ($this->ordersObj as $key => $value) {
            $order = new Order($value->kinguinId, $value->qty, $value->price, $value->name);
            $orderJSON = $order->createProductJSON;
        }
        
        return json_encode($this->ordersObj);
    }

    public function sendKinguinOrder() {
        $JSON = json_decode(json_encode($this->ordersObj), True);

        try {
            $response = getResponse(getConfigVar("api_url"), "order", [], (array)$JSON,'both','order');

            if($response['body'] == 0 || $response['status'] == 201){
                $this->orderIDKinguin = json_decode($response['body'])->orderId;
                $this->dispatchKinguinOrder();
                try{
                    $this->updateOrderMeta('_order_id_kinguin',$this->orderIDKinguin);
                } catch(Exception $e){
                    error_log("dispatchKinguinOrder:");
                    error_log(print_r($e,true));
                }
            } else {
                error_log('response status');
                error_log($response['body']->code);
            }
        } catch(Exception $e){
            error_log($e);
        }
    }

    public function dispatchKinguinOrder() {
        $response = getResponse(getConfigVar("api_url"), "order/dispatch",[], ["orderId" => $this->orderIDKinguin], 'both','order');

        if($response['status'] == 201 || $response['status'] == 0){
            $this->dispatchID = json_decode($response['body'])->dispatchId;
            $this->getOrderKeys();
            try{
                $this->updateOrderMeta('dispatchId',$this->dispatchID);
            } catch(Exception $e){
                error_log("dispatchKinguinOrder:");
                error_log(print_r($e,true));
            }
        }
    }

    public function getOrderKeys() {
        $response = getResponse(getConfigVar("api_url"), "order/dispatch/keys",['dispatchId' => $this->dispatchID],[],'both','');
      
        if($response['status'] == 200 || $response['status'] == 0){

            $decodedResponse = json_decode($response['body']);

            $keys = '';

            foreach($decodedResponse as $decodedItemKeys){
                $serial = $decodedItemKeys->serial;
                $type = $decodedItemKeys->type;
                $kinguinId = $decodedItemKeys->kinguinId;
                $name = $decodedItemKeys->name;

                if($type == "text/plain"){
                    $keys .= '<li>'. '<span>'. (string)$name. '</span>' . '<p>'.(string)$serial.'</p>' .'</li>';
                } else {
                    $keys .= '<li>'. '<span>'. (string)$serial. '</span>' . '<img src="data:image/png;base64, '. (string)$serial .'"/>' .'</li>';
                }
            }
            $wrappedKeys = '<div class="keys-wrapper"><ul>'. $keys .'</ul></div>';
            $this->wrappedKeys = $wrappedKeys;
            add_post_meta( $this->woo_order_id, 'keys', $wrappedKeys);
            try{
                $this->updateOrderMeta('order_keys',$wrappedKeys);
                $order =  wc_get_order( $this->woo_order_id );
                send_email_woocommerce($order->get_billing_email(), 'Your Kinguin Keys', 'Keys', $this->prepareEmailMessage($order));

            } catch(Exception $e){
                error_log("dispatchKinguinOrder:");
                error_log(print_r($e,true));
            }
        } else return false;
    }


    function before_checkout_create_order( $order, $data ) {
        $order->update_meta_data( 'Your keys', $this->wrappedKeys );
    }

    public function updateOrderMeta(string $key,$value){
        $order = wc_get_order( $this->woo_order_id );
        $order->update_meta_data( $key, $value );
        $order->save();
    }

    public function prepareEmailMessage($order){
        $items = $order->get_items(); 
        $message = 'Your keys: ';
      
        $message .= get_post_meta( $order->get_id(), 'keys', true );
        return $message;
    }
}

