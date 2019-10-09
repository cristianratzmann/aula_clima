<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$baseUrl = 'http://api.openweathermap.org';
$appid = 'fef4c10164fe6f9816d9061b6028c937';
$id = '3468879';

//Recupera a data de criação dos dados

$dataCriacao = file_get_contents('cache/validade_tempo.txt');

if (time() - $dataCriacao >= 300) {


    try {
        $client = new Client(array('base_uri' => $baseUrl));

        $response = $client->get('/data/2.5/weather', array(
            'query' => array('appid' => $appid, 'id' => $id)
        ));
        $tempo = json_decode($response->getBody());
        $dadosSerializados = serialize($tempo);
        file_put_contents('cache/dados_tempo.txt', $dadosSerializados);
        file_put_contents('cache/validade_tempo.txt', time());
    } catch (ClientException $e) {
        echo 'falha ao obter informações';
    }
} else {

    $dadosSerializados = file_get_contents('cache/dados_tempo.txt');
    $tempo = unserialize($dadosSerializados);
}
echo 'Temperatura: '; echo $tempo->main->temp - 273; echo'<br/>';
echo 'Pressão: ';echo $tempo->main->pressure; echo'<br/>';
echo 'Humidade: ';echo $tempo->main->humidity; echo'<br/>';
echo 'Temperatura Min: ';echo $tempo->main->temp_min - 273; echo'<br/>';
echo 'Temperatura Max: ';echo $tempo->main->temp_max - 273; echo'<br/>';
?>
 