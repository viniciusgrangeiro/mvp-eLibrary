CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE aluno(
	id_aluno INT AUTO_INCREMENT,
	nome_aluno VARCHAR(50) NOT NULL,
	telefone_aluno VARCHAR(10) NOT NULL,
	PRIMARY KEY (id_aluno)
);
DESC aluno;

CREATE TABLE locacao(
	id_locacao INT AUTO_INCREMENT,
	dt_locacao DATE NOT NULL,
	dt_entrega DATE NOT NULL,
	PRIMARY KEY (id_locacao)	
);
DESC locacao;

CREATE TABLE livro(
	id_livro INT AUTO_INCREMENT,
	nome_livro VARCHAR(50) NOT NULL,
	qtd_pagina_livro INT(4) NOT NULL,
	ano_livro VARCHAR(4),
	PRIMARY KEY (id_livro)
);
DESC livro;

CREATE TABLE editora(
	id_editora INT AUTO_INCREMENT,
	nome_editora VARCHAR(50),
	PRIMARY KEY (id_editora)
);
DESC editora;

CREATE TABLE autor(
	id_autor INT AUTO_INCREMENT,
	nome_autor VARCHAR(50),
	PRIMARY KEY (id_autor)
);
DESC autor;

CREATE TABLE status_locacao(
	id_status_locacao INT AUTO_INCREMENT,
	situacao_locacao VARCHAR(10) NOT NULL,
	PRIMARY KEY (id_status_locacao)
);
DESC status_locacao;

ALTER TABLE locacao ADD COLUMN id_aluno INT NOT NULL;
ALTER TABLE locacao ADD FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno);
ALTER TABLE locacao ADD COLUMN id_status_locacao INT NOT NULL;
ALTER TABLE locacao ADD FOREIGN KEY (id_status_locacao) REFERENCES status_locacao(id_status_locacao);

ALTER TABLE livro ADD COLUMN id_locacao INT NOT NULL;
ALTER TABLE livro ADD FOREIGN KEY (id_locacao) REFERENCES locacao(id_locacao);
ALTER TABLE livro ADD COLUMN id_autor INT NOT NULL;
ALTER TABLE livro ADD FOREIGN KEY (id_autor) REFERENCES autor(id_autor);
ALTER TABLE livro ADD COLUMN id_editora INT NOT NULL;
ALTER TABLE livro ADD FOREIGN KEY (id_editora) REFERENCES editora(id_editora);
