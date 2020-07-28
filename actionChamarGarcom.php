<?php


require 'config.php';
require 'connection.php';
require 'database.php';

$numeroMesa = (int) $_POST['numeroMesa'];

$result = DBExecute("update mesa set requerAtendimento = TRUE where numeroMesa = {$numeroMesa} and situacao = 'Aberta';");

header("Location: index.php");//VOLTA PRA PAGINA ANTERIOR