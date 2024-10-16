create database if not exists  rede_social_tw;
use rede_social_tw;
create table if not exists users(
	iduser int auto_increment unique not null,
    username varchar(45) not null,
    isadmin bool not null default false,
    pwd varchar(45) not null,
    email varchar(50) not null,
    createdat datetime default now(),
    
    primary key (iduser)
);

create table if not exists posts(
	idpost int auto_increment unique not null,
    iduser int not null,
    postcontent varchar(255) not null,
    createdat datetime default now(),
    
    primary key (idpost),
    foreign key (iduser) references users(iduser)
);

create table if not exists comments(
	idcomment int auto_increment unique not null,
    iduser int not null,
    idcommentedpost int not null,
    commentcontent varchar(255) not null,
    createdat datetime default now(),
    
    primary key (idcomment),
    foreign key (iduser) references users(iduser),
    foreign key (idcommentedpost) references posts(idpost)
);

create table if not exists likes(
	idliker int not null,
    idlikedpost int not null,
    
    foreign key (idliker) references users(iduser),
    foreign key (idlikedpost) references posts(idpost)
);
create table if not exists reportpost(
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
create table if not exists reportcomment(
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
create table if not exists reportuser(
	idreport int auto_increment unique not null,
    idreporteduser int not null,
    reason varchar(255) not null default'user violates the rules set on the platform',
    idreporter int not null,
    createdat datetime default now(),
    
    primary key (idreport),
    foreign key (idreporteduser) references users(iduser),
    foreign key (idreporter) references users(iduser)
);

INSERT INTO users (username, isadmin, pwd, email) VALUES
('user1', FALSE, 'password1', 'user1@email.com'),
('user2', FALSE, 'password2', 'user2@email.com'),
('user3', FALSE, 'password3', 'user3@email.com'),
('user4', FALSE, 'password4', 'user4@email.com'),
('user5', FALSE, 'password5', 'user5@email.com'),
('user6', FALSE, 'password6', 'user6@email.com'),
('user7', FALSE, 'password7', 'user7@email.com'),
('user8', FALSE, 'password8', 'user8@email.com');

INSERT INTO posts (iduser, postcontent) VALUES
(1, 'This is a sample post by user1'),
(2, 'This is a sample post by user2'),
(3, 'This is a sample post by user3'),
(4, 'This is a sample post by user4'),
(5, 'This is a sample post by user5'),
(6, 'This is a sample post by user6'),
(7, 'This is a sample post by user7'),
(8, 'This is a sample post by user8');

INSERT INTO comments (iduser, idcommentedpost, commentcontent) VALUES
(2, 1, 'This is a comment on post 1 by user2'),
(3, 2, 'This is a comment on post 2 by user3'),
(4, 3, 'This is a comment on post 3 by user4'),
(5, 4, 'This is a comment on post 4 by user5'),
(6, 5, 'This is a comment on post 5 by user6'),
(7, 6, 'This is a comment on post 6 by user7'),
(8, 7, 'This is a comment on post 7 by user8'),
(1, 8, 'This is a comment on post 8 by user1');

INSERT INTO likes (idliker, idlikedpost) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(1, 8);

INSERT INTO reportpost (idpost, idposter, idreporter, reason) VALUES
(1, 1, 2, 'Post violates the rules'),
(2, 2, 3, 'Post violates the rules'),
(3, 3, 4, 'Post violates the rules'),
(4, 4, 5, 'Post violates the rules'),
(5, 5, 6, 'Post violates the rules'),
(6, 6, 7, 'Post violates the rules'),
(7, 7, 8, 'Post violates the rules'),
(8, 8, 1, 'Post violates the rules');

INSERT INTO reportcomment (idcomment, idcommenter, idreporter, reason) VALUES
(1, 2, 3, 'Comment violates the rules'),
(2, 3, 4, 'Comment violates the rules'),
(3, 4, 5, 'Comment violates the rules'),
(4, 5, 6, 'Comment violates the rules'),
(5, 6, 7, 'Comment violates the rules'),
(6, 7, 8, 'Comment violates the rules'),
(7, 8, 1, 'Comment violates the rules'),
(8, 1, 2, 'Comment violates the rules');

INSERT INTO reportuser (idreporteduser, idreporter, reason) VALUES
(1, 2, 'User violates the rules'),
(2, 3, 'User violates the rules'),
(3, 4, 'User violates the rules'),
(4, 5, 'User violates the rules'),
(5, 6, 'User violates the rules'),
(6, 7, 'User violates the rules'),
(7, 8, 'User violates the rules'),
(8, 1, 'User violates the rules');