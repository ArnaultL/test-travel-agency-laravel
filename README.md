## A propos

Laravel simple projet de test, simulation de création de voyages avec leurs étapes.
Possibilitée de supprimer les étapes.

## Installation

Pour installer le projet, il faut :

Renommer

```
.env.example => .env
```
Lancer si on a composer d'installé sur sa machine sinon suivre la procédure : https://laravel.com/docs/9.x/sail

```
./vendor/bin/sail up
```

Charger le fichiers SQL pour avoir des données de tests

```
travel_agency_filled.sql
```

Pour lancer les TU, créer la table Travel dans la bdd de test dans phpMyAdmin en lançant par exemple :

```
CREATE TABLE `travels` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `travels`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `travels`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
```
