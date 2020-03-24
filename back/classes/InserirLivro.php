<?php

include 'Livro.php';

Class InserirLivro extends Livro
{
    function validaLivro()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT id_livro FROM livro WHERE nome_livro = '$this->nomeLivro'");
        $resultado = mysqli_fetch_array($pesquisa);
        return $resultado["id_livro"];
    }
    
    function validaAutor()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT id_autor FROM autor WHERE nome_autor = '$this->nomeAutor'");
        $resultado = mysqli_fetch_array($pesquisa);
        return $resultado["id_autor"];
    }

    function validaEditora()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT id_editora FROM editora WHERE nome_editora = '$this->nomeEditora'");
        $resultado = mysqli_fetch_array($pesquisa);
        return $resultado["id_editora"];
    }

    function cadastraAutor()
    {
        include 'conexao.php';
        $conexao->query("INSERT INTO autor(nome_autor) VALUES('$this->nomeAutor')");
    }

    function cadastraEditora()
    {
        include 'conexao.php';
        $conexao->query("INSERT INTO editora(nome_editora) VALUES('$this->nomeEditora')");
    }

    function cadastraExemplar()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT count(id_livro) as 'ultimo_id_livro' from livro");
        $resultado = mysqli_fetch_array($pesquisa);
        $livro = $resultado["ultimo_id_livro"];
        for($n = 0; $n < $this->qtdExemplar; $n++){
            $conexao->query("INSERT INTO exemplar(id_livro) VALUES($livro)");
        }
    }

    function cadastraLivro()
    {
        include 'conexao.php';

        $autor = $this->validaAutor();
        $editora = $this->validaEditora();
        $livro = $this->validaLivro();

        if($autor == true && $editora == true && $livro == true){
            echo 'livro já cadastrado <br> <a href="../front/cadastrarLivros.html">Voltar</a>';
        }
        else if($autor == true && $editora == true){
            $conexao->query("INSERT INTO livro(nome_livro, id_autor, id_editora) 
            VALUES('$this->nomeLivro', '$autor', '$editora') ");
            $this->cadastraExemplar();
            header("location: ../front/cadastrarLivros.html");
        }
        else if($autor == false && $editora == true){
            $this->cadastraAutor();
            $conexao->query("INSERT INTO livro(nome_livro, id_autor, id_editora) 
            VALUES('$this->nomeLivro', (SELECT count(id_autor) from autor), '$editora') ");
            $this->cadastraExemplar();
            header("location: ../front/cadastrarLivros.html");
        }
        else if($autor == true && $editora == false){
            $this->cadastraEditora();
            $conexao->query("INSERT INTO livro(nome_livro, id_autor, id_editora) 
            VALUES('$this->nomeLivro', '$autor', (SELECT count(id_editora) from editora)) ");
            $this->cadastraExemplar();
            header("location: ../front/cadastrarLivros.html");
        }
        else{
            $this->cadastraAutor();
            $this->cadastraEditora();
            $conexao->query("INSERT INTO livro(nome_livro, 
                                         id_autor, 
                                         id_editora) 
                             VALUES('$this->nomeLivro', 
                             (SELECT count(id_autor) from autor), 
                             (SELECT count(id_editora) from editora))");
            $this->cadastraExemplar();
            header("location: ../front/cadastrarLivros.html");
        }
    }

}

?>