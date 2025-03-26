<?php

require 'vendor/autoload.php';
// panggil namespace
use GuzzleHttp\Client;

$client = new client();
    $response = $client->request('GET', 'https://omdbapi.com', [

        'query' => [
            'apikey' => '36115aa7',
            's' => 'avengers'
        ]

        ]);

    $result =  json_decode($response->getBody()->getContents(), true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($result['Search'] as $movie) : ?>
    <ul>
        <li>Ttitle : <?= $movie['Title'] ?> </li>
        <li>Year : <?= $movie['Year'] ?> </li>

        <img src="<?= $movie['Poster'] ?>" width="80">
    </ul>
    <?php endforeach ?>
</body>
</html>