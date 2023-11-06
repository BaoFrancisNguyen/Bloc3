import mysql.connector
import random
from datetime import datetime

config = {
    'user': 'bloc3',
    'password': 'bloc3',
    'host': '127.0.0.1',
    'database': 'bloc3',
    'raise_on_warnings': True
}

categories = ['alimentaire', 'multimédia', 'vêtements', 'électroménager', 'jouets', 'sport']
articles = {}
articles['alimentaire'] = ['fruits', 'légumes', 'viandes', 'poissons', 'boissons', 'produits laitiers']
articles['multimédia'] = ['smartphones', 'ordinateurs', 'casques', 'enceintes', 'télévisions', 'consoles']
articles['vêtements'] = ['t-shirts', 'jeans', 'robes', 'chaussures', 'sous-vêtements', 'manteaux']
articles['électroménager'] = ['réfrigérateurs', 'lave-linges', 'lave-vaisselles', 'micro-ondes', 'robots', 'cafetières']
articles['jouets'] = ['poupées', 'voitures', 'peluches', 'jeux de société', 'jeux de construction', 'jeux de plein air']
articles['sport'] = ['vélos', 'raquettes', 'ballons', 'haltères', 'tapis de course', 'skateboards']

cat_socio_pro = ['employé', 'ouvrier', 'cadre', 'artiste', 'étudiant', 'retraité']

try:
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()

    # Générer 10 clients aléatoires
    for _ in range(10):

        # Générer les données du client
        
        prix_panier = random.randint(10, 1000)
        date_achat = datetime.now().strftime("%Y-%m-%d")

        # Insérer les données de la collecte
        cursor.execute(
            "INSERT INTO collectes (prix_panier, date_achat) VALUES (%s, %s)",
            (prix_panier, date_achat)
        )
        collecte_id = cursor.lastrowid

        nb_enfants = random.randint(0, 5)
        socio_pro = random.choice(cat_socio_pro)

        # Insérer les données du client
        cursor.execute(
            "INSERT INTO clients (nb_enfants, cat_socio_pro, collecte_id) VALUES (%s, %s, %s)",
            (nb_enfants, socio_pro, collecte_id)
            
        )

        # Récupérer l'ID du client qui vient d'être crée
        client_id = cursor.lastrowid

        ''' Répartition des dépenses par catégorie
        remaining_amount = prix_panier
        while remaining_amount > 0:
            cat = random.choice(categories)
            depense = round(random.uniform(1, remaining_amount), 2)
            remaining_amount -= depense '''

        quantite = random.randint(1, 10)
        article_id = cursor.lastrowid
        # Insérer les données de la session_article
        cursor.execute(
            "INSERT INTO session_articles (article_id, quantite, collecte_id) VALUES (%s, %s, %s)",
            (article_id, quantite, collecte_id)
        )

        # Mise à jour de la table clients avec l'ID de collecte
        cursor.execute(
            "UPDATE clients SET collecte_id = %s WHERE client_id = %s",
            (collecte_id, client_id)
        )

    connection.commit()

except mysql.connector.Error as err:
    print(f"Erreur lors de la connexion à la base de données: {err}")
finally:
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("Données aléatoires insérées avec succès.")















