---
title: 'Commande de ligne internet'
menu: 'Commande de ligne internet'
template: modular/form
form:
    keep_alive: true
    name: collect-form
    fields:
        contact_section:
            title: Coordonnées
            text: 'Nous avons besoin de vos coordonnées'
            type: spacer
            fields:
                name:
                    label: Nom
                    placeholder: 'Indiquez votre nom'
                    autofocus: 'on'
                    autocomplete: 'on'
                    type: text
                    validate:
                        required: true
                email:
                    label: E-mail
                    placeholder: 'Indiquez votre adresse e-mail'
                    type: email
                    validate:
                        required: true
                address:
                    label: 'Adresse de la ligne internet'
                    placeholder: 'Indiquez l''adresse complète (étage ou numéro de boite compris) de la ligne internet'
                    type: text
                    validate:
                        required: true
        current_technology:
            label: 'Technologie actuelle'
            placeholder: 'Dites-nous ce que vous souhaitez comme bande passante'
            type: radio
            options:
                vdsl: VDSL
                fibre: Fibre
                coaxial: Coaxial
            validate:
                required: true
        wanted_technology:
            label: 'Technologie souhaitée'
            help: 'Dites-nous ce que vous souhaitez comme type de ligne internet'
            type: checkboxes
            options:
                vdsl: 'VDSL 100/40 mbps (50€/mois)'
                gpon0: 'Fibre 50/10 mbps (50€/mois)'
                gpon1: 'Fibre 150/50 mbps (60€/mois)'
                gpon2: 'Fibre 500/100 mbps (75€/mois)'
            help_options:
                vdsl: 'La VDSL est disponible avec un débit théorique maximal de 100 mbps en téléchargement et 40 mbps en upload.'
            validate:
                required: true
        router_needed:
            label: 'Besoin d''un routeur?'
            type: toggle
            highlight: 1
            validate:
                required: true
                type: bool
        basic-captcha:
            label: 'Veuillez résoudre le problème mathématique.'
            type: basic-captcha
            captcha_type: basic
            validate:
                required: true
    buttons:
        submit:
            type: submit
            value: 'C''est parti !'
    process:
        basic-captcha:
            message: 'La vérification humaine a échoué, veuillez réessayer...'
        email:
            -
                to: '{{ form.value.email }}'
                subject: '[Neutrinet] Merci pour votre mail'
                body: "Bonjour {{ form.value.name }},\n\nMerci pour votre message ! Nous reviendrons vers vous dès que possible.\n\nBien à vous,\nNeutrinet asbl"
            -
                subject: '[Neutrinet] Commande de ligne internet'
                reply_to: '{{ form.value.name }} <{{ form.value.email }}>'
                body: '{{ form.value.description }}'
        save:
            fileprefix: collect-
            dateformat: Ymd-His-u
            extension: txt
            body: '{% include ''forms/data.txt.twig'' %}'
        message: "Merci pour votre message\_!"
published: true
cache_enable: false
---

Test
