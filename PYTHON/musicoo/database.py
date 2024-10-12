import sqlite3

def creer_base_de_donnees():
    conn = sqlite3.connect('app.db')
    cursor = conn.cursor()

    # Création d'une table pour stocker les informations musicales
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS musiques (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titre TEXT NOT NULL,
            artiste TEXT NOT NULL,
            chemin_fichier TEXT NOT NULL
        )
    ''')
    
    conn.commit()
    conn.close()

def ajouter_musique(titre, artiste, chemin_fichier):
    conn = sqlite3.connect('app.db')
    cursor = conn.cursor()

    # Insertion d'une musique dans la base de données
    cursor.execute('''
        INSERT INTO musiques (titre, artiste, chemin_fichier)
        VALUES (?, ?, ?)
    ''', (titre, artiste, chemin_fichier))

    conn.commit()
    conn.close()
