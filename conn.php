<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetogames_2026";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Houve falha na conexão com o banco de dados" . mysqli_connect_error());
}





?>