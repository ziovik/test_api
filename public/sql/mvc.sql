
drop table users;
drop table posts;
create  table users (
    id  int auto_increment unique ,
    username varchar (155),
    password varchar (155),
    email varchar (100),


    primary key (id)
);

insert into users values
(1, 'daniel', '123456', 'daniel@yahoo.com'),
(2, 'max', 'adams', 'adam@yahoo.com'),
(3, 'anna ', 'menkel', 'ann@yahoo.com')
;

create table posts (
    id  int auto_increment unique ,
    user_id int,
    title varchar (255),
    body text,
    created_at datetime,

    primary key (id),
    foreign key (user_id) references  users(id)
      on  delete cascade
      on update cascade
);

insert into posts values
(1, 1, 'Blog on covid 19', 'The new news on covid is real', '2021-02-10 04:34:18'),
(2, 1, 'Post on programs', 'The new news on programs', '2021-02-10 04:34:18')
;