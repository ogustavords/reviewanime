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
                'description' => 'Em Gachiakuta, Rudo vive em uma comunidade destruída, onde o lixo é uma presença constante. Ele é acusado injustamente de um crime e é enviado ao Naraku, um abismo onde pessoas consideradas "inúteis" são descartadas. Sua habilidade física é a única coisa que ele consegue manter enquanto luta por sua sobrevivência.',
                'img_itens' => 'gachiakuta.jpg'
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
                'title' => 'Attack on Titan',
                'description' => 'A história começa em um mundo onde a humanidade vive dentro de três cidades concêntricas, cada uma protegida por enormes paredes contra os ataques de Titãs, seres humanóides gigantescos que devoram humanos sem motivo aparente. Segue as aventuras de Eren Yeager e seus amigos Mikasa Ackerman e Armin Arlert, cujas vidas mudaram depois que um Titã Colossal rompe o muro de sua cidade natal. Jurando vingança e recuperar o mundo dos Titãs, Eren e seus amigos se juntam à Divisão de Reconhecimento, um grupo de elite de soldados do exército que lutam contra os Titãs. ',
                'img_itens' => 'aot.jpg'
            ],
            [
                'title' => 'Death Note',
                'description' => 'A história centra-se em Light Yagami, um estudante do ensino médio que descobre um caderno sobrenatural chamado Death Note, no qual pode matar pessoas se os nomes forem escritos nele enquanto o portador visualizar mentalmente o rosto de alguém que quer assassinar. Então, cansado da monotonia e das injustiças diárias que ocorriam por parte de criminosos, Light tenta eliminar todos os que um dia cometeram crimes e criar um mundo onde não exista o mal, Mas seus planos são interrompidos por L, um famoso detetive particular.',
                'img_itens' => 'deathnote.jpg'
            ],
            [
                'title' => 'Nana',
                'description' => 'Duas garotas chamadas Nana se encontram em um trem rumo a Tóquio por acaso. Depois de uma série de coincidências, elas acabam vivendo juntas em um apartamento de número 707 ("ナナ, romanizado: nana" significa "sete", em japonês, que é o nome das duas protagonistas). Apesar de terem personalidades e ideais diferentes, as duas acabam se tornando amigas "por obra do destino". ',
                'img_itens' => 'nana.jpg'
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
