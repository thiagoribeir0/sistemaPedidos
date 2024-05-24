<?php

$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';
$port = 3312;

$mysqli = new mysqli($host, $usuario, $senha, $database, $port);

if($mysqli->error){
    die("Falha ao conectar no banco de dados: " . $mysqli->error);
}