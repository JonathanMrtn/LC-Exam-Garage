# LC-Exam-Garage
Examen blanc de prise en main des méthodes d'examen sur un projet de garage en PHP
## Build du projet

Pour construire le projet, suivez les étapes ci-dessous :

1. Clonez le dépôt :
    ```bash
    git clone https://github.com/votre-utilisateur/LC-Exam-Garage.git
    ```
2. Accédez au répertoire du projet :
    ```bash
    cd LC-Exam-Garage
    ```
3. Installez les dépendances via Composer :
    ```bash
    composer install
    ```
4. Configurez votre environnement en copiant le fichier `.env.example` en `.env` et en modifiant les paramètres nécessaires :
    ```bash
    cp .env.example .env
    ```
5. Générez la clé de l'application :
    ```bash
    php artisan key:generate
    ```

## Tests unitaires

Pour exécuter les tests unitaires, utilisez la commande suivante :
```bash
php artisan test
```
Assurez-vous d'avoir configuré votre environnement de test dans le fichier `.env.testing`.

## Principaux développements

Les principaux développements réalisés dans ce projet incluent :

- **Gestion des véhicules** : Ajout, modification, suppression et affichage des véhicules.
- **Gestion des clients** : Ajout, modification, suppression et affichage des clients.
- **Gestion des rendez-vous** : Planification, modification et annulation des rendez-vous.
- **Authentification et autorisation** : Système d'inscription, de connexion et de gestion des rôles des utilisateurs.
- **Interface utilisateur** : Création d'une interface utilisateur réactive et conviviale avec Bootstrap.

Ces fonctionnalités permettent de gérer efficacement un garage automobile en ligne.