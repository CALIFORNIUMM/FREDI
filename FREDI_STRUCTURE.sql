CREATE TABLE ligues(
   id_ligue INT,
   nom VARCHAR(50),
   PRIMARY KEY(id_ligue)
);

CREATE TABLE clubs(
   id_club INT,
   nom VARCHAR(50),
   id_ligue INT NOT NULL,
   PRIMARY KEY(id_club),
   FOREIGN KEY(id_ligue) REFERENCES ligues(id_ligue)
);

CREATE TABLE utilisateur(
   id_utilisateur INT,
   pseudo VARCHAR(50),
   mdp VARCHAR(255),
   role INT,
   adresse_mail VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   PRIMARY KEY(id_utilisateur)
);

CREATE TABLE motif_deplacement(
   id_deplacement INT,
   libelle VARCHAR(50),
   PRIMARY KEY(id_deplacement)
);

CREATE TABLE adherent(
   id_utilisateur INT,
   numero_rue VARCHAR(50),
   nom_rue VARCHAR(50),
   cp VARCHAR(50),
   ville VARCHAR(50),
   club VARCHAR(50),
   num_license VARCHAR(50),
   id_club INT NOT NULL,
   PRIMARY KEY(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
   FOREIGN KEY(id_club) REFERENCES clubs(id_club)
);

CREATE TABLE controleur(
   id_utilisateur INT,
   PRIMARY KEY(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE administrateur(
   id_utilisateur INT,
   PRIMARY KEY(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE periode_fiscale(
   id_periode INT,
   libelle VARCHAR(50),
   montant_forfaitaire VARCHAR(50),
   periode_active INT,
   date_periode DATE,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_periode),
   FOREIGN KEY(id_utilisateur) REFERENCES controleur(id_utilisateur)
);

CREATE TABLE notes_de_frais(
   id_note INT,
   indic_validite VARCHAR(50),
   montant_total_ligne VARCHAR(50),
   date_remise_note VARCHAR(50),
   id_periode INT NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_note),
   FOREIGN KEY(id_periode) REFERENCES periode_fiscale(id_periode),
   FOREIGN KEY(id_utilisateur) REFERENCES adherent(id_utilisateur)
);

CREATE TABLE lignes_de_frais(
   id_ligne INT,
   libelle_deplacement VARCHAR(50),
   nb_km VARCHAR(50),
   montant_peage VARCHAR(50),
   montant_repas VARCHAR(50),
   montant_hebergement VARCHAR(50),
   id_deplacement INT NOT NULL,
   id_note INT NOT NULL,
   PRIMARY KEY(id_ligne),
   FOREIGN KEY(id_deplacement) REFERENCES motif_deplacement(id_deplacement),
   FOREIGN KEY(id_note) REFERENCES notes_de_frais(id_note)
);
