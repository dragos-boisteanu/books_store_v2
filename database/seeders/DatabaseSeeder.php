<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Book;
use App\Models\Stock;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CountySeeder;
use Database\Seeders\AddressSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountySeeder::class,
            RoleSeeder::class,

            UserSeeder::class,
            AddressSeeder::class,

            CategorySeeder::class,
            CoverSeeder::class,
            LanguageSeeder::class,
            PublisherSeeder::class,

            PaymentMethodSeeder::class,
            ShippingMethodSeeder::class,
    
            StatusSeeder::class

        ]);

        Book::factory()->count(300)->create();
        Author::factory()->count(10)->create();
        Tag::factory()->count(100)->create();

        $authors = Author::all();

        Book::all()->each(function ($book) use ($authors) { 
            $book->authors()->attach(
                $authors->random(rand(1, 5))->pluck('id')->toArray()
            ); 
        });

        $tags = Tag::all();

        Book::all()->each(function ($book) use ($tags) { 
            $book->tags()->attach(
                $tags->random(rand(1, 10))->pluck('id')->toArray()
            ); 
        });

        Book::all()->each(function ($book) {
            $book->stock()->create(['book_id'=>$book->id, 'quantity'=>rand(1,25), 'created_by'=>1, 'updated_by'=>1]);
        });

    }
}
