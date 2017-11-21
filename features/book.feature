Feature: Gestion des livres 
    Pour pouvoir les consulter, éditer ou supprimer
    En tant qu'administrateur
    Je dois pouvoir ajouter un livre 

    Rules:
    - Doit être administrateur

    Scenario: Ajouter un livre
        Given je suis connecté en tant qu'administrateur
        When j'ajoute un nouveau livre nommé "Dix petits nègres" avec le résumé "Lorem ipsum"
        Then je dois trouver mon nouveau livre dans la liste
    
    Scenario: Editer un livre
        Given je suis connecté en tant qu"administrateur
        And il existe un livre nommé "Dix petits nègres"
        When j'édite la description de ce livre pour devenir "Une nouvelle description"
        Then le livre "Dix petits nègres" doit maintenant avoir la nouvelle description "Une nouvelle description"

    Scenario: Supprimer un livre
        Given je suis connecté en tant qu'administrateur
        And il existe un livre nommé "Dix petits nègres"
        When je supprime ce libre
        Then ce livre ne doit plus apparaître dans la liste des livres existants

    Scenario: Consulter un livre
        Given il existe un livre nommé "Dix petits nègres"
        When je consulte le livre "Dix petits nègres"
        Then je peux lire le titre du livre et sa description