create table users
(
	id int primary key auto_increment,
	login varchar(255) not null,
	password varchar(255) null
);