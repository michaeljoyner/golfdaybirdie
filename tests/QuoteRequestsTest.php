<?php
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/14/15
 * Time: 10:53 AM
 */
class QuoteRequestsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_generates_a_quote_request_on_checkout()
    {
        $product1 = factory(\App\Stock\Product::class)->create();
        $product2 = factory(\App\Stock\Product::class)->create();

        $personInfo = [
            'name'    => 'Billy Bob',
            'email'   => 'joe@example.com',
            'address' => '26 Ottoman road, Durban, KZN',
            'phone'   => '033 321 4567',
            'enquiry' => 'How long does this take?'
        ];

        $productInfo = [
            'product_'.$product1->id => '24',
            'product_'.$product2->id => '36'
        ];

        $imageInfo = [
          'logo_images' => ['foo.jpg', 'bar.png']
        ];

        $this->withoutMiddleware();

        Cart::add($product1->id, $product1->name, 1, 0.00, []);
        Cart::add($product2->id, $product2->name, 1, 0.00, []);

        $this->call('POST', '/checkout', array_merge($personInfo, $productInfo, $imageInfo));

        $this->seeInDatabase('quote_requests', $personInfo);
        $this->seeInDatabase('quote_products', [
            'product_name' => $product1->name,
            'quantity' => 24
        ]);
        $this->seeInDatabase('quote_products', [
            'product_name' => $product2->name,
            'quantity' => 36
        ]);
        $this->seeInDatabase('quote_images', ['image_path' => 'foo.jpg']);
        $this->seeInDatabase('quote_images', ['image_path' => 'bar.png']);

    }

}