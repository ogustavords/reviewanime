<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anime;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Anime::create([
            'title' => 'Naruto',
            'description' => 'Um jovem ninja sonha em se tornar o Hokage, o líder de sua vila.',
        ]);

        Anime::create([
            'title' => 'Attack on Titan',
            'description' => 'Humanos lutam pela sobrevivência contra gigantes que devoram pessoas.',
        ]);

        Anime::create([
            'title' => 'One Piece',
            'description' => 'Um jovem pirata busca o tesouro lendário conhecido como One Piece.',
        ]);
    }
}
