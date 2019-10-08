<?php
       
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$baseUrl = 'https://api.openweathermap.org';
$appid = 'fef4c10164fe6f9816d9061b6028c937';
$id = '3468879';

$client = new Client(array('base_uri' => $baseUrl));

$response = $client->get('/data/2.5/weather', array(
    'query' =>array('appid' => $appid, 'id' => $id)
));
        print_r($response);

?>
 