beaucoup de choses à dire sur la brique et Yunohost !

# Niveau 1

C'est le VPN de Neutrinet.

En tenant compte du fait qu'il sera dédié à la Birque. Elle pourra partager cette connexion VPN dés le Niveau 2

# Niveau 2

Pour atteindre ce niveau il faut, en plus du Niveau 1

* Du matériel (commander)
  * une carte Lime1 ou Lime2
  * une alimentation, un boitier
  * une antenne Wifi
  * une carte MicroSD

* Payer pour un nom de domaine (abc.xyz) ou utiliser un domaine offert (abc.noho.st ou abc.nohost.me)

* Installer Yunohost avec
  * l'application client VPN
  * l'application Hot Spot
  * l'application Neutrinet

# Niveau 3

Puisqu'on en est là, autant en demander plus à la brique et en faire un serveur mail

* Configurer correctement le DNS
* Activer Let's Encrypt
* Configurer un enregistrement SPF, donnez au support de Neutrinet
  * le nom de domaine principal de votre brique
  * les adresses IPv4 et IPv6
* Tester avec [Mail Tester](http://mail-tester.com/) jusqu'à obtention d'un 10/10

# Niveau 4

Envisager plus encore en déplaçant le contenu de la carte MicroSD vers un disque SATA.

* Prévoir un câble SATA
* Prévoir un disque SATA (un HDD suffira)

## Faites le vous même

* commander votre VPN
* utilisez votre VPN

## Faisons le ensemble

* lors d'une [Install party]()

## Ou faites le faire par quelqu'un

* lien vers un service payant ?
  * pour l'installation et la configuration ?
  * pour le suivi, les maj, les sauvegardes ?

# Qu'est qu'il y a dans une brique ?

## Hardware (open hardware)

* Carte Olimex
  * 512Mb de RAM pour la lime1
  * 1024Mb de RAM pour la lime2
* Boitier
* Antenne wifi
* Alimentation
* Carte MicroSD
  * Jusqu'à 32Gb pour la Lime1
  * Jusqu'à 64Gb pour la lime2


## Software

* Une distribution GNU/Linux libre et réputbe : Debian
* Un outil qui facilite l'administration de ce serveur : Yunohost

# Services fondamentaux

* Hot Spot
* Serveur mail SMTPs (Postfix)
* Serveur mais POPs et IMAPs (Dovecot)
* Serveur XMPP (Metronome)
* Pare-feu (IPtable)

# Services supplémentaires

* Stockage et partage de fichiers (Nextcloud)
  * Clients pour Mac, Win, GNU/Linux, Androi, IOs
* Wiki (Dokuwiki)
* Agenda (CalDAV ou Agendas Nextcloud)
* Contats (CardDAV ou Contacts Nextcloud)
* Webmal (RoundCube, Rainloop, Mails Nextcloud)


# Et bien plus encore !

* Tout un tas d'applications : apps