<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Content;
use App\Models\Subscription;
use Carbon\Carbon;
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
            'name' => 'sando0106',
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
                'downloads' => fake()->numberBetween(800, 1000),
                'likes' => fake()->numberBetween(800, 1000),
                'views' => fake()->numberBetween(800, 1000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], 
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Leaves',
                'desc' => 'Elementum dolor elit semper vendor lorem elementum ipsum semper. Elementum eiusmod dolor. Porttitor nisi. Elit. Leo eiusmod aenean. Consectetur sed. Porttitor semper aenean lorem vendor porttitor nisi. Lorem. Sit aenean semper elit leo vendor elit aenean. Elit lorem elementum elit elementum porttitor. Tellus vivamus porttitor. Eiusmod vivamus nisi. Consectetur tellus elit sit porttitor leo elit lorem. Consectetur sit lorem ipsum porttitor consectetur porttitor. Leo vivamus lorem nisi porttitor eiusmod porttitor. Vendor tellus. Vivamus sit aenean vendor aenean tellus. Vendor lorem. Vendor leo sed vivamus. Elementum tellus lorem porttitor eiusmod sit leo. Sed ipsum elit porttitor sit elit sit. Vendor porttitor.',
                'photo' => 'qwjueey0bqctcclt14sh',
                'shoot_by' => 'Sony 17',
                'tags' => '["Potrait", "Nature"]',
                'downloads' => fake()->numberBetween(800, 1000),
                'likes' => fake()->numberBetween(800, 1000),
                'views' => fake()->numberBetween(800, 1000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Waves',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'txqqlcy3mn47faky1guh',
                'shoot_by' => 'Sony 17',
                'tags' => '["Sea", "Nature"]',
                'downloads' => fake()->numberBetween(800, 1000),
                'likes' => fake()->numberBetween(800, 1000),
                'views' => fake()->numberBetween(800, 1000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
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
                'downloads' => fake()->numberBetween(1000, 2000),
                'likes' => fake()->numberBetween(1000, 2000),
                'views' => fake()->numberBetween(1000, 2000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => fake()->uuid(),
                'id_user' => $user_id,
                'name' => 'Pinus',
                'desc' => 'Lorem tellus ipsum elit nisi leo elementum. Consectetur lorem vivamus. Consectetur sit lorem vivamus ipsum.',
                'photo' => 'xnz6q76o1zs5ebpy9njq',
                'shoot_by' => 'Sony 17',
                'tags' => '["Nature", "Potrait"]',
                'downloads' => fake()->numberBetween(1000, 2000),
                'likes' => fake()->numberBetween(1000, 2000),
                'views' => fake()->numberBetween(1000, 2000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        $images_selection_id = [
            'yoll1t6hv2ylgqc8qcpm',
            'qwjueey0bqctcclt14sh',
            'txqqlcy3mn47faky1guh',
            'p36woypktoix8bgaabal',
            'xnz6q76o1zs5ebpy9njq',
            'c0rbjxqrzsxqafiajv4q',
            'lajeomwg7pmgr0lq5wlp',
            'j8vbhkz0gcuxpdlst7mv',
            'wke5wyojumudxvg76ct3',
            'wltedrnczkxwzdpp4kqt',
            // 'bqivn3pmyxya3ggxyosr',
        ];

        // Add more user and content
        for ($i = 0; $i < 20; $i++) {
            $user_id = fake()->uuid();

            User::create([
                'id' => $user_id,
                'name' => fake()->userName(),
                'email' => fake()->email(),
                'password' => bcrypt('password123'),
                'verified_at' => date('Y-m-d H:i:s'),
            ]);

            Subscription::create([
                'user_id' => $user_id,
                'plans' => 'Premium',
                'status' => 'active',
                'date_limit' => Carbon::now()->addMonth()->toDateTimeString(),
            ]);

            $data = [];

            for ($j = 0; $j < 10; $j++) {
                array_push($data, [
                    'id' => fake()->uuid(),
                    'id_user' => $user_id,
                    'name' => fake()->sentence(3),
                    'desc' => fake()->paragraph(2),
                    'photo' => $images_selection_id[array_rand($images_selection_id)],
                    'shoot_by' => fake()->word(),
                    'tags' => json_encode([fake()->word(), fake()->word(), fake()->word()]),
                    'downloads' => fake()->numberBetween(0, 900),
                    'likes' => fake()->numberBetween(0, 900),
                    'views' => fake()->numberBetween(0, 900),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            Content::insert($data);
        }

    }
}
