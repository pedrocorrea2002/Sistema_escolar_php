SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

/*DROP DATABASE aedb_php*/

CREATE DATABASE IF NOT EXISTS aedb_php DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE aedb_php;

CREATE TABLE aluno (
  idaluno int(11) NOT NULL,
  nmaluno varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE alunomatriculado (
  idalunomatriculado int(11) NOT NULL,
  idaluno int(11) NOT NULL,
  idmateria int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE avaliacao (
  idavaliacao int(11) NOT NULL,
  dsavaliacao varchar(10) NOT NULL,
  idmateria int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE avaliacaoaluno (
  idavaliacaoaluno int(11) NOT NULL,
  idavaliacao int(11) NOT NULL,
  idaluno int(11) NOT NULL,
  nota int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE login (
  dslogin varchar(50) NOT NULL,
  dssenha varchar(150) NOT NULL,
  idaluno int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE materia (
  idmateria int(11) NOT NULL,
  dsmateria varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE aluno
  ADD PRIMARY KEY (idaluno);

ALTER TABLE alunomatriculado
  ADD PRIMARY KEY (idalunomatriculado),
  ADD KEY fk_idaluno (idaluno),
  ADD KEY fk_materia (idmateria);

ALTER TABLE avaliacao
  ADD PRIMARY KEY (idavaliacao),
  ADD KEY fk_mateira_ava (idmateria);

ALTER TABLE avaliacaoaluno
  ADD PRIMARY KEY (idavaliacaoaluno),
  ADD KEY fk_idaluno_nota (idaluno),
  ADD KEY fk_idavaliacao_nota (idavaliacao);

ALTER TABLE login
  ADD PRIMARY KEY (dslogin),
  ADD KEY fk_idaluno_login (idaluno);

ALTER TABLE materia
  ADD PRIMARY KEY (idmateria),
  ADD UNIQUE KEY UK_dsmateria (dsmateria);

ALTER TABLE aluno
  MODIFY idaluno int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE alunomatriculado
  MODIFY idalunomatriculado int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE avaliacao
  MODIFY idavaliacao int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE avaliacaoaluno
  MODIFY idavaliacaoaluno int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE materia
  MODIFY idmateria int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE alunomatriculado
  ADD CONSTRAINT fk_idaluno FOREIGN KEY (idaluno) REFERENCES aluno (idaluno) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_materia FOREIGN KEY (idmateria) REFERENCES materia (idmateria) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE avaliacao
  ADD CONSTRAINT fk_mateira_ava FOREIGN KEY (idmateria) REFERENCES materia (idmateria) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE avaliacaoaluno
  ADD CONSTRAINT fk_idaluno_nota FOREIGN KEY (idaluno) REFERENCES aluno (idaluno) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_idavaliacao_nota FOREIGN KEY (idavaliacao) REFERENCES avaliacao (idavaliacao) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE login
  ADD CONSTRAINT fk_idaluno_login FOREIGN KEY (idaluno) REFERENCES aluno (idaluno) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO aluno(nmaluno) VALUES ('ADMINISTRADOR DO SISTEMA');
INSERT INTO LOGIN(dslogin,dssenha,idaluno) VALUES ('admin','21232f297a57a5a743894a0e4a801fc3',1);