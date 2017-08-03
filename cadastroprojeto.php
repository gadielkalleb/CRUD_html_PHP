<?php

require 'database.php';


$nomeProjeto=$_POST['nome-projeto'];
$custoHora=$_POST['custo-hora'];
$totalHoras=$_POST['total-horas'];

// var_dump($_POST);

$projeto = insert('projeto',[
    'nome_projeto'=>$nomeProjeto,
    'custo_hora'=>$custoHora,
    'total_horas'=>$totalHoras]
    );

if ($projeto) {
    header('Location: index.php');
}

