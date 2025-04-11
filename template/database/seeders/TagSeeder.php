<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            "Nature", "Architecture", "People", "Technology", "Animals", "Travel", "Art",
            "Food", "Fashion", "Business", "City", "Mountains", "Ocean", "Sunset", "Beach",
            "Forest", "Desert", "Night", "Sky", "Stars", "Rain", "Snow", "Flowers", "Street",
            "Vintage", "Abstract", "Macro", "Portrait", "Landscape", "Minimal", "Adventure",
            "Culture", "Music", "Festival", "Aerial", "Drone", "Wildlife", "Waterfall", "Canyon",
            "Monument"
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'id' => (string) Str::uuid(),
                'name' => $tag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
