<!-- mengubah array menjadi json -->

<?php 

// $mahasiswa = [
//     [
//     "nama" => "Budi",
//     "nrp" => "429389283",
//     "email" => "budionosiregar@gmail.com"
//     ],
//     [
//     "nama" => "Beni",
//     "nrp" => "429389283",
//     "email" => "budionosiregar@gmail.com"
//     ],
// ];

// database handler
$dbh = new PDO("mysql:host=localhost;dbname=mahasiswa", "root", "");
$db = $dbh->prepare("SELECT * FROM mahasiswa");
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo $data;

?>