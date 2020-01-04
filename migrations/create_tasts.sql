create table tasks
(
	id int primary key auto_increment,
	user_name varchar(255) not null,
	user_email varchar(255) not null,
	body text not null,
	created_at datetime default NOW() not null,
	updated_by_admin_at datetime null,
	done boolean default false null
);