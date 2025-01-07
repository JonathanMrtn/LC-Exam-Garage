<?php

function connectDB(){
  // require_once '../vendor/autoload.php';

  // $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  // $dotenv->load();

  // // Accéder aux variables d'environnement
  // $host = $_ENV['DB_HOST'];
  // $user = $_ENV['DB_USER'];
  // $password = $_ENV['DB_PASSWORD'];
  // $database = $_ENV['DB_NAME'];

  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'garagetrain2';
  $conn = new mysqli($host, $user, $password, $database);

  if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
  }
  else{
    return $conn;
  }
}

