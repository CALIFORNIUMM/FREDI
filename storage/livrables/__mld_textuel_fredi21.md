# fredi21 : MLD textuel
```
utilisateur = (id_utilisateur INT, pseudo VARCHAR(50), mdp VARCHAR(255), mail VARCHAR(50), nom VARCHAR(50), prenom VARCHAR(50), role SMALLINT);
ligue = (id_ligue INT, lib_ligue VARCHAR(50));
motif = (id_motif INT, lib_motif VARCHAR(50));
periode = (id_periode INT, lib_periode VARCHAR(50), est_active LOGICAL, mt_km DECIMAL(8,3));
note = (id_note INT, est_valide LOGICAL, mt_total DECIMAL(15,2), dat_remise DATE, nr_ordre INT, #id_periode, #id_utilisateur);
club = (id_club INT, lib_club VARCHAR(50), adr1 VARCHAR(50), adr2 VARCHAR(50), adr3 VARCHAR(50), #id_ligue);
ligne = (id_ligne INT, dat_ligne DATE, lib_trajet VARCHAR(50), nb_km INT, mt_km DECIMAL(15,2), mt_peage DECIMAL(15,2), mt_repas DECIMAL(15,2), mt_hebergement DECIMAL(15,2), mt_total DECIMAL(15,2), #id_motif, #id_note);
adherent = (id_adherent INT, nr_licence VARCHAR(50), adr1 VARCHAR(50), adr2 VARCHAR(50), adr3 VARCHAR(50), #id_club, #id_utilisateur);
```