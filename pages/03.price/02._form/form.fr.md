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
                name:
                    label: Nom
                    placeholder: 'Indiquez votre nom'
                    autofocus: 'on'
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
                    label: "Raison sociale  \n*Remplissez ce champ si vous prenez la ligne internet au nom d'une personne morale.*"
                    data_label: 'Raison sociale'
                    markdown: true
                    placeholder: 'Indiquez le nom de la personne morale'
                    type: text
                    validate:
                        required: false
                vat:
                    label: "Numéro de TVA  \n*Remplissez ce champ si la personne morale est assujettie à la TVA.*"
                    data_label: 'Numéro de TVA'
                    markdown: true
                    placeholder: 'Indiquez le numéro de TVA de la personne morale'
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
                address:
                    label: "Quelle est l'adresse de la ligne internet\_?  \n*Veuillez indiquer l'adresse la plus complète possible (étage ou numéro de boite compris).*"
                    data_label: 'Adresse de la ligne internet'
                    markdown: true
                    placeholder: 'Indiquez l''adresse complète de la ligne internet'
                    type: text
                    validate:
                        required: true
                current_technology:
                    label: "Quel type de connexion internet avez-vous actuellement\_?"
                    data_label: 'Technologie actuelle'
                    markdown: true
                    type: radio
                    options:
                        vdsl: VDSL
                        fibre: Fibre
                        coaxial: Coaxial
                    validate:
                        required: true
                wanted_technology:
                    label: "Quel(s) type(s) de connexion(s) internet souhaitez-vous\_?  \n*Vous pouvez choisir plusieurs options, nous vérifierons ce qui est disponible à votre adresse.*"
                    data_label: 'Technologie(s) souhaitée(s)'
                    markdown: true
                    type: checkboxes
                    options:
                        vdsl: "VDSL 100/40 mbps (50\_€/mois)"
                        gpon0: "Fibre 50/10 mbps (50\_€/mois)"
                        gpon1: "Fibre 150/50 mbps (60\_€/mois)"
                        gpon2: "Fibre 500/100 mbps (75\_€/mois)"
                    validate:
                        required: true
                easy_switch:
                    label: "Si vous migrez vers la même technologie, indiquez le code easy switch qui se trouve sur la facture de votre FAI actuel.  \n*En cas d'easy switch, les frais d'installation sont moins chers (30\_€ au lieu de 180\_€).*"
                    data_label: 'Code easy switch'
                    markdown: true
                    type: text
                    validate:
                        required: false
                router_choice:
                    label: "Avez-vous besoin d'un routeur\_?"
                    data_label: Routeur
                    markdown: true
                    type: radio
                    options:
                        mikrotik: "Oui, je souhaite commander un routeur Mikrotik hap ac² avec Openwrt installé (75\_€)"
                        other: 'Non, je souhaite utiliser mon propre routeur (par ex. Fritzbox)'
                    validate:
                        required: true
                router_model:
                    label: "Si vous utilisez votre propre routeur, indiquez-nous le modèle\_:"
                    data_label: 'Modèle du routeur'
                    markdown: true
                    placeholder: "Indiquez le modèle de votre routeur (par ex.\_: Fritzbox 7530 AX)"
                    type: text
                    validate:
                        required: false
                comment:
                    type: honeypot
                message:
                    label: 'Informations supplémentaires'
                    type: textarea
                    rows: 6
                    validate:
                        required: false
        basic-captcha:
            label: 'Veuillez résoudre le captcha'
            type: basic-captcha
            store: false
            captcha_type: characters
            chars:
                font: zxx-sans.ttf
                size: 24
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
                body:
                    -
                        content_type: text/html
                        body: '{% include ''forms/collect-order-user.html.twig'' %}'
                    -
                        content_type: text/plain
                        body: '{% include ''forms/collect-order-user.txt.twig'' %}'
            -
                to: hgo@batato.be
                subject: '[Neutrinet] Commande de ligne internet'
                reply_to: '{{ form.value.firstname }} {{ form.value.name }} <{{ form.value.email }}>'
                body:
                    -
                        content_type: text/html
                        body: '{% include ''forms/data.html.twig'' %}'
                    -
                        content_type: text/plain
                        body: '{% include ''forms/data.txt.twig'' %}'
        save:
            fileprefix: collect-
            dateformat: Ymd-His-u
            extension: json
            body: '{% include ''forms/data.json.twig'' %}'
        message: "Merci pour votre message\_!"
        reset: true
published: true
cache_enable: false
media:
    featured_image:
        toggle: true
        file: {  }
partials:
    header_subtitle:
        toggle: true
    metadata:
        where: header
    breadcrumbs:
        toggle: false
---

## Commande de ligne internet