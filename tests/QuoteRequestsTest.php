<?php
use App\Misc\AsLoggedInUserTrait;
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

    use DatabaseMigrations, AsLoggedInUserTrait;

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

    /**
     * @test
     */
    public function it_deletes_a_quote_request()
    {
        $quoteRequest = factory(\App\Quotes\QuoteRequest::class)->create();

        $this->withoutMiddleware();
        $this->call('DELETE', '/admin/quoterequests/'.$quoteRequest->id);

        $this->notSeeInDatabase('quote_requests',[
            'id' => $quoteRequest->id,
            'name' => $quoteRequest->name
        ]);
    }

    /**
     * @test
     */
    public function it_archives_a_quote_request()
    {
        $quoteRequest = factory(\App\Quotes\QuoteRequest::class)->create();

        $this->visit('/admin/quoterequests/archive/'.$quoteRequest->id);

        $this->seeInDatabase('quote_requests', [
            'id' => $quoteRequest->id,
            'archived' => 1
        ]);

        $this->visit('/admin/quoterequests')
            ->see($quoteRequest->name, true);

        $this->visit('/admin/quoterequests/archives')
            ->see($quoteRequest->name);
    }

    /**
     * @test
     */
    public function it_shows_all_archived_quote_requests()
    {
        $quoteRequests = factory(\App\Quotes\QuoteRequest::class, 3)->create(['archived' => 1]);

        $this->visit('/admin/quoterequests/archives');

        foreach($quoteRequests as $quoteRequest) {
            $this->see($quoteRequest->name);
        }
    }

    /**
     * @test
     */
    public function it_unarchives_an_archived_quote_request()
    {
        $quoteRequest = factory(\App\Quotes\QuoteRequest::class)->create(['archived' => 1]);

        $this->visit('/admin/quoterequests/archive/'.$quoteRequest->id);

        $this->seeInDatabase('quote_requests', [
            'id' => $quoteRequest->id,
            'archived' => 0
        ]);

        $this->visit('/admin/quoterequests')
            ->see($quoteRequest->name, false);

        $this->visit('/admin/quoterequests/archives')
            ->see($quoteRequest->name, true);
    }



}