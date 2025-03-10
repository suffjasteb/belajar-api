<?php

$data = file_get_contents("coba.json");

$data = json_decode($data, true);
var_dump($data);
echo $data[0]["pembimbing"]["pembimbing1"] // beni

?>