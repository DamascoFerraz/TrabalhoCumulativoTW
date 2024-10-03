create database rede_social_gilberto;
use rede_social_gilberto;

-- TABELAS

create table users(
	iduser int auto_increment unique not null,
    username varchar(45) not null,
    isadmin bool not null default false,
    pwd varchar(45) not null,
    email varchar(50) not null,
    createdat datetime default now(),
    
    primary key (iduser)
);

create table posts(
	idpost int auto_increment unique not null,
    iduser int not null,
    postcontent varchar(255) not null,
    createdat datetime default now(),
    
    primary key (idpost),
    foreign key (iduser) references users(iduser)
);

create table comments(
	idcomment int auto_increment unique not null,
    iduser int not null,
    idcommentedpost int not null,
    commentcontent varchar(255) not null,
    createdat datetime default now(),
    
    primary key (idcomment),
    foreign key (iduser) references users(iduser),
    foreign key (idcommentedpost) references posts(idpost)
);

create table likes(
	idliker int not null,
    idlikedpost int not null,
    
    foreign key (idliker) references users(iduser),
    foreign key (idlikedpost) references posts(idpost)
);

-- REPORTS
-- - post
create table reportpost(
	idreport int auto_increment unique not null,
    idpost int not null,
    idposter int not null,
    reason varchar(255) not null default'post violates the rules set on the platform',
    idreporter int not null,
    createdat datetime default now(),
    
    primary key (idreport),
    foreign key (idpost) references posts(idpost),
    foreign key (idposter) references posts(iduser),
    foreign key (idreporter) references users(iduser)
);

-- - comment
create table reportcomment(
	idreport int auto_increment unique not null,
    idcomment int not null,
    idcommenter int not null,
    reason varchar(255) not null default'comment violates the rules set on the platform',
    idreporter int not null,
    createdat datetime default now(),
    
    primary key (idreport),
    foreign key (idcomment) references comments(idcomment),
    foreign key (idcommenter) references comments(iduser),
    foreign key (idreporter) references users(iduser)
);

-- - user
create table reportuser(
	idreport int auto_increment unique not null,
    idreporteduser int not null,
    reason varchar(255) not null default'user violates the rules set on the platform',
    idreporter int not null,
    createdat datetime default now(),
    
    primary key (idreport),
    foreign key (idreporteduser) references users(iduser),
    foreign key (idreporter) references users(iduser)
);

-- DADOS

INSERT INTO users (username, isadmin, pwd, email) VALUES
('gilberto', 1, 'Print(senha)', 'gilberto.muz.22@gmail.com'),
('okada', 0, 'okadinhazinha', 'tssm@onion.com'),
('faaler', 0, 'powerguido69', 'rafaelvictor@alunos.ifmuz.edu.com'),
('alice', 0, '123456789', 'alice@email.com'),
('penis', 0, '11092001', 'bob@hotmail.com');

INSERT INTO posts (iduser, postcontent) VALUES
(1, 'bem vindos!'),
(2, 'clique aqui para ganhar 1000 reais -> clonacartao.com'),
(3, 'vai se foder okada'),
(1, 'kkkkkkkk sfd'),
(2, 'como tira letras gramde');



INSERT INTO likes (idliker, idlikedpost) VALUES
(2, 1),
(3, 1),
(4, 2),
(5, 3),
(1, 4);

insert into comments(iduser,idcommentedpost,commentcontent) values
(1 ,2 , 'prr isso é golpe'),
(2 ,1 , 'oi junin'),
(3 ,1 , 'nah aí n');

INSERT INTO reportpost (idpost, idposter, idreporter, reason) VALUES
(2, 2, 3, 'spam golpe'),
(4, 1, 5, 'palavra ofensiva'),
(3, 3, 1, 'palavra ofensiva');

insert into reportcomment (idcomment, idcommenter, idreporter,reason) values
	(1,1,2,'palavra ofensiva');
;
insert into reportuser (idreporteduser, idreporter,reason) values
	(5, 1, 'nome ofensivo');
;