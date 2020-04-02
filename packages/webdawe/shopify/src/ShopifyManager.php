<?php
/**
 * @category    Webdawe
 * @package     Webdawe_Shopify
 * @author      Anil Paul
 * @copyright   Copyright (c) 2019 Webdawe.
 * @license
 */
namespace  Webdawe\Shopify;

use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;


class ShopifyManager
{
    /**
     * Client
     */
    protected $client = null;
    
    /** @var array $options */
    protected $options = array();
   
    const PRODUCTS_URI = "/admin/api/2019-10/products.json";
    const PRODUCT_URI = "/admin/api/2019-10/products/{ID}.json";

    /**
     * Retrieve Guzzle Client
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->init();
        }
        return $this->client;
    }
    /**
     * Initialise Guzzle Client
     * 
     * @param $store
     * @param $token
    */
    public function init($store = null, $token = null)
    {
        
        if (!$store) {
            $store = env('SHOPIFY_STORE');
        }
        if (!$token) {
            $token = env('SHOPIFY_API_TOKEN');
        }
        $baseUrl = "https://{$store}.myshopify.com";
       
        $config = [
            'base_url' => $baseUrl,
            'headers' => [
                'Accept' => '*/*',
                'Content-Type' => 'application/json'
            ]
        ];
       
        $this->options = $config;
        $this->baseUrl = $baseUrl;
        $this->client = new Client($config);
        
    }
    
    /**
     * Request get method
     *
     * @param [type] $uri
     * @param array $data
     * @return array
     */
    public function getResponse($uri, $data = array()) {
        $response = $this->getClient()->get($this->options['base_url']. $uri);
        return $response->getBody();
    }

    /**
     * Request Post Method
     *
     * @param [type] $uri
     * @param array $data
     * @return void
     */
    public function postResponse($uri, $data = array()) {
        try {
            $stream = \GuzzleHttp\Psr7\stream_for(json_encode($data));
            $response = $this->getClient()->post($this->options['base_url'].  $uri,
            ['body' => $stream,
            ]);
            

        }
        catch (ClientErrorResponseException $exception) {
            return $exception->getResponse()->getBody(true);
        }
      
        return $response->getBody()->getContents();
    }

    /**
     * Retrieve Product
     *
     * @param [type] $id
     * @return json
     */
    public function getProduct($id = null)
    {
        if ($id) {
          
            $uri = Str::replaceFirst('{ID}', $id, self::PRODUCT_URI);
            return $this->getResponse($uri);
        }
        return array();
    }
    /**
     * Retrieve all Products
     *
     * @param [type] $id
     * @return string
     */
    public function getAllProducts($id = null)
    {
      return $this->getResponse(self::PRODUCTS_URI);
    }
    /**
     * Create Product
     *
     * @param array $data
     * @return void
     */
    public function addProduct(array $data) {
       return $this->postResponse(self::PRODUCTS_URI, $data);
    }
}