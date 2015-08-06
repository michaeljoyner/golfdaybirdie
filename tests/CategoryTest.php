<?php
use App\Misc\AsLoggedInUserTrait;
use App\Stock\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/4/15
 * Time: 10:47 AM
 */

class CategoryTest extends TestCase {

    use DatabaseMigrations, AsLoggedInUserTrait;

    /**
     * @test
     */
    public function it_creates_a_category()
    {
        $categoryInfo = factory(Category::class)->make();

        $this->visit('/admin/categories/create')
            ->submitForm('Add Category', ['name' => $categoryInfo->name, 'description' => $categoryInfo->description])
            ->seeInDatabase('categories', [
                'name' => $categoryInfo->name,
                'description' => $categoryInfo->description
            ]);
    }

    /**
     * @test
     */
    public function it_can_edit_a_category()
    {
        $category = factory(Category::class)->create();

        $this->visit('/admin/categories/'.$category->id.'/edit')
            ->type('Mooz', 'name')
            ->type('Foobar', 'description')
            ->press('Save Changes')
            ->seeInDatabase('categories', [
                'id' => $category->id,
                'name' => 'Mooz',
                'description' => 'Foobar'
            ]);
    }

    /**
     * @test
     */
    public function it_deletes_a_giver_category()
    {
        $category = factory(Category::class)->create();

        $this->withoutMiddleware();

        $this->call('DELETE', '/admin/categories/'.$category->id);

        $this->notSeeInDatabase('categories', ['id' => $category->id]);
    }

}