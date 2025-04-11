<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Content;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user_id = fake()->uuid();

        User::create([
            'id' => fake()->uuid(),
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'pixavaultt@gmail.com',
            'password' => '$2y$12$nwMoptaNZEbguk.FwaqMee1ZGTQrzPxrvTTI2Wxrga4QnsR.y6ZmS',
            'verified_at' => date('Y-m-d H:i:s'),
        ]);

        User::create([
            'id' => $user_id,
            'name' => 'fami0110',
            'photo' => 'profile_67f4b69966ba81.68936057.png',
            'email' => 'masandofami@gmail.com',
            'password' => '$2y$12$GL.0J7JkYJVhzBDL.iU2junCLJrriE9Dm6iLV7irxTG6Eo.U6PTYO',
            'verified_at' => date('Y-m-d H:i:s'),
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
        ]);

        $user_id = fake()->uuid();

        User::create([
            'id' => $user_id,
            'name' => 'Fami',
            'photo' => 'profile_67f7e59db16b52.72854008.png',
            'email' => 'masando0110@gmail.com',
            'password' => bcrypt('fami123'),
            'verified_at' => date('Y-m-d H:i:s'),
        ]);

        Content::insert([
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Blooming Flower',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'p36woypktoix8bgaabal',
                'shoot_by' => 'Sony 17',
                'tags' => '["Nature", "Flower", "Landscape"]',
            ],
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Pinus',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'xnz6q76o1zs5ebpy9njq',
                'shoot_by' => 'Sony 17',
                'tags' => '["Nature", "Potrait"]',
            ],
        ]);
    }
}
