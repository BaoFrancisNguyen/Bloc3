# Description: Génère un graphique en fonction de la catégorie socio-professionnelle et du mode choisis
import mysql.connector
import matplotlib.pyplot as plt
import sys


class GraphGenerator:

    
    def __init__(self, db_config, socio_pro_choice, mode):
      
        self.db_config = db_config
        self.socio_pro_choice = socio_pro_choice
        self.mode = mode

    def connect_db(self):
        #print('connexion à la base de données')
        return mysql.connector.connect(**self.db_config)
    

    def generate_graph(self):
       
        if self.mode == "categorie":
            self._generate_category_graph()
        elif self.mode == "prix_panier":
            self._generate_panier_moyen_graph()

    def _generate_category_graph(self):
        #print('création du graphique')
        cnx = self.connect_db()
        cursor = cnx.cursor()
        query = ("""
            SELECT 
                d.categorie,
                SUM(d.montant) AS total_depense
            FROM 
                depenses_categorie d
            JOIN
                clients c ON d.collecte_id = c.collecte_id
            WHERE
                c.cat_socio_pro = %s
            GROUP BY
                d.categorie
        """)
        cursor.execute(query, (self.socio_pro_choice,))
        labels, sizes = [], []
        for row in cursor:
            labels.append(row[0])
            sizes.append(row[1])
        cursor.close()
        cnx.close()

        fig1, ax1 = plt.subplots()
        ax1.pie(sizes, labels=labels, autopct='%1.1f%%', startangle=90)
        ax1.axis('equal')
        plt.savefig("output_category_graph.png")
        #print('votre graphique est prêt')

    def _generate_panier_moyen_graph(self):
        #print('création du graphique')
        cnx = self.connect_db()
        cursor = cnx.cursor()
        
        # Modification de la requête pour sélectionner les dates et les paniers moyens par date
        #print('chargement des données')
        query = ("""
            SELECT 
                c.date_achat,
                AVG(c.prix_panier) AS panier_moyen
            FROM 
                clients c
            WHERE
                c.cat_socio_pro = %s
            GROUP BY
                c.date_achat
            ORDER BY
                c.date_achat
        """)
        cursor.execute(query, (self.socio_pro_choice,))
        dates, averages = [], []
        #print(dates, averages)
        for row in cursor:
            dates.append(row[0])
            averages.append(row[1])
            #print(dates, averages)

        cursor.close()
        cnx.close()

        fig1, ax1 = plt.subplots()
        ax1.plot(dates, averages, marker='o')  # Utilisation de plot pour un graphique linéaire
        ax1.set_ylabel('Panier Moyen')
        ax1.set_xlabel('Date d\'achat')
        ax1.set_title(f'Panier moyen pour {self.socio_pro_choice} en fonction de la date')
        plt.xticks(rotation=45)  # Rotation des étiquettes pour une meilleure lisibilité
        plt.tight_layout()  # Ajustement pour s'assurer que les étiquettes ne se chevauchent pas
        plt.savefig("output_panier_moyen_graph.png")
        #print('votre graphique est prêt')



if __name__ == "__main__":
    if len(sys.argv) > 2:
        socio_pro_choice = sys.argv[1]
        mode = sys.argv[2]
        db_config = {
            'user': 'root',
            'password': '',
            'host': '127.0.0.1',
            'database': 'fichier_clients',
            'raise_on_warnings': True
        }
        #print(sys.argv)
        graph_generator = GraphGenerator(db_config, socio_pro_choice, mode)
        #print('constructeur appelé')
        graph_generator.generate_graph()
        #print('méthode appelée')
    else:
        print("Erreur : arguments insuffisants.")

        


