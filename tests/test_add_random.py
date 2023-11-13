
import pytest
from unittest.mock import MagicMock
import random
import sys
sys.path.append('../data')
from add_random import select_and_calculate_prix_panier

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

# Vous pouvez ajouter d'autres tests ici
