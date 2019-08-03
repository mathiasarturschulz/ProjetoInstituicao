-- PROJETO INSTITUICAO

CREATE SCHEMA IF NOT EXISTS instituicao DEFAULT CHARACTER SET utf8;
USE instituicao;

CREATE TABLE IF NOT EXISTS Instituicao (
  idInstituicao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(45) NOT NULL
);

CREATE TABLE IF NOT EXISTS Aluno (
	idAluno INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	codigo INT NOT NULL,
	nome VARCHAR(45) NOT NULL,
	score DOUBLE NOT NULL,
	posicao INT NULL,
	desde DATETIME NULL,
	resolvidos INT NULL,
	tentados INT NULL,
	submissoes INT NULL,
	idInstituicao INT NOT NULL,
	UNIQUE INDEX codigo_UNIQUE (codigo ASC),
	CONSTRAINT fk_Aluno_Instituicao FOREIGN KEY (idInstituicao) REFERENCES Instituicao(idInstituicao)
);

CREATE TABLE IF NOT EXISTS Turma (
	idTurma INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(45) NOT NULL
);

CREATE TABLE IF NOT EXISTS TurmaAluno (
	idTurma INT NOT NULL,
	idAluno INT NOT NULL,
	PRIMARY KEY (idTurma, idAluno),
	CONSTRAINT fk_Turma_has_Aluno_Turma1 FOREIGN KEY (idTurma) REFERENCES Turma(idTurma),
	CONSTRAINT fk_Turma_has_Aluno_Aluno1 FOREIGN KEY (idAluno) REFERENCES Aluno(idAluno)
);

select * from instituicao;
select * from aluno;



