import os
import sqlite3

def create_bdd():
    conn = sqlite3.connect('music.db')
    cursor = conn.cursor()

    cursor.execute('''
    CREATE TABLE IF NOT EXISTS music (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        artist TEXT,
        album TEXT,
        path TEXT NOT NULL,
        duration INTEGER NOT NULL
    )
    ''')

    conn.commit()
    conn.close()

def add_music(title, artist, album, path, duration):
    conn = sqlite3.connect('music.db')
    cursor = conn.cursor()

    cursor.execute('''
    INSERT INTO music (title, artist, album, path, duration)
    VALUES (?, ?, ?, ?, ?)
    ''', (title, artist, album, path, duration))

    conn.commit()
    conn.close()

def get_all_titles():
    conn = sqlite3.connect('music.db')
    cursor = conn.cursor()

    cursor.execute('SELECT title FROM music')
    titles = cursor.fetchall()  # Récupère tous les titres
    conn.close()

    # Transforme le résultat en une liste de chaînes de caractères
    return [title[0] for title in titles]  # Récupère uniquement les titres (première colonne)

def take_all_music():
    conn = sqlite3.connect('music.db')
    cursor = conn.cursor()

    cursor.execute('SELECT * FROM music')
    musics = cursor.fetchall()

    conn.close()
    return musics

def add_wav_files_from_folder(folder_path):
    for root, dirs, files in os.walk(folder_path):
        for file in files:
            if file.endswith('.wav'):
                file_path = os.path.join(root, file)   
                title = os.path.splitext(file)[0]
                
                #extraire les informations
                artist = 'test'
                album = 'test'
                
                # Durée temporaire (en secondes) - Tu peux calculer la vraie durée avec une bibliothèque comme `wave` ou `mutagen`
                duration = 0  # Placeholder pour le moment

                # Ajouter la musique dans la base de données
                add_music(title, artist, album, file_path, duration)

# Utilisation de la fonction pour parcourir un dossier et ajouter les fichiers .wav
base_dir = os.path.dirname(os.path.abspath(__file__))
folder_path = os.path.join(base_dir, 'musics')
create_bdd()  # Créer la base de données si elle n'existe pas encore
add_wav_files_from_folder(folder_path)  # Ajouter tous les fichiers .wav du dossier