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
	idInstituicao INT,
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

insert into instituicao values 
(null, 'IFC'),
(null, 'UDESC'),
(null, 'UFSC');

insert into aluno values
(null, 111, 'Mathias Schulz', 30.0, 300, '2018-10-10', 10, 20, 50, 1),
(null, 222, 'Artur Silva', 15.7, 800, '2016-11-11', 15, 46, 99, 1),
(null, 333, 'João Back', 45.8, 250, '2019-12-15', 6, 6, 6, 3),
(null, 444, 'Paulo Silva', 46.4, 777, '2015-03-24', 20, 40, 140, 2);

insert into turma values
(null, 'Desenvolvimento WEB I'),
(null, 'Redes de Computadores I'),
(null, 'Inteligência Artificial');

insert into turmaaluno values
(1, 1), (1, 2), (1, 3), (1, 4),
(2, 2), (2, 3),
(3, 1), (3, 2), (3, 3);

-- select * from instituicao;
-- select * from aluno;
-- select * from turma;
-- select * from turmaaluno;


-- instituicao por score
-- SELECT INST.NOME, SUM(AL.SCORE)  from INSTITUICAO INST INNER JOIN ALUNO AL ON AL.IDINSTITUICAO = INST.IDINSTITUICAO GROUP BY INST.IDINSTITUICAO;
-- consultar aluno
-- SELECT * FROM ALUNO WHERE NOME LIKE '%joão%';
-- turma por score
-- SELECT TA.IDTURMA, SUM(AL.SCORE) from TURMAALUNO TA INNER JOIN ALUNO AL ON TA.IDALUNO = AL.IDALUNO GROUP BY IDTURMA;
-- melhores instituicoes (DESC)
-- SELECT INST.IDINSTITUICAO, SUM(AL.SCORE)/COUNT(*) from INSTITUICAO INST INNER JOIN ALUNO AL ON AL.IDINSTITUICAO = INST.IDINSTITUICAO GROUP BY INST.IDINSTITUICAO DESC;







