<?php
use App\Misc\AsLoggedInUserTrait;
use App\Stock\ProductVersion;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 10/8/15
 * Time: 9:57 AM
 */

class ProductVersionsTest extends TestCase {
    
    use DatabaseMigrations, AsLoggedInUserTrait;

    /**
     * @test
     */
    public function it_adds_a_version_to_a_product()
    {
        $product = factory(\App\Stock\Product::class)->create();

        $this->visit('/admin/products/'.$product->id.'/versions/create');
        $this->submitForm('Add version', [
            'version_name' => 'Soft salmon',
            'description' => 'A more metrosexual affair'
        ])->seeInDatabase('product_versions', [
            'product_id' => $product->id,
            'version_name' => 'Soft salmon',
            'description' => 'A more metrosexual affair'
        ]);
    }

    public function it_can_edit_a_product_version()
    {
        $version = factory(ProductVersion::class)->create();

        $this->visit('/admin/versions/'.$version->id.'/edit')
            ->type('mooz in blue', 'version_name')
            ->type('makes it all okay', 'description')
            ->press('Save changes')
            ->seeInDatabase('product_versions', [
                'product_id' => $version->product_id,
                'version_name' => 'mooz in blue',
                'description' => 'makes it all okay'
            ]);
    }

}