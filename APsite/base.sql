drop table client;
drop table voiture;
drop table facture;
drop table concessionnaire;
drop table employe;
drop table stocker;


CREATE TABLE client(
   idClient INT AUTO_INCREMENT,
   prenom text,
   nom text,
   adresse text,
   numTel text,
   email text,
   mdp text,
   PRIMARY KEY(idClient)
);

CREATE TABLE voiture(
   idVoiture INT AUTO_INCREMENT,
   marque text,
   modele text,
   dateConstruction date,
   couleur text,
   prix INT,
   nbCheveaux INT,
   PRIMARY KEY(idVoiture)
);

CREATE TABLE facture(
   idFacture INT ,
   montant INT,
   dateF DATE,
   typePaiement INT,
   idVente INT,
   idClient INT NOT NULL,
   PRIMARY KEY(idFacture),
   FOREIGN KEY(idClient) REFERENCES Client(idClient)
);

CREATE TABLE concessionnaire(
   idConcess INT , 
   adresseConcess text,
   numConcess INT,
   idFacture INT NOT NULL,
   PRIMARY KEY(idConcess),
   FOREIGN KEY(idFacture) REFERENCES Facture(idFacture)
);

CREATE TABLE employe(
   idEmploye INT ,
   prenom text,
   nom text,
   adresse text,
   numEmploye INT,
   idConcess INT,
   PRIMARY KEY(idEmploye),
   FOREIGN KEY(idConcess) REFERENCES Concessionnaire(idConcess)
);

CREATE TABLE stocker(
   idVoiture INT AUTO_INCREMENT,
   idConcess INT ,
   nbVoitureStocker INT,
   PRIMARY KEY(idVoiture, idConcess),
   FOREIGN KEY(idVoiture) REFERENCES Voiture(idVoiture),
   FOREIGN KEY(idConcess) REFERENCES Concessionnaire(idConcess)
);



insert into Client values 
(1,'Landon','Wolfe','326 Lulni River',0647942634,'muliwun@cigisoc.hu'),
(2,'Luis' 'Thompson','1722 Upvi Terrace',075416872,'awa@viruf.sb'),
(3,'Lee','Moore','1918 Neade Loop',0634761864,'zuhsa@sacehipi.in'),
(4,'Christian','Ruiz','1812 Fetjet Turnpike',0675189736,'co@uremap.sy');


insert into Employe values
(1,'Frances','Ingram','885 Mobad Grove',0764890211,1),
(2,'Daisy','Underwood','39 Alemoz Manor',0724681238,2),
(3,'Herman','Sparks','1661 Gulov Loop',0734876515,3);


insert into Voiture values
(1, 'Lamborghini', 'Avendator', '2016-01-15', 'Orange', 25000, 150);
(2, 'Audi', 'RS5', '2019-05-20', 'Noir', 23000, 450);
(3, 'Ford', 'Mustang', '2021-08-10', 'Noir', 40000, 300);
(4, 'BMW', 'X6', '2020-11-30', 'Noir', 60000, 280);

insert into Concessionnaire values
(1, '12 rue de la Liberté', 123456789, 1);
(2, '8 avenue des Champs-Élysées', 987654321, 2);
(3, '25 boulevard Haussmann', 456789123, 3);
