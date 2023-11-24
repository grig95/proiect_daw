-- UTILIZATORI
create table utilizatori (
    id int auto_increment primary key,
    nume varchar(100) not null unique,
    email varchar(100) not null unique,
    parola varchar(100) not null,
    data_inregistrare date default current_date() not null
);


-- ADMINI
create table admini (
    id int primary key,
    foreign key (id) references utilizatori(id) on delete cascade
);


-- CONECTARI si UTILIZATORI_CONECTARI nu vor fi momentan implementate fiindca nu sunt sigur cum vor functiona


-- OFERTE
create table oferte (
    id int auto_increment primary key,
    id_vanzator int, -- nu are not null pt cazul in care e sters utilizatorul
    bun varchar(100) not null,
    descriere varchar(2000), /*nu are not null pt usurinta*/
    pret real not null,
    cod_terminare int default 0,
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