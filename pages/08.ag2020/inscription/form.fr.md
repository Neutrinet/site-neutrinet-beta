---
title: "Une page d'exemple de formulaire"
form:
    name: contact-form
    fields:
        - name: pseudo
          label: Pseudo
          placeholder: Votre pseudo
          autofocus: on
          autocomplete: on
          type: text
          validate:
            required: true

        - name: name
          label: Nom
          placeholder: Votre nom de famille
          autofocus: off
          autocomplete: off
          type: text
          validate:
            required: false

        - name: first_name
          label: Prénom
          placeholder: Votre prènom
          autofocus: off
          autocomplete: off
          type: text
          validate:
            required: false

        - name: checkboxes
          type: checkboxes
          label: A couple of checkboxes
          default:
            20: false
            10: false
          options:
            20: Nuit
            10: Repas

        - name: combien
          type: number
          label: 'How Much?'
          validate:
            min: 10
            max: 360
            step: 10

    buttons:
        - type: submit
          value: Submit
        - type: reset
          value: Reset

    process:

        - save:
            filename: zorglub.txt
            fileprefix: feedback-
            dateformat: Ymd-His-u
            extension: txt
            body: "{% include 'forms/data.txt.twig' %}"
            operation: add
        - message: Thank you for your feedback!
        - display: ""
        - type: checkboxes
          label: PLUGIN_ADMIN.PROCESS
          help: PLUGIN_ADMIN.PROCESS_HELP
          default:
              markdown: true
              twig: true
          options:
              markdown: Markdown
              twig: Twig
          use: keys

---

# Formulaire

!! Ce formulaire est une ébauche en cours de développement pour les inscriptions à l'AG FFDN 2020

Ceci est un **test** pour les formulaires…

# Liste des questions à pauser

Tenant compte du fait que 

## minimum anonyme ?

Le strict mininmum à savoir serait quoi, en imaginant un formulaire anonyme ?

- date arrivée
- nombre de nuit 
- nombre de petits déjeuner
- nombre de diner
- nombre de souper

Ça veut dire pas d'email, pas d'adresses postale, pas de note de frais possible, et paiement en cash sur place.  C'est un peu chaud.

! Et dans les journaux de notre serveur web, traînera une IP, une date, une heure et quelques autres détails sauf si TorBrowser est utilisé.

## minimum identifiable au sein de la fédé ?

- pseudo
- email (que tu aurais créé pour l'évènement mais qui n'est pas ton email « habituel »)

Paiement en cash sur place mais au moins on sait qui tu es ou qui te seras.

# minimum identifiable grand publique ?

- nom
- prénom
- email habituel

## minimum identifiable comptables ?

- adresse postale
- numéro d'entreprise
- nom d'organisation

## autres question intime ?

- allergies alimentaires
- handicap (mobilité, vue, sociabilisation / phobies,… )
- besoin d'isolement (chambres, espaces quotidiens,… )