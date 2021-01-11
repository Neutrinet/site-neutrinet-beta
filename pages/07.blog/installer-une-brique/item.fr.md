---
title: 'Installer une Brique Internet'
date: '01/23/2020 12:00 pm'
taxonomy:
    category:
        - blog
    tag:
        - lime1
        - lime2
        - microsd
        - tutoriel
subtitle: 'Sur une lime1 ou lime 2, avec Yunohost et un VPN de Neutrinet'
visible: false
---

Si vous n'utilisez pas de disque dur SATA, la [carte microSD](../microsd) contient **toutes vos données**, le démarrage (boot), le système d'exploitation (Debian/Yunohost), vos données personnelles et celles des utilisateurs et utilisatrices que vous hébergez _(mails, fichiers, bases de données, agendas, contacts, etc.)_.

===
## Prérequis

* Un ordinateur équipé d'un système d'exploitation [GNU/Linux](https://fr.wikipedia.org/wiki/Linux_ou_GNU/Linux).
* Une Olimex LIME1 ou LIME2
* Une carte [microSD performante](https://wiki.neutrinet.be/fr/cube/microsd#class_et_vitesse)

## VPN

Avec un [VPN](/fr/vpn) de Neutrinet vous aurez droit à une IPv4 fixe et aussi un /64 en IPv6.

## Nom de domaine

Si vous ne disposez pas d'un [nom de domaine](https://fr.wikipedia.org/wiki/Nom_de_domaine), nous pouvons l'enregistrer pour vous et nous utilisons [Gandi](https://www.gandi.net) comme [registrar](https://fr.wikipedia.org/wiki/Registraire_de_nom_de_domaine).

Une autre possibilité étans de prendre un sous-domaine fournit par Yunohost et qui propose unmot.noho.st ou unmot.nohost.me.

## Installation

Voir le [script d'installation](https://git.domainepublic.net/Neutrinet/neutrinet_cube_install)