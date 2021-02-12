drop table if exists  clients;
drop table if exists  legal_entity;
drop table if exists  ecommerce;
drop table if exists  ecommerce_group;
drop table if exists  servers;
drop table if exists  agents;
drop table if exists  users;


create  table users (
    id serial PRIMARY KEY,
    username varchar (155),
    password varchar (155),
    email varchar (100)

);

insert into users values
(1, 'daniel', '123456', 'daniel@yahoo.com'),
(2, 'max', 'adams', 'adam@yahoo.com'),
(3, 'anna ', 'menkel', 'ann@yahoo.com')
;

create table clients (
     id serial PRIMARY KEY,
     client_name VARCHAR ( 250 ) UNIQUE NOT NULL,
     address VARCHAR ( 250 ) NOT NULL,
     email VARCHAR ( 255 ) UNIQUE NOT NULL,
     created_on TIMESTAMP NOT NULL,
     telephone VARCHAR ( 255 )
);

create table legal_entity (
      id serial PRIMARY KEY,
      client_id int  NOT NULL,
      inn VARCHAR ( 250 ) NOT NULL,
      kpp  VARCHAR ( 250 ),
      orgn VARCHAR ( 250 ),
      okpo VARCHAR ( 250 ),
      bank_account_number VARCHAR ( 250 ),
      bank_address VARCHAR ( 250 ),
      bank_account_correspondent VARCHAR ( 250 ),
      bik VARCHAR ( 250 ),
      okved VARCHAR ( 250 ),
      okato VARCHAR ( 250 ),

      CONSTRAINT fk_client
          FOREIGN KEY(client_id)
              REFERENCES clients(id)
              ON DELETE cascade
              ON UPDATE cascade

);



create table ecommerce (
   id serial PRIMARY KEY,
   legal_entity_id int  NOT NULL,
   ecommerce_name VARCHAR ( 250 ) NOT NULL,
   domain_name  VARCHAR ( 250 ),

   CONSTRAINT fk_legal_entity
       FOREIGN KEY(legal_entity_id)
           REFERENCES legal_entity(id)
           ON DELETE cascade
           ON UPDATE cascade
);

create table ecommerce_group (
     id serial PRIMARY KEY,
     ecommerce_id int  NOT NULL,
     group_name VARCHAR ( 250 ) NOT NULL,


     CONSTRAINT fk_ecommerce
         FOREIGN KEY(ecommerce_id)
             REFERENCES ecommerce(id)
             ON DELETE cascade
             ON UPDATE cascade
);

create table servers (
     id serial PRIMARY KEY,
     server_name VARCHAR ( 250 ) NOT NULL,
     server_ip   VARCHAR ( 250 )
);

create table agents (
     id serial PRIMARY KEY,
     server_id int  NOT NULL,
     agent_name VARCHAR ( 250 ),
     ecommerce_group_id int,



     CONSTRAINT fk_server
         FOREIGN KEY(server_id)
             REFERENCES servers(id)
             ON DELETE cascade
             ON UPDATE cascade,
     CONSTRAINT fk_ecommerce_group
         FOREIGN KEY(ecommerce_group_id)
             REFERENCES ecommerce_group(id)
             ON DELETE cascade
             ON UPDATE cascade
);