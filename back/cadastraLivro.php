<?php

include 'classes/CrudLivro.php';

if($_GET["form"] == 1){
    $l = new CrudLivro;
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