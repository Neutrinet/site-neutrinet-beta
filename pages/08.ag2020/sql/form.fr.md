---
title: "Une page d'exemple de formulaire"
form:
    name: Input data
    method: POST
    fields:
      - name: JourArrivee # même nom que les champs de la DB
        type: select
        label: Jour d'arrivée prévu
        options:
          jeudi: jeudi
          vendredi: vendredi
          samedi: samedi
          dimanche: dimanche
        validate: 
          required: true

      - name: NombreNuit
        type: number
        label: 'Nombre de nuit(s) prévue(s)'
        validate:
          min: 1
          max: 4
          step: 1

      - name: NombrePetitDejeuner
        type: number
        label: 'Nombre de petit(s) déjeuner(s)'
        validate:
          min: 1
          max: 4
          step: 1

      - name: NombreDejeuner
        type: number
        label: 'Nombre de déjeuner(s) (dîner pour les belges)'
        validate:
          min: 1
          max: 4
          step: 1

      - name: NombreDiner
        type: number
        label: 'Nombre de dîner(s) (souper pour les belges)'
        validate:
          min: 1
          max: 4
          step: 1

      - name: Pseudo
        label: Votre pseudo au sein de la fédé
        type: text

      - name: Prenom
        label: Votre prénom
        type: text
        
      - name: Nom
        label: Votre nom de famille
        type: text

      - name: EmailSpecial
        type: email
        label: Une adresse mail que vous auriez créé pour l'occasion
      
      - name: Email
        type: email
        label: Votre adresse mail habituelle

      - name: Rue
        label: Rue
        type: text

      - name: NumeroBoite
        label: Numéro / Boîte
        type: text
        
      - name: ComplementAdresse
        label: Un complément d'adresse
        type: text

      - name: Ville
        label: Ville
        type: text

      - name: Pays
        type: select
        label: Pays
        options:
          Belgium: Belgique
          France: France
          Switzerland: Suisse
          Autre: Autre

      - name: CodePostal
        label: Code Postal
        type: text

      - name: NomAssociation
        label: Nom de l'association / organisation que vous représentez
        type: text

      - name: Allergies
        label: Si vous avez des allergies
        type: text

      - name: Commentaire
        label: Si vous avez des commentaires ou autre remarque
        type: text

    process:
      - sql-insert: # this is the crucial one
          table: inscriptions # this must match the table the data is being added to
      #- redirect: showdata # this is optional (see note below)
    
    buttons:
      - type: submit
        value: Add person to database
      - type: reset
        value: Reset
    
    reset: true # this is advised to prevent the same data being added multiple times.
---

# Formulaire

!! Ce formulaire est une ébauche en cours de développement pour les inscriptions à l'AG FFDN 2020

Ceci est un **test** pour les formulaires…
