CREATE TABLE IF NOT EXISTS clients(
    cat_socio_pro ENUM('employé', 'ouvrier', 'cadre', 'artiste', 'étudiant', 'retraité') NOT NULL,
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nb_enfants INTEGER DEFAULT 0
);

-- a "collecte" is basically a purchase from the customer
CREATE TABLE IF NOT EXISTS collectes(
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    date_achat DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS articles(
    categorie VARCHAR(50) NOT NULL, 
    sous_categorie VARCHAR(50) NOT NULL,
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    prix INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS admin(
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);

-- associative tables
CREATE TABLE IF NOT EXISTS clients_collectes(
    id_client INTEGER UNSIGNED NOT NULL,
    id_collecte INTEGER UNSIGNED NOT NULL,
    PRIMARY KEY (id_client, id_collecte),
    FOREIGN KEY (id_client) REFERENCES clients(id),
    FOREIGN KEY (id_collecte) REFERENCES collectes(id)
);
CREATE TABLE IF NOT EXISTS collectes_articles(
    id_collecte INTEGER UNSIGNED NOT NULL,
    id_article INTEGER UNSIGNED NOT NULL,
    PRIMARY KEY (id_collecte, id_article),
    FOREIGN KEY (id_collecte) REFERENCES collectes(id),
    FOREIGN KEY (id_article) REFERENCES articles(id)
);



-- Vérification si l'utilisateur admin existe déjà
--SELECT COUNT(*) FROM admin WHERE login = 'admin';

-- Si l'utilisateur admin n'existe pas, alors on l'insère
--INSERT INTO admin(login, password, role)
--VALUES ('admin', 'admin', 'admin')
--WHERE NOT EXISTS (SELECT 1 FROM admin WHERE login = 'admin');

DELIMITER //
CREATE PROCEDURE InsertAdmin()
BEGIN
  DECLARE adminCount INT;

  SELECT COUNT(*) INTO adminCount FROM admin WHERE login = 'admin';

  IF adminCount = 0 THEN
    INSERT INTO admin (login, password, role) VALUES ('admin', SHA2('admin', 256), 'admin');
  END IF;
END //
DELIMITER ;
CALL InsertAdmin();