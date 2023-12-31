CREATE TABLE IF NOT EXISTS clients(
    cat_socio_pro ENUM('employe', 'ouvrier', 'cadre', 'artiste', 'etudiant', 'retraite') NOT NULL,
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
    session_article_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    article_id INTEGER UNSIGNED NOT NULL,
    quantite INTEGER NOT NULL,
    collecte_id INTEGER UNSIGNED NOT NULL,
    FOREIGN KEY (article_id) REFERENCES articles(article_id),
    FOREIGN KEY (collecte_id) REFERENCES collectes(collecte_id)
);


CREATE TABLE IF NOT EXISTS admin(
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL,
    password VARCHAR(256) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);

INSERT INTO articles (categorie, nom, prix)
VALUES
    ('alimentaire', 'fruits', 10),
    ('alimentaire', 'legumes', 5),
    ('alimentaire', 'viandes', 15),
    ('alimentaire', 'poissons', 10),
    ('alimentaire', 'boissons', 3),
    ('alimentaire', 'produits laitiers', 5),
    ('multimédia', 'smartphones', 200),
    ('multimédia', 'ordinateurs', 500),
    ('multimédia', 'casques', 50),
    ('multimédia', 'enceintes', 100),
    ('multimédia', 'televisions', 500),
    ('multimédia', 'consoles', 300),
    ('vêtements', 't-shirts', 20),
    ('vêtements', 'jeans', 50),
    ('vêtements', 'robes', 100),
    ('vêtements', 'chaussures', 50),
    ('vêtements', 'sous-vetements', 10),
    ('vêtements', 'manteaux', 100),
    ('électromenager', 'refrigerateurs', 500),
    ('électromenager', 'lave-linges', 300),
    ('électromenager', 'lave-vaisselle', 200),
    ('électromenager', 'micro-ondes', 100),
    ('électromenager', 'robots', 500),
    ('électromenager', 'cafetières', 100),
    ('jouets', 'poupees', 50),
    ('jouets', 'voitures', 30),
    ('jouets', 'peluches', 20),
    ('jouets', 'jeux de societe', 50),
    ('jouets', 'jeux de construction', 100),
    ('jouets', 'jeux de plein air', 50),
    ('sport', 'velos', 200),
    ('sport', 'raquettes', 50),
    ('sport', 'ballons', 20),
    ('sport', 'halteres', 100),
    ('sport', 'tapis de course', 500),
    ('sport', 'skateboards', 100);

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