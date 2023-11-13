
import pytest
from unittest.mock import MagicMock
import random


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

def test_select_and_calculate_prix_panier():
    # Création d'un mock pour le cursor
    cursor_mock = MagicMock()
    # Définir un ensemble d'articles de test (article_id, prix)
    articles_test = [(1, 10.0), (2, 20.0), (3, 15.0), (4, 5.0), (5, 25.0)]
    cursor_mock.fetchall.return_value = articles_test

    # Appeler la fonction avec le mock
    prix_panier, achats = select_and_calculate_prix_panier(cursor_mock)

    # Vérifications
    assert prix_panier > 0, "Le prix du panier devrait être supérieur à 0"
    assert len(achats) == 5, "Le nombre d'achats devrait être égal à 5"

    # Vérifier que tous les IDs d'articles dans les achats sont valides
    for article_id, _ in achats:
        assert article_id in [a[0] for a in articles_test], "ID d'article non valide trouvé dans les achats"

def insert_collecte(cursor, prix_panier_initial, date_achat):
    # Insert a new collecte and return its ID
    cursor.execute("INSERT INTO collectes (date_achat, prix_panier) VALUES (%s, %s)", (date_achat, prix_panier_initial))
    return cursor.lastrowid

def test_insert_collecte():
    cursor_mock = MagicMock()
    date_achat = "2023-01-01"
    prix_panier_initial = 100

    # Supposons que lastrowid retourne 1 pour cet appel
    cursor_mock.lastrowid = 1

    collecte_id = insert_collecte(cursor_mock, prix_panier_initial, date_achat)

    # Vérifiez que le cursor a été appelé correctement
    cursor_mock.execute.assert_called_with(
        "INSERT INTO collectes (date_achat, prix_panier) VALUES (%s, %s)", 
        (date_achat, prix_panier_initial)
    )
    assert collecte_id == 1

def insert_achats(cursor, achats, collecte_id):
    # Insert details of purchased articles into 'session_articles'
    for article_id, quantite in achats:
        cursor.execute("INSERT INTO session_articles (article_id, quantite, collecte_id) VALUES (%s, %s, %s)",
                       (article_id, quantite, collecte_id))

def test_insert_achats():
    cursor_mock = MagicMock()
    achats = [(1, 2), (2, 3)]  # exemple d'achats
    collecte_id = 1

    insert_achats(cursor_mock, achats, collecte_id)

    # Vérifiez que les appels à la base de données sont corrects
    calls = [
        (("INSERT INTO session_articles (article_id, quantite, collecte_id) VALUES (%s, %s, %s)", (1, 2, collecte_id)),),
        (("INSERT INTO session_articles (article_id, quantite, collecte_id) VALUES (%s, %s, %s)", (2, 3, collecte_id)),)
    ]
    cursor_mock.execute.assert_has_calls(calls, any_order=True)


def insert_client(cursor, nb_enfants, cat_socio_pro, collecte_id):
    # Insert client information associated with this collecte
    cursor.execute("INSERT INTO clients (nb_enfants, cat_socio_pro, collecte_id) VALUES (%s, %s, %s)",
                   (nb_enfants, cat_socio_pro, collecte_id))
    return cursor.lastrowid

def test_insert_client():
    cursor_mock = MagicMock()
    nb_enfants = 2
    cat_socio_pro = "employé"
    collecte_id = 1

    # Supposons que lastrowid retourne 1 pour cet appel
    cursor_mock.lastrowid = 1

    client_id = insert_client(cursor_mock, nb_enfants, cat_socio_pro, collecte_id)

    # Vérifiez que le cursor a été appelé correctement
    cursor_mock.execute.assert_called_with(
        "INSERT INTO clients (nb_enfants, cat_socio_pro, collecte_id) VALUES (%s, %s, %s)", 
        (nb_enfants, cat_socio_pro, collecte_id)
    )
    assert client_id == 1



