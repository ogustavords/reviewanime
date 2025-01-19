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
        $animes = [
            [
                'title' => 'Gachiakuta',
                'description' => 'O menino: Rudo, vivia com o seu pai de criação: Legto, em uma comunidade bastante arruinada, cheia de lixo e entulhos. Aliás, “akuta” em japonês remete aos lixos, coisas inúteis e descartáveis. Mesmo nessas condições, ele conseguia manter a rotina devido a sua habilidade física. Entretanto, acusaram ele de um crime não cometido e ele foi condenado a ser jogado como um lixo no Naraku. Em portugues: Abismo.',
                'img_itens' => 'gachiakuta.jpeg'
            ],
            [
                'title' => 'Cowboy Bebop',
                'description' => 'Cowboy Bebop é uma série animada sobre um grupo de caçadores de recompensas que viajam pelo espaço. A história se passa em 2071, quando a humanidade se espalhou pelo sistema solar.',
                'img_itens' => 'cowboybepop.jpg'
            ],
            [
                'title' => 'Bungo Stray Dogs',
                'description' => 'A obra foca no cotidiano de uma agência de detetives e seus membros, indivíduos dotados de habilidades especiais capazes de resolver e solucionar mistérios e casos considerados fora do alcance da polícia e dos militares.',
                'img_itens' => 'bsd.jpg'
            ],
            [
                'title' => 'Blue Lock',
                'description' => 'A história acompanha a jornada de Isagi Yoichi, um garoto que pretende se tornar o maior atacante do mundo e ganhar a Copa do Mundo com seu país. ',
                'img_itens' => 'bluelock.jpg'
            ],
            [
                'title' => 'Chainsaw Man',
                'description' => 'A história se passa num mundo onde os demônios nascem dos medos humanos. Embora sejam geralmente perigosos e malévolos, os humanos podem firmar contratos com demônios para usar uma parte de seu poder.',
                'img_itens' => 'chainsawman.jpg'
            ],
            [
                'title' => 'Sousou no Frieren',
                'description' => 'Após uma missão de 10 anos ao lado do herói Himmel e seu grupo, a poderosa maga Frieren derrotou o Rei Demônio e trouxe paz ao reino. Como uma elfa, Frieren tem uma vida de mais de mil anos pela frente. Ela promete retornar para seus amigos e, assim, parte em uma jornada solitária.',
                'img_itens' => 'sousouf.jpeg'
            ],
            
        ];

        foreach ($animes as $anime) {
            Anime::create([
                'title' => $anime['title'],
                'description' => $anime['description'],
                'img_itens' => $anime['img_itens'],
            ]);
        }
    }
}
