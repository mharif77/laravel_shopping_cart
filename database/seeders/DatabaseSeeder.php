<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        DB::table('books')->insert([
            'name' => 'Android smartphone with a 6.5',
            'author' => 'Android smartphone',
            'image' => 'https://picsum.photos/seed/picsum/200/300',
            'price' => 698.88
        ]);

        DB::table('books')->insert([
            'name' => 'Digital Camera EOS',
            'author' => 'Abdullah',
            'image' => 'https://picsum.photos/seed/picsum/200/300',
            'price' => 983.00
        ]);

        DB::table('books')->insert([
            'name' => 'LOIS CARON Watch',
            'author' => 'Android smartphone',
            'image' => 'http://example.com/storage/app/public/products/watch.jpg',
            'price' => 675.00
        ]);

        DB::table('books')->insert([
            'name' => 'Elegante unisex adult square',
            'author' => 'Mohiuddin',
            'image' => 'http://example.com/storage/app/public/products/sunclass.jpg',
            'price' => 159.99
        ]);

        DB::table('books')->insert([
            'name' => 'Large Capacity Folding Bag',
            'author' => 'Mohiuddin',
            'image' => 'http://example.com/storage/app/public/products/bag.jpg',
            'price' => 68.00
        ]);

        DB::table('books')->insert([
            'name' => 'Lenovo Smartchoice Ideapad 3',
            'author' => 'Mohiuddin',
            'image' => 'http://example.com/storage/app/public/products/laptop.jpg',
            'price' => 129.99
        ]);
    }
}
