<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tags = ['Cibo', 'Moda', 'Make-Up', 'Vino', 'Lettura', 'Europa', 'America', 'Asia', 'Albergo'];
        foreach ($tags as $tagname) {
            $tag = new Tag();
            $tag->name = $tagname;
            $tag->slug = Str::slug($tag->name);
            $tag->save();
        }
    }
}
