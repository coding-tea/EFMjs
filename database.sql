
create database TPAJAX;

use TPAJAX;

create table etudiants(

    id int primary key AUTO_INCREMENT,
    civilite varchar(4),
    nom varchar(250),
    prenom varchar(250),
    email varchar(250),
    photo varchar(250)
);