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