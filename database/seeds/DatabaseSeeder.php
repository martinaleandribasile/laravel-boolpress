<?php

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
        // chiamo i miei seeder all interno di una call -> da terminale mandero' solo php artisan db:seed --> e in automatico eseguira' tutti i seed elencati
        // importante l ordine dei seed che chiamo, se ho tabelle con foreign key devo prima popolare la tavbella associata a quella chiave esterna
        $this->call(CategoryTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
