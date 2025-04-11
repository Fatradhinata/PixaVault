<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Content;
use Illuminate\Database\Seeder;
use Database\Seeders\TagSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $user_id = fake()->uuid();

        // User::create([
        //     'id' => $user_id,
        //     'name' => 'fami0110',
        //     'email' => 'masandofami@gmail.com',
        //     'password' => '$2y$12$GL.0J7JkYJVhzBDL.iU2junCLJrriE9Dm6iLV7irxTG6Eo.U6PTYO',
        //     'verified_at' => date('Y-m-d H:i:s'),
        // ]);

        $this->call([
            TagSeeder::class,
        ]);
        

        Content::insert([
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Lightning',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'yoll1t6hv2ylgqc8qcpm',
                'shoot_by' => 'axioo',
                'tags' => '["Nature", "Random"]',
            ], 
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Leaves',
                'desc' => 'Elementum dolor elit semper vendor lorem elementum ipsum semper. Elementum eiusmod dolor. Porttitor nisi. Elit. Leo eiusmod aenean. Consectetur sed. Porttitor semper aenean lorem vendor porttitor nisi. Lorem. Sit aenean semper elit leo vendor elit aenean. Elit lorem elementum elit elementum porttitor. Tellus vivamus porttitor. Eiusmod vivamus nisi. Consectetur tellus elit sit porttitor leo elit lorem. Consectetur sit lorem ipsum porttitor consectetur porttitor. Leo vivamus lorem nisi porttitor eiusmod porttitor. Vendor tellus. Vivamus sit aenean vendor aenean tellus. Vendor lorem. Vendor leo sed vivamus. Elementum tellus lorem porttitor eiusmod sit leo. Sed ipsum elit porttitor sit elit sit. Vendor porttitor.',
                'photo' => 'qwjueey0bqctcclt14sh',
                'shoot_by' => 'Sony 17',
                'tags' => '["Potrait", "Nature"]',
            ],
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Waves',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'txqqlcy3mn47faky1guh',
                'shoot_by' => 'Sony 17',
                'tags' => '["Sea", "Nature"]',
            ],
            [
                'id' => fake()->uuid(),
                'id_user' => fake()->uuid(),
                'name' => 'Blooming Flower',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'p36woypktoix8bgaabal',
                'shoot_by' => 'Sony 17',
                'tags' => '["Nature", "Flower", "Landscape"]',
            ],
            [
                'id' => fake()->uuid(),
                'id_user' => fake()->uuid(),
                'name' => 'Pinus',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'xnz6q76o1zs5ebpy9njq',
                'shoot_by' => 'Sony 17',
                'tags' => '["Nature", "Potrait"]',
            ],
        ]);
    }
}
