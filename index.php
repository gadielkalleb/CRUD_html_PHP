<?php

require 'database.php';

$projetos = selectAll('projeto');

// var_dump('projetos');



// $projetos=insert('projeto',[
//     'nome_projeto'=>$nomeProjeto=$_POST['nome-projeto'],
//     'custo_hora'=> $custoHora=$_POST['custo-hora'],
//     'total_horas'=> $totalHora=$_POST['total-horas']

// ]);
// update('projetos',['nome_projeto','Gadiel']);
// 
// $projeto = select('projeto', 'id=1');

// var_dump($projeto);
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Relatex</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Gadiel Kalleb">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="css/materialize.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
    </head>
    <body>

    <nav>
        <div class="nav-wrapper deep-purple accent-1">
            
                <a href="#" class="brand-logo">Relatex</a>
            
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="#modalAdicionar">Criar Projeto</a></li>
            </ul>
        </div>
    </nav>
        
         <div class="container">
          <div class="row">
            <div class="col s12">
                <div class="card z-depth-3">
                    <div class="card-content">
                        <h1>Relatex 0.1</h1>
                        
                        <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Quem manda na minha terra sou euzis! Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vida.
                        </p>
                        <br>

                        <table class="responsive-table striped">
                            <tr>
                                <th>id</th>
                                <th>Nome Projeto</th>
                                <th>Custo hora</th>
                                <th>Total horas</th>
                                <th>Custo total</th>
                                <th>Gerência</th>
                            </tr>
                            
                            <?php 

                                foreach ($projetos as $projeto) {
                                    $custototal = $projeto[custo_hora]*$projeto[total_horas];
                                    
                                    echo '<tr>';
                                    echo "<td>{$projeto['id']}</td>";
                                    echo "<td>{$projeto['nome_projeto']}</td>";
                                    echo "<td>{$projeto['custo_hora']}</td>";
                                    echo "<td>{$projeto['total_horas']}</td>";
                                    echo '<td>'. $custototal .'</td>';
                                    echo "<td>
                                    <a href='#' style='color: #FFF' class='chip blue darken-3'>Alterar</a></td>";
                                    echo '<td>
                                    <a href="deleteprojeto.php?id=' .$projeto['id'].'" style="color: #FFF" class="chip red darken-3">Excluir</a></td>';
/*É BOM LEMBRAR QUE A URL 
'deleteprojeto.php?id=''
RECEBE .$projeto['id']. 
QUE É O ELEMENTO QUE VOU EXCLUIR*/

                                   
                                    echo '</tr>';
                                }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>
          </div>
      </div>

    <div id="modalAdicionar" class="modal">

      <div class="modal-content">
        <h4 class="center-align">Adicionar Projeto</h4>
        <div class="divider"></div>

        <div class="row" ng-app="myApp" ng-controller="myCtrl">
          
          <form id="cadastroProjeto" class="col s12" method="POST" action="cadastroprojeto.php">

           

            <div class="row">
              <div class="input-field col s12">
                <input name="nome-projeto" type="text" class="validate">
                <label for="nome-projeto">Nome do Projeto</label>
              </div>
            </div>

            <div class="row" >

              <div class="input-field col s6">
                <input ng-model="custoHora" name="custo-hora" type="number" class="validate" >
                <label for="custo-hora">Custo Hora</label>
              </div>

               <div class="input-field col s6">
                <input ng-model="totalHoras" name="total-horas" type="number" class="validate" >
                <label for="total-horas">Total de Horas</label>
              </div>

            </div>

            <div class="row">
                <div class="container">
                    <h4>Custo total</h4>
                    <div class="divider"></div>
                    <p class="flow-text">R${{totalHoras * custoHora}}</p>
                </div>
            </div>

           
            <div class="modal-footer">
                <a id="#index.php" class="modal-action modal-close waves-effect waves-green btn-flat red white-text">cancelar</a>
                <button id="salvarBtn" class="waves-effect waves-light btn green">salvar</button>
            </div>

          </form>
        </div>
      </div>

      
    </div>


        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <script>
            $('.modal').modal();

            var app = angular.module('myApp',[]);
                app.controller('myCtrl', function($scope){
                    $scope.totalHoras = "0";
                    $scope.custoHora = "0";
            });
        </script>   
    </body>
</html>

