-- UTILIZATORI
create table utilizatori (
    id int auto_increment primary key,
    nume varchar(100) not null unique,
    email varchar(100) not null unique,
    parola varchar(256) not null,
    data_inregistrare date default current_date() not null
);


-- ADMINI
create table admini (
    id int primary key,
    foreign key (id) references utilizatori(id) on delete cascade
);

-- parola e 'admin'
insert into utilizatori (nume, email, parola) values ('admin', 'admin@admin.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');
insert into admini (id) values (1);

-- OFERTE
create table oferte (
    id int auto_increment primary key,
    id_vanzator int, -- nu are not null pt cazul in care e sters utilizatorul
    bun varchar(100) not null,
    descriere varchar(2000), /*nu are not null pt usurinta*/
    pret real not null,
    cod_terminare int default 0, -- 0 libera, 1 blocata temporar, 2 tranzactionata
    foreign key (id_vanzator) references utilizatori(id) on delete set null
);


-- TRANZACTII
create table tranzactii (
    id_oferta int primary key,
    id_cumparator int, -- nu are not null pt cazul in care e sters utilizatorul
    data date default current_date() not null,
    foreign key (id_oferta) references oferte(id),
    foreign key (id_cumparator) references utilizatori(id) on delete set null
);


-- SESIUNI
create table sesiuni (
    id varchar(50) primary key,
    id_utilizator int not null,
    expirare datetime default timestampadd(DAY, 1, now()), -- valabile 1 zi by default
    foreign key (id_utilizator) references utilizatori(id) on delete cascade
);