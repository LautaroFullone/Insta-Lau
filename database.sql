create database if not exists red_social;
use red_social;


create table users(
	id int auto_increment not null,
    role varchar(20),
    name varchar(100),
    surname varchar(100),
    nick varchar(100),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),
    constraint pk_user primary key (id) 
)engine=InnoDB;

create table images(
	id int auto_increment not null,
    user_id int not null,
    image_path varchar(255),
    description varchar(255),
    created_at datetime,
    updated_at datetime,
    constraint pk_image primary key (id),
    constraint fk_image_user foreign key (user_id) references users(id)
)engine=InnoDB;

create table comments(
	id int auto_increment not null,
    user_id int not null,
    image_id int not null,
    content varchar(255),
    created_at datetime,
    updated_at datetime,
    constraint pk_comment primary key (id),
    constraint fk_comment_user foreign key (user_id) references users(id),
    constraint fk_comment_image foreign key (image_id) references images(id)
)engine=InnoDB;

create table likes(
	id int auto_increment not null,
    user_id int not null,
    image_id int not null,
    created_at datetime,
    updated_at datetime,
    constraint pk_likes primary key (id),
    constraint fk_likes_user foreign key (user_id) references users(id),
    constraint fk_likes_image foreign key (image_id) references images(id)
)engine=InnoDB;
