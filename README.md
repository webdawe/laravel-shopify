# laravel-shopify
Laravel Shopify Package

Package: Webdawe/Shopify
Shopify Manager
Shopify Facade

#Example Usage in controller
```
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use ShopifyApi;
class ProductApiController extends Controller
{
    /**
     * Get Product
     * @param [type] $id
     * @return string
     */
    public function get($id)
    {
        return ShopifyApi::getProduct($id);
    }
    /**
     * Retrieve all products
     *
     * @return json
     */
    public function all()
    {
        return ShopifyApi::getAllProducts();
    }
    
}
```
#usage in Console to Sync To Shopify
```
ShopifyApi::addProduct($data)
```
