<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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

        Product::factory(20)->create();
        Category::factory(3)->create();

        $this->call(RoleAndPermissionSeeder::class);

        $this->call(AdminSeeder::class);





    }
}
