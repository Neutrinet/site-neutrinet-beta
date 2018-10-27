---
title: Compta!
---

La génération automatique d'une Table of Content est due à deux choses :

* le plugin TOC machin truc
* l'instertion d'un morceau de code dans un fichier `twig` du theme de `Neutrinet` comme expliqué [ici](https://github.com/trilbymedia/grav-plugin-page-toc/blob/develop/README.md#usage)

# Compte bancaire

- https://www.ing.be/fr/business/login
- Cliquer sur "mes comptes à vue", puis "exporter des mouvements"
- Entrer les date "de/à" (la moulinette d'import gère les doublons)

# Uploader le fichier CSV des transactions dans notre outil d'administration
- Le site d'administration de Neutrinet se trouve: https://admin.neutrinet.be/admin/
- Se rendre sur https://admin.neutrinet.be/accounts/upload_record_bank_csv/ pour uploader le ficher CSV
- Une fois l'upload fait, vous pouvez visualiser l'import (il faudra probablement mettre les titres de certaines opérations à jour (cfr FIXME))
- Sur cette page vous voyez tous les mouvements que vous pouvez éditer (pour les FIXME): https://admin.neutrinet.be/admin/accounts/movement/


# Tâches diverses
- mettre les factures in/out dans le NextCloud > Administrative > Compta > année
- marquer les emails/tickets concernant les factures que l'on reçoit via le [support](https://beta-support.neutrinet.be/) comme "fermés" avec un commentaire (payé, traité, ...)

# Déclaration fiscale
Où ? Quand? Via biztax, annuellement.
"La date limite légale de dépôt est le dernier jour du mois suivant celui de l'AG statutaire, sans tomber plus de 6 mois à partir de la date de clôture de l'exercice."

Clôture exercice de Neutrinet : 31 décembre N.
L'AG doit donc être organisée en janvier, février, mars, avril, ou mai.

Date limite du dépôt de la déclaration IPM (impôts de personnes morales) : 27 septembre pour 2018 car nous disposons de la "période complémentaire".


# Créer le fichier PDF à envoyer à BizTax
- Se rendre sur la page de compta publique: https://admin.neutrinet.be/accounts/
- Copier/coller les transactions de l'année dans le template LibreOffice (qui se trouve dans le [NextCloud](https://files.neutrinet.be) > Administrative > Compta > template-bilan-biztax.odt)
- Générer un PDF
- Suivre les instructions BizTax: https://wiki.neutrinet.be/administration/comptes-annuels

#  Dépôt des comptes annuels
Où ? Au greffe du Tribunal de Commerce : Boulevard de la deuxième armée Britannique 148 à 1190 FOREST  Tel. : 02/348.96.70   [site](http://www.juridat.be/tribunal_commerce/bruxelles/)

Quand ? Le dépôt des comptes annuels doit intervenir au plus tard dans le mois suivant leur approbation (ou leur refus) par l'AG. Compte tenu de la date butoir de l’approbation des comptes, le dépôt des comptes doit donc être opéré au plus tard sept mois après la clôture de l’exercice écoulé.

Pour plus d'infos, un chouette document [ici](http://vieassociative.be/sites/default/files/20140724-comptes-annuels-petite-asbl.pdf)


# Taxe annuelle sur les ASBL
[C](https://finances.belgium.be/fr/asbl/impots_et_tva/declaration_d_impot)
