<?php
/**
 * @category    Webdawe
 * @package     Webdawe_Shopify
 * @author      Anil Paul
 * @copyright   Copyright (c) 2019 Adore Beauty.
 * @license
 */

declare(strict_types=1);

namespace Webdawe\Shopify\Providers;

use Illuminate\Support\ServiceProvider;
use Guzzle\Http\Client as GuzzleClient;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\App;
use Webdawe\Shopify\ShopifyManager;

class ShopifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('shopifyapi', function (Container $app): ShopifyManager {
            return new ShopifyManager;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
     
    }
}
