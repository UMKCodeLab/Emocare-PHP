<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\aspirasi;
use Illuminate\Database\Seeder;
use App\Models\postingan;
use App\Models\User;
use App\Models\forum;
use App\Models\report;

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

        User::create([
            'id' => '1',
            'username' => 'admin',
            'role' => 'admin',
            'password' => '123456'
        ]);

        User::create([
            'id' => '2',
            'username' => 'user',
            'role' => 'user',
            'password' => '123456'
        ]);

        User::create([
            'id' => '3',
            'username' => 'psikiater',
            'role' => 'psikiater',
            'password' => '123456'
        ]);


        forum::create([
            'id' => '1',
            'user_id' => '2',
            'isi' => 'hai apa kabar kamu',
            'is_anonim' => true,
            'image' => null
        ]);


        forum::create([
            'id' => '3',
            'user_id' => '3',
            'isi' => 'hai apa kabar dia',
            'is_anonim' => false,
            'image' => null
        ]);

        aspirasi::create([
            'id' => '1',
            'user_id' => '2',
            'title' => 'makanan nasi goreng',
            'body' => 'nasi goreng adalah nasi goreng selalu makan nasi goreng',
            'image' => null
        ]);

        aspirasi::create([
            'id' => '2',
            'user_id' => '2',
            'title' => 'makanan nasi godog',
            'body' => 'nasi godong adalah nasi godogg selalu makan nasi gofog',
            'image' => null
        ]);

        aspirasi::create([
            'id' => '3',
            'user_id' => '2',
            'title' => 'makanan nasi rawut',
            'body' => 'nasi rawut adalah nasi rawut selalu makan nasi rawut',
            'image' => null
        ]);

        aspirasi::create([
            'id' => '4',
            'user_id' => '3',
            'title' => 'makanan nasi merah',
            'body' => 'nasi goreng adalah nasi goreng selalu makan nasi goreng',
            'image' => null
        ]);

    }
}
