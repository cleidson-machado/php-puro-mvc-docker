CREATE database mvcphptest;

USE mvcphptest;

CREATE TABLE postagem(
			id int NOT NULL auto_increment PRIMARY key,
            titulo varchar(200),
            conteudo text
);

CREATE TABLE comentario(
			id int NOT NULL auto_increment PRIMARY key,
            nome varchar(200),
            mensagem text,
            id_postagem int
 
);

ALTER TABLE `comentario` ADD CONSTRAINT `fk_postagem` FOREIGN KEY ( `id_postagem` ) REFERENCES `postagem` ( `id` );

#HAVIA UM ERRO DE INTERPRETAÇÃO DA MINHA PARTE NÃO É NECESSÁRIA ESSA COLUNA!! -- CRIAÇÃO!
ALTER TABLE `postagem` ADD COLUMN `comentarios` text NULL AFTER `conteudo`;

#HAVIA UM ERRO DE INTERPRETAÇÃO DA MINHA PARTE NÃO É NECESSÁRIA ESSA COLUNA!!
ALTER TABLE `mvcphptest`.`postagem` DROP COLUMN `comentarios`;

INSERT INTO postagem (titulo, conteudo) VALUES ('Titulo teste55', 'Post de teste55');
INSERT INTO postagem (titulo, conteudo) VALUES ('Titulo teste66', 'Post de teste66');
INSERT INTO postagem (titulo, conteudo) VALUES ('Titulo teste99', 'Post de teste99');

SELECT * FROM mvcphptest.postagem;


## GRANT USER ACCESS
GRANT ALL PRIVILEGES 
ON database_name.table_name 
TO user_name@host_name;

GRANT ALL PRIVILEGES 
ON mvcphptest 
TO root;

GRANT ALL PRIVILEGES 
ON mvcphptest 
TO db_user;

GRANT ALL PRIVILEGES ON `mvcphptest`.* TO 'db_user'@'%' WITH GRANT OPTION;


















