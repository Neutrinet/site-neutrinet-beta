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
            type: section
            underline: true
            fields:
                description:
                    text: 'Nous avons besoin de vos coordonnées'
                    type: spacer
                name:
                    label: Nom
                    placeholder: 'Indiquez votre nom'
                    autofocus: 'on'
                    autocomplete: 'on'
                    type: text
                    validate:
                        required: true
                firstname:
                    label: Prénom
                    placeholder: 'Indiquez votre prénom'
                    type: text
                    validate:
                        required: true
                email:
                    label: E-mail
                    placeholder: 'Indiquez votre adresse e-mail'
                    type: email
                    validate:
                        required: true
                company_name:
                    label: 'Raison sociale'
                    placeholder: 'Indiquez le nom de la personne morale'
                    type: text
                    validate:
                        required: false
                vat:
                    label: 'Numéro de TVA'
                    placeholder: 'Indiquez votre numéro de TVA'
                    type: text
                    validate:
                        required: false
                address:
                    label: 'Adresse ou siège social'
                    placeholder: 'Indiquez votre adresse ou le siège social de la personne morale'
                    type: text
                    validate:
                        required: true
        technnical_section:
            title: 'Ligne internet'
            type: section
            fields:
                description:
                    text: 'Cette section vous permet de nous indiquer quel type de ligne internet vous souhaitez.<br /><em>Veuillez indiquer l''adresse la plus complète possible (étage ou boite postale compris). Vous pouvez choisir plusieurs options, nous vérifierons ce qui est disponible à votre adresse.</em>'
                    type: spacer
                address:
                    label: "Quelle est Adresse de la ligne internet\_? Veuillez indiquer l'adresse la plus complète possible (étage ou numéro de boite compris)."
                    placeholder: 'Indiquez l''adresse complète (étage ou numéro de boite compris) de la ligne internet'
                    type: text
                    validate:
                        required: true
                current_technology:
                    label: 'Quel type de connexion internet avez-vous actuellement ?'
                    type: radio
                    options:
                        vdsl: VDSL
                        fibre: Fibre
                        coaxial: Coaxial
                    validate:
                        required: true
                wanted_technology:
                    label: "Quel(s) type(s) de connexion(s) internet souhaitez-vous\_? Vous pouvez choisir plusieurs options, nous vérifierons ce qui est disponible à votre adresse."
                    type: checkboxes
                    options:
                        vdsl: "VDSL 100/40 mbps (50\_€/mois)"
                        gpon0: "Fibre 50/10 mbps (50\_€/mois)"
                        gpon1: "Fibre 150/50 mbps (60\_€/mois)"
                        gpon2: "Fibre 500/100 mbps (75\_€/mois)"
                    validate:
                        required: true
                easy_switch:
                    label: "Si vous migrez vers la même technologie, veuillez nous fournir le code easy switch qui se trouve sur la facture de votre FAI actuel. En cas d'easy switch, les frais d'installation sont moins chers (30\_€ au lieu de 180\_€)."
                    type: text
                    placeholder: 'Indiquez le code easy switch qui se trouve sur la facture de votre FAI actuel'
                    validate:
                        required: false
                router_choice:
                    label: 'Avez-vous besoin d''un routeur ?'
                    type: radio
                    options:
                        mikrotik: "Oui, je souhaite commander un routeur Mikrotik hap ac² avec Openwrt installé (75\_€)"
                        other: 'Non, je souhaite utiliser mon propre routeur (par ex. Fritzbox)'
                    validate:
                        required: true
                router_model:
                    label: "Si vous utilisez votre propre routeur, merci d'indiquer le modèle\_:"
                    type: text
                    validate:
                        required: false
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

