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
        cnx = self.connect_db()
        cursor = cnx.cursor()
        
        # Updated query to select categories and total expenses from the depenses_categorie table
        query = ("""
            SELECT 
                a.categorie,
                SUM(a.prix * sa.quantite) AS total_depense
            FROM 
                session_articles sa
            JOIN
                articles a ON sa.article_id = a.article_id
            JOIN
                collectes col ON sa.collecte_id = col.collecte_id
            JOIN
                clients cli ON col.collecte_id = cli.collecte_id
            WHERE
                cli.cat_socio_pro = %s
            GROUP BY
                a.categorie
        """)
        cursor.execute(query, (self.socio_pro_choice,))
        categories, expenses = [], []
        for row in cursor:
            categories.append(row[0])
            expenses.append(row[1])

        cursor.close()
        cnx.close()

        # Generate a pie chart
        fig1, ax1 = plt.subplots()
        ax1.pie(expenses, labels=categories, autopct='%1.1f%%', startangle=90)
        ax1.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.
        ax1.set_title(f'Total dépenses par catégorie pour {self.socio_pro_choice}')
        plt.savefig("output_category_graph.png")
        print('votre graphique est pret')

    
    def _generate_panier_moyen_graph(self):
        cnx = self.connect_db()
        cursor = cnx.cursor()
        
        # Corrected query to select dates and average paniers from the collectes table
        query = ("""
            SELECT 
                col.date_achat,
                AVG(col.prix_panier) AS panier_moyen
            FROM 
                collectes col
            JOIN
                clients cli ON col.collecte_id = cli.collecte_id
            WHERE
                cli.cat_socio_pro = %s
            GROUP BY
                col.date_achat
            ORDER BY
                col.date_achat
        """)
        cursor.execute(query, (self.socio_pro_choice,))
        dates, averages = [], []
        for row in cursor:
            dates.append(row[0])
            averages.append(row[1])

        cursor.close()
        cnx.close()

        fig1, ax1 = plt.subplots()
        ax1.plot(dates, averages, marker='o')
        ax1.set_ylabel('Panier Moyen')
        ax1.set_xlabel('Date d\'achat')
        ax1.set_title(f'Panier moyen pour {self.socio_pro_choice} en fonction de la date')
        plt.xticks(rotation=45)
        plt.tight_layout()
        plt.savefig("output_panier_moyen_graph.png")
        print('votre graphique est pret')


        cursor.close()
        cnx.close()



if __name__ == "__main__":
    if len(sys.argv) > 2:
        socio_pro_choice = sys.argv[1]
        mode = sys.argv[2]
        db_config = {
            'user': 'bloc3',
            'password': 'bloc3',
            'host': 'database',
            'database': 'bloc3',
            'raise_on_warnings': True
        }
        #print(sys.argv)
        graph_generator = GraphGenerator(db_config, socio_pro_choice, mode)
        #print('constructeur appelé')
        graph_generator.generate_graph()
        #print('méthode appelée')
    else:
        print("Erreur : arguments insuffisants.")


