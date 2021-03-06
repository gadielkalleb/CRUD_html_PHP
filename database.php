<?php

require 'config.php';


/*======================================
///            FUNÇÃO CONECTA      //// 
======================================*/
function conecta(){

    $con=mysqli_connect(HOST, USER, PASS, DB);

    if (mysqli_connect_error()) {
        exit('Erro ao se conectar');
    }
    return $con;
}

/*======================================
///    FUNÇÃO  SELECT ALL       //// 
======================================*/

function selectAll($tabela, $campos='*'){
    $con = conecta();

    $select = "SELECT $campos FROM $tabela";

    $res = mysqli_query($con, $select);

    if (mysqli_error($con)){
        exit(mysqli_error());
    }
    return mysqli_fetch_all($res, MYSQLI_ASSOC);

}

/*======================================
///            FUNÇÃO  SELECT       //// 
======================================*/
function select($tabela, $filtro, $campos='*'){
    $con = conecta();

    $select = "SELECT $campos FROM $tabela WHERE $filtro";

    $res = mysqli_query($con, $select);

    if (mysqli_error($con)){
        exit(mysqli_error());
    }

    return mysqli_fetch_assoc($res);
}


/*======================================
///            FUNÇÃO  INSERT       //// 
======================================*/
function insert($tabela, array $input) {
    $campos = array_keys($input);

    $campos = implode(', ', $campos);

    foreach ($input as $valor) {
        if (is_numeric($valor)) {
            $valores[] = $valor;
        } else {
            $valores[] = "'$valor'";
        }
    }

    $vals = implode(', ', $valores);

    $insert = "INSERT INTO $tabela ($campos) VALUES ($vals)";

    $con = conecta();

    $res = mysqli_query($con, $insert);

    if ($res === false) {
        exit('Erro ao realizar a operação');
    }
    
    return $res;
}


/*======================================
///            FUNÇÃO  UPDATE      //// 
======================================*/
function update($tabela, array $campos, array $valores, int $id){
   
    foreach ($valores as $chave => $valor) {
        
        if (is_numeric($valor)){
            $query[]= "{$campos[$chave]}=$valor";
        }else {
            $query[]= "{$campos[$chave]}='$valor'";
        }
    }
    $atribs = implode(','.$query);

    $update = "UPDATE $tabela SET $atribs WHERE id=$id";

    $con = conecta();

    $res = mysqli_query($con, $update);

    if ($res === false){
        exit('Erro na operação');
    }

    return $res;
}


/*======================================
///            FUNÇÃO DELETE        //// 
======================================*/
function delete(string $tabela, int $id){

    $delete = "DELETE FROM $tabela WHERE id=$id";

    $con = conecta();

    $res = mysqli_query($con, $delete);


    if ($res === false){
        exit('Erro na operação');
    }

    return $res;
}