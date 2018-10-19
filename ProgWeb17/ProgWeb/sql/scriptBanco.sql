CREATE DATABASE roteiro17;

USE roteiro17;

CREATE TABLE tbGrupoAcesso
(
   idGrupoAcesso        INT NOT NULL AUTO_INCREMENT,
   descricao            VARCHAR(255) NOT NULL,
   PRIMARY KEY (idGrupoAcesso)
);

CREATE TABLE tbUsuario
(
   idUsuario            INT NOT NULL AUTO_INCREMENT,
   login                VARCHAR(255) NOT NULL,
   senha                VARCHAR(255) NOT NULL,
   email                VARCHAR(255) NOT NULL,
   ultimoAcesso         DATETIME,
   situacao             TINYINT(1) NOT NULL,
   idGrupoAcesso        INT NOT NULL,
   PRIMARY KEY (idUsuario)
);

ALTER TABLE tbUsuario ADD CONSTRAINT FK_tbUsuario_Ref_tbGrupoAcesso FOREIGN KEY (idGrupoAcesso)
      REFERENCES tbGrupoAcesso (idGrupoAcesso) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER DATABASE roteiro17 CHARACTER SET utf8 COLLATE utf8_general_ci;