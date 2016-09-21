create database messages;
use messages;

create table user(
id int not null auto_increment primary key,
username varchar(20) not null,
password varchar(32) not null
);

create table msg(
id int not null auto_increment primary key,
uid int not null,
title varchar(30) not null,
content varchar(1024) not null,
ip varchar(15) not null,
date int(15) not null
);

insert into user(username,password) values('1111','1111');
insert into user(username,password) values('2222','2222');

insert into msg(uid,title,content,ip,date) values('1111','你好','我是1111','127.0.0.1','1464082630');
insert into msg(uid,title,content,ip,date) values('2222','Hi','我是2222','127.0.0.1','1464082630');

grant all privileges on messages.* to msg@localhost identified by '217977';
flush privileges;
