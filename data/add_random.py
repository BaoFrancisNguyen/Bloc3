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
cat_socio_pro = ['employé', 'ouvrier', 'cadre', 'artiste', 'étudiant', 'retraité']

try:
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()

    for _ in range(10):
        # Générer des données aléatoires pour un client
        nb_enfants = random.randint(0, 5)
        socio_pro = random.choice(cat_socio_pro)
        prix_panier = round(random.uniform(10, 500), 2)
        date_achat = datetime.now().date()

        # Insérer les données du client
        cursor.execute(
            "INSERT INTO clients (nb_enfants, cat_socio_pro, prix_panier, date_achat) VALUES (%s, %s, %s, %s)",
            (nb_enfants, socio_pro, prix_panier, date_achat)
        )

        # Récupérer l'ID du client qui vient d'être crée
        client_id = cursor.lastrowid

        # Créer une nouvelle entrée dans la table 'collectes'
        cursor.execute(
            "INSERT INTO collectes (prix_panier, date_achat, client_id) VALUES (%s, %s, %s)",
            (prix_panier, date_achat, client_id)
        )

        # Récupérer l'ID de la collecte qui vient d'être crée
        collecte_id = cursor.lastrowid

        # Répartition des dépenses par catégorie
        remaining_amount = prix_panier
        while remaining_amount > 0:
            cat = random.choice(categories)
            depense = round(random.uniform(1, remaining_amount), 2)
            remaining_amount -= depense
            cursor.execute(
                "INSERT INTO depenses_categorie (collecte_id, categorie, montant, date_depense) VALUES (%s, %s, %s, %s)",
                (collecte_id, cat, depense, date_achat)
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















