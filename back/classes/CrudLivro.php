<?php

include 'Livro.php';

Class CrudLivro extends Livro
{
    private function validaLivro()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT id_livro FROM livro WHERE nome_livro = '$this->nomeLivro'");
        $resultado = mysqli_fetch_array($pesquisa);
        return $resultado["id_livro"];
    }
    
    private function validaAutor()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT id_autor FROM autor WHERE nome_autor = '$this->nomeAutor'");
        $resultado = mysqli_fetch_array($pesquisa);
        return $resultado["id_autor"];
    }

    private function validaEditora()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT id_editora FROM editora WHERE nome_editora = '$this->nomeEditora'");
        $resultado = mysqli_fetch_array($pesquisa);
        return $resultado["id_editora"];
    }

    private function cadastraAutor()
    {
        include 'conexao.php';
        $conexao->query("INSERT INTO autor(nome_autor) VALUES('$this->nomeAutor')");
    }

    private function cadastraEditora()
    {
        include 'conexao.php';
        $conexao->query("INSERT INTO editora(nome_editora) VALUES('$this->nomeEditora')");
    }

    private function cadastraExemplar()
    {
        include 'conexao.php';
        $pesquisa = $conexao->query("SELECT count(id_livro) as 'ultimo_id_livro' from livro");
        $resultado = mysqli_fetch_array($pesquisa);
        $livro = $resultado["ultimo_id_livro"];
        for($n = 0; $n < $this->qtdExemplar; $n++){
            $conexao->query("INSERT INTO exemplar(id_livro) VALUES($livro)");
        }
    }

    public function cadastraLivro()
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

    public function listarLivros()
    {
        include '../back/conexao.php';
        $pesquisa = $conexao->query("SELECT livro.id_livro,
                                            nome_livro,
                                            nome_editora,
                                            nome_autor,
                                            count(id_exemplar)  
                                    FROM livro 
                                    INNER JOIN editora 
                                    ON editora.id_editora = livro.id_editora
                                    INNER JOIN autor
                                    ON autor.id_autor = livro.id_autor
                                    INNER JOIN exemplar
                                    ON livro.id_livro = exemplar.id_livro
                                    GROUP BY id_livro
                                    ORDER BY nome_livro ASC");
        $cont = 0;
        while($coluna = mysqli_fetch_array($pesquisa)){
            $livro[$cont][0] = $coluna["nome_livro"];
            $livro[$cont][1] = $coluna["nome_autor"];
            $livro[$cont][2] = $coluna["nome_editora"];
            $cont++;
        }

        return $livro;
    }

    public function excluirLivro()
    {

    }

}

?>