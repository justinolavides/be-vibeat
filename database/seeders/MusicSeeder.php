<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicSeeder extends Seeder
{
    public function run()
    {
        DB::table('music')->insert([
            ['title' => 'Song 1', 'artist' => 'Artist 1', 'album' => 'Album 1', 'year' => 2020, 'audio_url' => 'http://example.com/song1.mp3'],
            ['title' => 'Song 2', 'artist' => 'Artist 2', 'album' => 'Album 2', 'year' => 2019, 'audio_url' => 'http://example.com/song2.mp3'],
            // Add more entries as needed
        ]);
    }
}
