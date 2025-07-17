#!/bin/sh
# Installation de la base de donnée


# Chemin vers la base de donnée
DB_PATH="bricomachin.db"

# Supprime la base de donnée si elle existait déjà
rm -f "$DB_PATH"

# Lance le gestionnaire et active les ordres pour créer et charger la BD
sqlite3 "$DB_PATH" <<END
.read create.sql
.separator |
.import article.txt article
.import categorie.txt categorie
.q
END
