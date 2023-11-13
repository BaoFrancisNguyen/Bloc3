
import pytest
from unittest.mock import MagicMock
from add_random import select_and_calculate_prix_panier

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
