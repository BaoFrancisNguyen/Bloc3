CREATE TABLE IF NOT EXISTS clients(
    cat_socio_pro ENUM('employé', 'ouvrier', 'cadre', 'artiste', 'étudiant', 'retraité') NOT NULL,
    client_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nb_enfants INTEGER DEFAULT 0,
    collecte_id INTEGER UNSIGNED NOT NULL
);


CREATE TABLE IF NOT EXISTS collectes(
    collecte_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    date_achat DATE NOT NULL,
    prix_panier FLOAT NOT NULL
);

CREATE TABLE IF NOT EXISTS articles(
    categorie VARCHAR(50) NOT NULL, 
    nom VARCHAR(50) NOT NULL,
    article_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    prix INTEGER NOT NULL
);


CREATE TABLE IF NOT EXISTS session_articles (
    session_article_id VARCHAR(256) NOT NULL,
    article_id INTEGER UNSIGNED NOT NULL,
    quantite INTEGER NOT NULL,
    collecte_id INTEGER UNSIGNED NOT NULL,
    PRIMARY KEY (session_article_id),
    FOREIGN KEY (article_id) REFERENCES articles(article_id),
    FOREIGN KEY (collecte_id) REFERENCES collectes(collecte_id)
);


CREATE TABLE IF NOT EXISTS admin(
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL,
    password VARCHAR(256) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);


--DELIMITER //
--CREATE PROCEDURE InsertAdmin()
--BEGIN
  --DECLARE adminCount INT;

  --SELECT COUNT(*) INTO adminCount FROM admin WHERE login = 'admin';

  --IF adminCount = 0 THEN
    --INSERT INTO admin (login, password, role) VALUES ('admin', PASSWORD('admin'), 'admin');
  --END IF;
--END //
--DELIMITER ;
--CALL InsertAdmin();