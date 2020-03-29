CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE aluno(
	id_aluno INT(10) AUTO_INCREMENT,
	nome_aluno VARCHAR(50) NOT NULL,
	telefone_aluno VARCHAR(10) NOT NULL,
	rg_aluno VARCHAR(11) NOT NULL,
	PRIMARY KEY (id_aluno)
);
DESC aluno;

CREATE TABLE locacao(
	id_locacao INT(10) AUTO_INCREMENT,
	dt_locacao DATE NOT NULL,
	dt_entrega DATE NOT NULL,
	PRIMARY KEY (id_locacao)	
);
DESC locacao;

CREATE TABLE livro(
	id_livro INT AUTO_INCREMENT,
	nome_livro VARCHAR(50) NOT NULL,
	PRIMARY KEY (id_livro)
);
DESC livro;

CREATE TABLE editora(
	id_editora INT(10) AUTO_INCREMENT,
	nome_editora VARCHAR(50) NOT NULL,
	PRIMARY KEY (id_editora)
);
DESC editora;

CREATE TABLE autor(
	id_autor INT(10) AUTO_INCREMENT,
	nome_autor VARCHAR(50) NOT NULL,
	PRIMARY KEY (id_autor)
);
DESC autor;

CREATE TABLE status_locacao(
	id_status_locacao INT(10) AUTO_INCREMENT,
	situacao_locacao VARCHAR(10) NOT NULL,
	PRIMARY KEY (id_status_locacao)
);
DESC status_locacao;

CREATE TABLE exemplar(
	id_exemplar INT(10) AUTO_INCREMENT,
	PRIMARY KEY (id_exemplar)
);
DESC exemplar;

ALTER TABLE locacao ADD COLUMN id_aluno INT NOT NULL;
ALTER TABLE locacao ADD FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno);
ALTER TABLE locacao ADD COLUMN id_status_locacao INT NOT NULL;
ALTER TABLE locacao ADD FOREIGN KEY (id_status_locacao) REFERENCES status_locacao(id_status_locacao);

ALTER TABLE exemplar ADD COLUMN id_locacao INT NOT NULL;
ALTER TABLE exemplar ADD FOREIGN KEY (id_locacao) REFERENCES locacao(id_locao);
ALTER TABLE exemplar ADD COLUMN id_livro INT NOT NULL;
ALTER TABLE exemplar ADD FOREIGN KEY (id_livro) REFERENCES livro(id_livro);

ALTER TABLE livro ADD COLUMN id_autor INT NOT NULL;
ALTER TABLE livro ADD FOREIGN KEY (id_autor) REFERENCES autor(id_autor);
ALTER TABLE livro ADD COLUMN id_editora INT NOT NULL;
ALTER TABLE livro ADD FOREIGN KEY (id_editora) REFERENCES editora(id_editora);