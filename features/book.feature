Feature: Gestion des livres
    Ajout, édition, suppression, consultation
    En tant que "admin"
    Je dois pouvoir ajouter un livre, éditer un livre, supprimer un livre, consulter mes livres

    Rules:
    - Doit être administrateur

    Scenario: Ajouter un livre
        Given je suis connecté en tant que "admin"
        When j'ajoute un livre nommé "Dix petits nègres" avec le résumé "Lorem ipsum"
        Then je dois trouver mon livre nommé "Dix petits nègres" dans la liste
    
    Scenario: Editer un livre
        Given je suis connecté en tant que "admin"
        And il existe un livre nommé "Dix petits nègres"
        When j'édite la description du livre nommé "Dix petits nègres" pour devenir "Une nouvelle description"
        Then le livre "Dix petits nègres" doit maintenant avoir la nouvelle description "Une nouvelle description"

    Scenario: Supprimer un livre
        Given je suis connecté en tant que "admin"
        And il existe un livre nommé "Dix petits nègres"
        When je supprime le livre nommé "Dix petits nègres"
        Then le livre nommé "Dix petits nègres" ne doit plus exister

    Scenario: Consulter un livre
        Given je suis connecté en tant que "admin"
        And j'avais ajouté un livre nommé "Dix petits nègres" avec le résumé "Lorem ipsum"
        Then je dois trouver mon livre nommé "Dix petits nègres" dans la liste