<?php

use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(UserTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        \App\User::truncate();

        factory('App\User')->create(['email' => 'joe@example.com', 'password' => 'password']);
    }
}

class ProductsTableSeeder extends Seeder {

    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->delete();

        $category = factory(Category::class)->create();

        factory(Product::class, 12)->create(['category_id' => $category->id]);
    }
}
