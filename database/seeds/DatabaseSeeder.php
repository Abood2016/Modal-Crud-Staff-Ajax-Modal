<?php

use App\Address;
use App\Image;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Address::class, 50)->create();
        factory(User::class , 50)->create();
        factory(Product::class, 100)->create();
        factory(Image::class, 200)->create();
    }
}
