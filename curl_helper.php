<?php


/**
 * author: Andrzej Skowron
 * email: skwrn@outlook.com
 * 
 * Woocommerce - Kinguin API intergration
 */

namespace Kinguin\Http;

class CurlPost{
    private $url;
    private $options;
    private $headers;
    private $returnType;
    private $requestType;

    /**
     * @param string $url     Request URL
     * @param array  $options cURL options
     */
    public function __construct($url, array $options = [], $headers, $returnType, $requestType) {
        $this->url = $url;
        $this->options = $options;
        $this->headers = $headers;
        $this->returnType = $returnType;
        $this->requestType = $requestType;
    }

    /**
     * Get the response
     * @return string
     * @throws \RuntimeException On cURL error
     */
    public function __invoke(array $post) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if($this->requestType == 'order'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch,CURLOPT_POST, TRUE);             
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        }
        if($this->requestType == 'order'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, str_replace("\u0022","\\\\\"",json_encode( $this->options,JSON_HEX_QUOT)));
        } else {
            foreach ($this->options as $key => $val) {
                echo '$key';
                echo '<br/>';
                echo $key;
                curl_setopt($ch, $key, $val);
            }
        }
        $errno    = curl_errno($ch);

        switch ($this->returnType) {
            case 'HTTP':
                $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                break;
            case 'body':
                $response = curl_exec($ch);
                break;
            case 'both':
                curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
     
                $obj = [
                    'status' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
                     'body' => curl_exec($ch)
                    ];
                $response = $obj;
                $info = curl_getinfo($ch);
                break;
            default:
                $response = 'no response';
        }

        if (is_resource($ch)) {
            curl_close($ch);
        }

        if (0 !== $errno) {
            throw new \RuntimeException($error, $errno);
            curl_close($ch);
        }

        return $response;
    }
}