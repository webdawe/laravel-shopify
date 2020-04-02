<?php
/**
 * @category    Webdawe
 * @package     Webdawe_Shopify
 * @author      Anil Paul
 * @copyright   Copyright (c) 2019 Webdawe.
 * @license
 */

namespace Webdawe\Shopify\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * Class ShopifyApi
 *
 * Facade for the Laravel Framework
 */
class ShopifyApi extends Facade
{
    /**
     * Return Webdawe\Shopify\ShopifyManager singleton.
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    {
         return 'shopifyapi'; 
    }
}