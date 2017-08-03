<?php

ini_set('display_errors', true);

require 'database.php';

if (empty($_GET['id'])) {
    exit('Acesso negado!!!!');
}


//pego o id e guardo na variavel $id
$id =$_GET['id'];

// var_dump($id);

//a variavel $projeto recebe a funçao delete()com os paramentros $tabela e o $id
$projeto = delete('projeto', $id);

if ($projeto) {
    header('Location: index.php');
}

//  var_dump($projeto);
