---
title: "Une page d'exemple de formulaire"
form:
    name: Input data
    method: POST
    fields:
      - name: LastName  # the value here must be the same as a field in the database
        label: Name of person
        type: text
      - name: FirstName
        label: First name of the person
        type: text
      - name: Pseudo
        label: Tha f** surname :p
        validate:
          required: true
        type: text
      - name: Country
        type: select
        label: Person's country
        options:
          Belgium: Belgique
          France: France
          Switzerland: Suisse
      - name: Email
        type: email
        label: Courriel de la personne
        validate: 
          required: true
    process:
      - sql-insert: # this is the crucial one
          table: customers # this must match the table the data is being added to
      - redirect: showdata # this is optional (see note below)
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
