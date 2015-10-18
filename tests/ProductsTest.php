<?php
use App\Misc\AsLoggedInUserTrait;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/5/15
 * Time: 11:16 AM
 */

class ProductsTest extends TestCase {

    use DatabaseMigrations, AsLoggedInUserTrait;


    /**
     * @test
     */
    public function it_adds_a_new_product_to_the_correct_category()
    {
        $category = factory(\App\Stock\Category::class)->create();
        $product = factory(Product::class)->make();

        $this->visit('admin/categories/'.$category->id.'/addproduct')
            ->submitForm('Add Product', [
                'name' => $product->name,
                'quantity' => $product->quantity,
                'description' => $product->description
            ])->seeInDatabase('products', [
                'category_id' => $category->id,
                'name' => $product->name,
                'quantity' => $product->quantity,
                'description' => $product->description
            ]);
    }

    /**
     * @test
     */
    public function it_can_edit_an_existing_product()
    {
        $product = factory(Product::class)->create();

        $this->visit('/admin/products/'.$product->id.'/edit')
            ->type('Mooz', 'name')
            ->type('12', 'quantity')
            ->type('sexy', 'description')
            ->press('Save Changes')
            ->seeInDatabase('products', [
                'id' => $product->id,
                'name' => 'Mooz',
                'quantity' => '12',
                'description' => 'sexy'
            ]);
    }

    /**
     * @test
     */
    public function it_deletes_a_given_product()
    {
        $product = factory(Product::class)->create();

        $this->withoutMiddleware()
             ->call('DELETE', '/admin/products/'.$product->id);

        $this->notSeeInDatabase('products', [
            'id' => $product->id,
            'name' => $product->name
        ]);
    }

}