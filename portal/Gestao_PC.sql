CREATE SCHEMA gestao_pc;
USE  gestao_pc;

CREATE TABLE pessoa(
	cpf varchar(18) PRIMARY KEY,
    nome varchar(30),
    telefone varchar(15),
    endereco varchar(100),
    email varchar(50),
    senha varchar(50),
    destino char(1), # P - PROFESSOR / A - ALUNO
    data_hora datetime    
);

insert into pessoa values 
('88888888','macalé', '987654321','Rua dos boi','maca@maca.com','maca123','A',now()),
('99999999','Delegado', '123456789','Rua dos corno','delega@delega.com','delaga123','P',now()),
('77777777','zezinho', '789654123','Rua dos chifre','zeze@zeze.com','zeze123','A',now()),
('66666666','tatu', '369852147','Rua dos gandaia','tatu@tatu.com','tatu123','A',now()),
('55555555','maria', '798321456','Rua dos Manaca','maria@maria.com','maria123','A',now());

CREATE TABLE sala(
	id int PRIMARY KEY auto_increment,
    graduacao varchar(30)
);

insert into sala(id,graduacao) values 
(null,'ADS'),
(null,'logistica');

CREATE TABLE desktop(
	id int PRIMARY KEY auto_increment,
    marca varchar(30),
    modelo varchar(50),
    placa_mae varchar(50),
    processador varchar(50),
    ram varchar(50),
    estado_pc varchar(15) default 'Disponivel', # Disponivel ou Alocado
    marca_monitor varchar(50),
    modelo_monitor varchar(50),
    id_sala int,
    ra_aluno int,
    FOREIGN KEY (ra_aluno) REFERENCES Aluno(ra),
    FOREIGN KEY (id_sala) REFERENCES sala(id)
);

insert into desktop values 
(null,'DELL','0001','dellmae','I5','16',default,'LG','LG-01',1,1),
(null,'LG','0002','LGmae','I7','8',default,'DELL','DELL-01',2,1),
(null,'ASUS','0003','ASUSmae','XP','12',default,'ASUS','AS-01',1,1);

SELECT * FROM DESKTOP;

CREATE TABLE professor(
	id int PRIMARY KEY auto_increment,
    cpf_pessoa varchar(18),
    id_not varchar(30),
    marca_not varchar(50),
    modelo_not varchar(50),
    FOREIGN KEY (cpf_pessoa) REFERENCES pessoa(cpf)    
);

insert into professor values 
(null,'99999999','01','DELL','DELL-001');


CREATE TABLE Aluno(
	ra int auto_increment primary key,
    cpf_pessoa varchar(18),
    id_sala int,
    FOREIGN KEY (cpf_pessoa) REFERENCES pessoa(cpf),
	FOREIGN KEY (id_sala) REFERENCES sala(id)
);

insert into aluno values 
(null,'88888888',1),
(null,'77777777',1),
(null,'66666666',1);

truncate aluno;


CREATE TABLE aula(
	id int primary key auto_increment,
    id_professor int,
    id_sala int,
    disciplina varchar(30),
    FOREIGN KEY (id_professor) REFERENCES professor(id),
    FOREIGN KEY (id_sala) REFERENCES sala(id)
);

insert into Aula values 
(null,1,1,'ADS');

show tables from gestao_pc;

			#CRIANDO USUARIO E PERMISSÃO BANCO GESTÃO#

create user 'pc_aluno'@'localhost' identified by '123aluno';
grant select on gestao_pc.alunao to 'pc_aluno'@'localhost';
grant select on gestao_pc.aula to 'pc_aluno'@'localhost';
grant select on gestao_pc.desktop to 'pc_aluno'@'localhost';
grant select on gestao_pc.professor to 'pc_aluno'@'localhost';
grant select on gestao_pc.sala to 'pc_aluno'@'localhost';
flush privileges;

create user 'pc_professor'@'localhost' identified by '123professor';
grant select,update on gestao_pc.aula to 'pc_professor'@'localhost';
grant select,update on gestao_pc.desktop to 'pc_professor'@'localhost';
grant select,update on gestao_pc.sala to 'pc_professor'@'localhost';
grant select on gestao_pc.aluno to 'pc_professor'@'localhost';
grant select on gestao_pc.pessoa to 'pc_professor'@'localhost';
grant select on gestao_pc.professor to 'pc_professor'@'localhost';
flush privileges;


DELIMITER $

CREATE trigger TRG_ATL_DESKTOP_ALUNO
after insert 
on Aluno
for each row
begin 
	declare id_pc int;
    
    set id_pc = (
    select id from desktop
	where desktop.id_sala = new.id_sala and 
    estado_pc = 'Disponivel' order by id asc limit 1);
                  
    update desktop set ra_aluno = new.ra where id = id_pc;
    update desktop set estado_pc = 'Alocado' where id = id_pc;
end$

DELIMITER ;
