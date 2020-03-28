---
title: 'Inscription AG 2020'
cache_enable: false
process:
    twig: true
cache_enable: false
forms:
    minimum_anonyme:
        fields:
            -
                name: JourArrivee
                type: select
                label: 'Jour d''arrivée prévu'
                options:
                    jeudi: jeudi
                    vendredi: vendredi
                    samedi: samedi
                    dimanche: dimanche
                validate:
                    required: true
            -
                name: NombreNuit
                type: number
                label: 'Nombre de nuit(s) prévue(s)'
                validate:
                    min: 1
                    max: 4
                    step: 1
            -
                name: NombrePetitDejeuner
                type: number
                label: 'Nombre de petit(s) déjeuner(s)'
                validate:
                    min: 1
                    max: 4
                    step: 1
            -
                name: NombreDejeuner
                type: number
                label: 'Nombre de déjeuner(s) (dîner pour les belges)'
                validate:
                    min: 1
                    max: 4
                    step: 1
            -
                name: NombreDiner
                type: number
                label: 'Nombre de dîner(s) (souper pour les belges)'
                validate:
                    min: 1
                    max: 4
                    step: 1
        process:
            -
                sql-insert:
                    table: inscriptions
        buttons:
            -
                type: reset
                value: Reset
            -
                type: submit
                value: Minimum
    minimum_fede:
        fields:
            -
                name: Pseudo
                label: 'Votre pseudo au sein de la fédé'
                type: text
            -
                name: EmailSpecial
                type: email
                label: 'Une adresse mail que vous auriez créé pour l''occasion'
        process:
            -
                sql-insert:
                    table: inscriptions
        buttons:
            -
                type: reset
                value: Reset
            -
                type: submit
                value: Fédé
    minimum_publique:
        fields:
            -
                name: Prenom
                label: 'Votre prénom'
                type: text
            -
                name: Nom
                label: 'Votre nom de famille'
                type: text
            -
                name: Email
                type: email
                label: 'Votre adresse mail habituelle'
        process:
            -
                sql-insert:
                    table: inscriptions
        buttons:
            -
                type: reset
                value: Reset
            -
                type: submit
                value: Publique
    minimum_comptable:
        fields:
            -
                name: Rue
                label: Rue
                type: text
            -
                name: NumeroBoite
                label: 'Numéro / Boîte'
                type: text
            -
                name: ComplementAdresse
                label: 'Un complément d''adresse'
                type: text
            -
                name: Ville
                label: Ville
                type: text
            -
                name: Pays
                type: select
                label: Pays
                options:
                    Belgium: Belgique
                    France: France
                    Switzerland: Suisse
                    Autre: Autre
            -
                name: CodePostal
                label: 'Code Postal'
                type: text
            -
                name: NomAssociation
                label: 'Nom de l''association / organisation que vous représentez'
                type: text
        process:
            -
                sql-insert:
                    table: inscriptions
        buttons:
            -
                type: reset
                value: Reset
            -
                type: submit
                value: Comptable
    questions_intimes:
        fields:
            -
                name: Allergies
                label: 'Si vous avez des allergies'
                type: text
            -
                name: Commentaire
                label: 'Si vous avez des commentaires ou autre remarque'
                type: text
        process:
            -
                sql-insert:
                    table: inscriptions
        buttons:
            -
                type: reset
                value: Reset
            -
                type: submit
                value: 'Add person to database'
---

## Inscription

Si vous avez la possibilité de nous soutenir financièrement, merci de passer par la page [don](don).

!! Les inscriptions ne sont pas encore possible à l'heure actuelle (fin mars 2020) et nous mettons ce que nous pouvons en œuvre pour faire avancer ce travail.


## À propos de ce formulaire

!! Ce formulaire est une ébauche en cours de développement pour les inscriptions à l'AG FFDN 2020

!!! Truc bizarre… le 1er formulaire est **automatiquement inclus en bas de bage !!**


### anonyme ?

Dans le respect de l'anonymat, le plus simple pour toi nous avertir de ta présence à l'AG et pour nous pouvoir évaluer les quantités nécessaires pour les repas, il serait bon de nous envoyer un **courrier postal**.

Choisi un **mot secret** que tu noteras sur **le dessus** de ta letter.  Ça nous permettra de nous reconnaître lors de l'AG pour le paiment.

Pour toi et tes ami·e·s si vous êtes à plusieurs, merci de nous renseigner sur ce qui suit; 

- Ton jour prévu d'arrivée (jeudi, vendredi, samedi (jour de l'AG), dimanche)
- Le nombre de petits déjeuner : de 1 à 4
  - Vendredi matin
  - Samedi matin
  - Dimanche matin
  - Lundi matin
- Le nombre de déjeuners (dîner pour les belges) : de 1 à 4
  - Jeudi midi
  - Vendredi midi
  - Samedi midi
  - Dimanche midi
- Le nombre de dîners (souper pour les belges) : de 1 à 4
  - Jeudi soir
  - Vendredi soir
  - Samedi soir
  - Dimanche soir
- Avec des infos plus intimes comme des allergies ou d'autre détails qui te semblent importants.
- Tes commentaires, remarques ou un petit mot.

**Pour le paiement**, étant à prix libre, merci de prévoir de quoi pouvoir **nous payer durant l'AG** , en fonction de tes moyen et en comptant comme estimation : 12€ pour devenir membre du PAF *(comme expliquer dans [leur document](/ag2020/paf))*, 20€ par nuit, et ce que tu pourrais donner pour la bouffe.

Notre adresse : Neutrinet, 81 Avenue des Saisons, 1050 Ixelles, Belgique.

En Belgique, le secret des correspondances et inscrit dans la constitution.

### minimum identifiable au sein de la fédé ?

{% include "forms/form.html.twig" with { form: forms('minimum_fede') } %}

- pseudo
- email (que tu aurais créé pour l'évènement mais qui n'est pas ton email « habituel »)

Paiement en cash sur place mais au moins on sait qui tu es ou qui te seras.

### minimum identifiable grand publique ?

{% include "forms/form.html.twig" with { form: forms('minimum_publique') } %}

- nom
- prénom
- email habituel

### minimum identifiable comptables ?

{% include "forms/form.html.twig" with { form: forms('minimum_comptable') } %}

- adresse postale
- numéro d'entreprise
- nom d'organisation

### autres questions intimes ?

{% include "forms/form.html.twig" with { form: forms('questions_intimes') } %}

- allergies alimentaires
- handicap (mobilité, vue, sociabilisation / phobies,… )
- besoin d'isolement (chambres, espaces quotidiens,… )

### minimum anonyme ?

Le strict mininmum à savoir serait quoi, en imaginant un formulaire anonyme ?

!!!! Concernant l'anonymat, nous avons dans l'idée de proposer de passer par la poste comme expliqué en début de formulaire.

- date arrivée
- nombre de nuit 
- nombre de petits déjeuner
- nombre de diner
- nombre de souper

Ça veut dire pas d'email, pas d'adresses postale, pas de note de frais possible, et paiement en cash sur place.  C'est un peu chaud.

! Et dans les journaux de notre serveur web, traînera une IP, une date, une heure et quelques autres détails sauf si TorBrowser est utilisé.

!! Il faudrait proposer un *code d'inscription (d'une liste de mots amusants ?)* pour que lors de l'AG on puisse collecter de l'argent de celles et ceux qui se seraient enregistré anonymenent.
