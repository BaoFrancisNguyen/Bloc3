import mysql.connector
import random
from datetime import datetime

# Configuration for MySQL connection
config = {
    'user': 'bloc3',
    'password': 'bloc3',
    'host': 'database',
    'database': 'bloc3',
    'raise_on_warnings': True
}

# Connect to the database
connection = mysql.connector.connect(**config)
cursor = connection.cursor()

def insert_collecte(cursor, prix_panier_initial, date_achat):
    # Insert a new collecte and return its ID
    cursor.execute("INSERT INTO collectes (date_achat, prix_panier) VALUES (%s, %s)", (date_achat, prix_panier_initial))
    return cursor.lastrowid


def select_and_calculate_prix_panier(cursor, nombre_articles=5):
    # Select random articles and calculate the prix panier
    cursor.execute("SELECT article_id, prix FROM articles")
    articles_disponibles = cursor.fetchall()
    articles_achetes = random.sample(articles_disponibles, nombre_articles)

    prix_panier = 0
    achats = []
    for article_id, prix in articles_achetes:
        quantite = random.randint(1, 10)  # Random quantity for each article
        prix_total_article = prix * quantite
        prix_panier += prix_total_article
        achats.append((article_id, quantite))  # Append a tuple with article_id and the chosen quantity
    return prix_panier, achats

def insert_achats(cursor, achats, collecte_id):
    # Insert details of purchased articles into 'session_articles'
    for article_id, quantite in achats:
        cursor.execute("INSERT INTO session_articles (article_id, quantite, collecte_id) VALUES (%s, %s, %s)",
                       (article_id, quantite, collecte_id))
def insert_client(cursor, nb_enfants, cat_socio_pro, collecte_id):
    # Insert client information associated with this collecte
    cursor.execute("INSERT INTO clients (nb_enfants, cat_socio_pro, collecte_id) VALUES (%s, %s, %s)",
                   (nb_enfants, cat_socio_pro, collecte_id))
    return cursor.lastrowid

def insertion_donnes(nb):

    try:
        for i in range(nb):
            # Step 1: Insert a collecte with an initial prix panier of 0
            date_achat = datetime.now().strftime("%Y-%m-%d")
            collecte_id = insert_collecte(cursor, 0, date_achat)
            
            # Steps 2 and 3: Select articles and calculate the prix panier
            prix_panier, achats = select_and_calculate_prix_panier(cursor)
            
            # Update the prix_panier in the collectes table
            cursor.execute("UPDATE collectes SET prix_panier = %s WHERE collecte_id = %s", (prix_panier, collecte_id))
            
            # Step 4: Insert a client
            nb_enfants = random.randint(0, 5)
            cat_socio_pro = random.choice(['employé', 'ouvrier', 'cadre', 'artiste', 'étudiant', 'retraité'])
            client_id = insert_client(cursor, nb_enfants, cat_socio_pro, collecte_id)
            
            # Step 5: Insert details of purchased articles
            insert_achats(cursor, achats, collecte_id)
            
            # Commit the changes if all operations are successful
            connection.commit()
        
    except mysql.connector.Error as err:
        print(f"Erreur lors de la connexion à la base de données: {err}")
        # Rollback changes in case of an error
        connection.rollback()
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()
            print("Données aléatoires insérées avec succès.")


insertion_donnes(10)












