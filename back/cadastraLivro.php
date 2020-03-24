<?php

include 'classes/InserirLivro.php';

if($_GET["form"] == 1){
    $l = new InserirLivro;
    $l->setNomeLivro($_POST["nomeLivro"]);
    $l->setNomeAutor($_POST["nomeAutor"]);
    $l->setNomeEditora($_POST["nomeEditora"]);
    $l->setQtdExemplar($_POST["qtd"]);
    $l->cadastraLivro();
}
else{
    header("location: ../front/cadastrarLivros.html");
}


?>