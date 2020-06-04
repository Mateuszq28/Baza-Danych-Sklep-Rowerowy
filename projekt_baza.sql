CREATE TABLE klient(
imie varchar(20) not null,
nazwisko varchar(40) not null,
telefon char(11),
id_klienta serial
PRIMARY KEY
);

CREATE TABLE model(
nazwa varchar(30) not null,
rok date,
marka varchar(20),
rama varchar(20),
kola varchar(20),
naped varchar(20),
nr_seryjny serial
PRIMARY KEY
);

CREATE TABLE rower(
model integer not null
REFERENCES model ON DELETE SET NULL ON
UPDATE CASCADE,
id_roweru serial
PRIMARY KEY,
kolor varchar(20)
);

CREATE TABLE sprzedaz(
nr_transakcji serial,
nabywca integer not null
REFERENCES klient ON DELETE RESTRICT
ON UPDATE RESTRICT,
produkt integer not null
REFERENCES rower ON DELETE RESTRICT
ON UPDATE CASCADE,
cena numeric(8,2),
data timestamp default now()
);