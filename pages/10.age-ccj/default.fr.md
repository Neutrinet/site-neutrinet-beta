---
title: 'AGE CCJ'
published: true
visible: false
---

## Mise en contexte

En Belgique (et pas que), la société est de plus en plus <s>digitalisée</s> numérique, hiérachique et dominée par l'idéologie néo-libérale comme en témoignera, en 2019 pour la Belgique, de l'entrée en vigueur du [nouveau code des sociétés et associations](https://www.lecho.be/dossiers/code-des-societes/les-asbl-auront-davantage-la-possibilite-de-faire-du-profit/10121921.html).

!!! Lorsque nous recevons un courrier *officiel*, il est souvent adressé « à l'attention de la direction ».

![À l'attention de la Direction](courrier-banque.png?class=float-center) effectif·ve·s sont censé·e·s être admis·e par le Conseil d'Administration et avoir payé leur cotisation *([art. 5](https://wiki.neutrinet.be/fr/administration/statuts#article_5) de nos status)*.


## Cellule de Coordination avec la Justice

En septembre 2021, l'IBPT (Institut belge des services postaux et des télécommunications) via un email nous a averti de l'obligation de constituer une CCJ (Cellule de Coordination avec la Justice).


[ui-tabs position="top-left" active="0" theme="default"]

[ui-tab title="Obligations légales"]

Il faut au minimum une personne au sein de la CCJ.  Plusieurs serait judicieux par soucis de disponibilité et de contrôle interne.  Chaque membre de la CCJ subira une enquête d'avis de sécurité (casier vierge, pas de collusion avec un parti politique, pas d'influence d'une entité étrangère, ...) pour pouvoir répondre aux demandes reçues par les autorités belges.

Les personnes renseignées dans cette cellule doivent s'assurer de la légalité de la demande. Celle-ci doit correspondre à un article de loi, si cela n'est pas le cas les membres de la cellule peuvent refuser de fournir les informations demandées. Les membres de la CCJ, tenu·e·s au secret, ne peuvent communiquer en dehors de la cellule sur les enquêtes en cours, seule exception : si les membres de la CCJ n'ont pas la capacité technique, ils peuvent demander à un technicien de leur fournir les informations demandées. Ce technicien doit s'assurer de la légitimité de la demande (mandat du procureur, etc.). L'IBPT définit comme technicien toute personne qui vient en aide à la CCJ pour donner suite à la demande.

En cas d'enquête, nous devons aussi être en mesure de lever l'identifier du membre utilisant le service concerné. Cela peut se faire par copie de carte d'identité (physique ou électronique), validation par SMS ou par voie postale. Nous proposons de retenir la solution SMS et voie postale, car elle nous semble la moins intrusive. La voie postale peut servir pour des personnes sans papier en indiquant un lieu de référence (CPAS, association qui peut assurer ce rôle (attention, toutes les asbl ne sont pas habilitées à le faire : Neutrinet ne pourrait donc pas assurer ce rôle).
[/ui-tab]
[ui-tab title="Obligations techniques"]

Dans le cadre du VPN nous devons conserver l'adresse IP d'origine qui établit le tunnel et l'adresse IP fournie par Neutrinet, et ce, pendant un an maximum (cela pourrait passer à 6 mois).

Nous devons instaurer une méthode pour valider l'identité de nos membres utilisant le VPN soit par SMS, voie postale ou copie de carte d'identité (électronique ou physique).

Il est possible que la police nous demande d'enregistrer le flux réseaux d'une IP Neutrinet avec ce que l'on appelle dans le jargon des PCAP (packet capture). Ce point-ci n'est pas clair si c'est une obligation pour les VPN, et d'après les différents témoignages que nous avons reçus les personnes n'ont pas dû faire ce genre de capture (mais elle est prévue par la loi).

Dans le cadre de la collecte (fournir des connexions internet sur le territoire belge) nous devrons avoir la possibilité d’installer l'enregistrement du flux réseau sur une ligne précise. Et même remarque que pour le VPN sur les témoignages.
[HgO: càd? que personne n'a jamais eu à le faire en pratique? 
Tharyrok: exacte que ce soit chez wireless belgium ou verixi, on a entendu dire que c'est la prochaine etape]

[/ui-tab]
[/ui-tabs]


## Les possibilités pour Neutrinet
Maintenant que le contexte est posé, quelles sont les différentes possibilités pour Neutrinet?


[ui-tabs position="top-left" active="0" theme="default"]
[ui-tab title="Sortir de L'IBPT ?"]
Nous avons comme possibilité de ne plus être renseigné auprès de l'IBPT, et donc de ne plus être soumis aux obligations de créer une CCJ.

#### Conséquence
- Nous ne devons pas créer de CCJ.
- Nous ne participons pas à la surveillance capitaliste, car nous sommes acteur du secteur non marchand et l'État ne se décharge pas sur nous d'une de ses missions.
- Nous devons quand même nous assurer de la conservation des logs (obligation légale)
- Nous perdons le statut de « vrai » FAI.
- Nous ne sommes plus au courant des obligations auxquelles doivent répondre les autres FAI.

#### Avenir pour Neutrinet
Nous renforçons notre but social sur la formation (éducation permanante), sensibilisation du fonctionnement des réseaux et axons Neutrinet sur la décentralisation (VPN) et l'hébergement de machines virtuelles (VPS).

Le jour où nous souhaiterons faire de la collecte, nous devrons nous renseigner sur l'obligation de rejoindre l'IBPT à nouveau. 

Cette option nous permet de nous laisser du temps pour réfléchir comment légalement nous souhaitons nous structurer (refonte des statuts de l'ASBL, entité séparée pour la collecte, etc.), et cela nous permet de sortir de « l'urgence » de créer une CCJ.
[/ui-tab]
[ui-tab title="Constituer une CCJ ?"]
Nous avons comme possibilité de constituer une CCJ et nous conformer a la loi.

#### Conséquence
- Nous devons mettre le moyen technique pour identifier les utilisateurs du VPN.
- Nous devons nous assurer de la conservation des logs sur 1 an.
- Nous devons avoir au moins un membre dans cette cellule.
- Nous nous conformons à la surveillance d'État et facilitons le travail d'enquête.
- Nous restons un « vrai » FAI 
- Nous restons informé des obligations que doivent répondre les FAI belges.

Par ailleurs, si nous répondons favorablement à une demande par un moyen technique donné, nous devons nous attendre à ce qu'on nous redemande des informations via ce même moyen technique. Autrement dit, toute solution technique mise en place doit être considérée comme acquise (ex: les PCAP). Ce qui peut nous pousser à mettre de plus en plus de solutions de surveillances afin de répondre aux demandes d'enquête.

#### Avenir pour Neutrinet

Nous pouvons continuer notre objectif de fournir des connexions physiques sachant que cela demande beaucoup de travail, nous aurons moins de temps pour sensibiliser/former nos membres.

[/ui-tab]
[ui-tab title="Fin de Neutrinet ?"]

Bien que cette possibilité existe, nous ne l'envisageons pas, car nous désirons toujours trouver une solution pour continuer d'exister et de poursuivre le but social de l'ASBL.

[/ui-tab]
[/ui-tabs]

## Ressources

## Pad

- https://pad.caldarium.be/_4zMiyzpQ2eG1Ft9cA--Qg#

### Wiki

- https://wiki.neutrinet.be/fr/rapports/2021/09-21#ccj
- https://wiki.neutrinet.be/fr/rapports/2021/09-29
- https://wiki.neutrinet.be/fr/rapports/2021/10-07
- https://wiki.neutrinet.be/fr/rapports/2021/10-19#ccj

### Gists

- https://gist.github.com/wget/fdca2fa763dbb82bdb9a8a00e0b4fda6
- https://gist.github.com/wget/3859e6f166a9d6de26a8bbe469d31c81

## Blog

- https://neutrinet.be/fr/blog/ccj

## Chat

- https://chat.neutrinet.be/neutrinet/pl/tft8g4q6h7gjtmm7k9quig7a3o

---

- clients ??
-- devoir lever l'identité en cas d'enquête (sms (burner?) - coordonées postale - email)
-- devoir fournir des informations en cas d'enquête, allant jusqu'à un service de collecte et d'analyse (PCAP?)
-- devoir s'assurer de la validité légale de la demande (mandat, article de loi, etc)

Actuellement, nous mettons à disposition de nos membres, une seule solution technique; le VPN. Cela nous permet de mettre en avant le projet de Labriqueinter.net qui se repose sur du matérielle ouvert (Olimex Lime 1 & 2) et des logiciels libres (YunoHost) pour encourager l'auto-hébergement, la décentralisation et la participation au réseau Internet. Nous sensibilisons nos membres sur la neutralité des réseaux et sommes membres de la Fédération FDN qui se repose sur une charte nous obligeant de garantir cette neutralité des réseaux.

En plus de cela, nous avons dans nos projets en cours de réalisation, la location de machines virtuelles (VPS) et l'accès internet via le câble (vdsl, coax, ...).

## TODO
### Question IBPT
 - Sommes-nous obligés d'être enregistré au prêt de l'IBPT si on fournit nos services uniquement à nos membres ?
     - VPN
     - Collecte
### Point de vue de boistordu et ajout de sa part sur la todo list.

Je privilégie comme je l'ai déjà mentionné une troisième voie. 

Il y a tout à fait moyen techniquement de faire en sorte d'anonymiser le traffic des utilisateurs tout en respectant el cadre législatif qui pourrait être imposé à Neutrinet en tant que FAI.

Si le juriste n'en a pas fait mention c'est normal puisque dans son cadre à lui, c'est aussi un FAI de voip et donc clairement de traffic en clair, ce qui est une toute autre situation. Qui plus est aucun d'entre vous n'a pensé à poser la question. 

Alors de ce que j'ai cru comprendre de ce que nino a dit, on lui aurait dit à la fête de Neutrinet que c'était un boulot qui requiert trop d'énergie de votre part. 

Je pense surtout que vous avez pas envisagé un certain nombre de possibilités de forme d'application de zero-knowledge, car il y a plusieurs nuances à ce concept. 

Dans tous les cas en droit il y a la loi, l'application de la loi et l'esprit de la loi qui peuvent être 3 choses différentes. 

Donc je pense qu'il serait dans l'intérêt de Neutrinet d'approfondir un tant soi peu le sujet jusque décembre. Ca laisse un tout petit peu de temps, en ce y compris de la prise de contact de type internationaux. 

De mes discussions que j'ai pu avoir au sein d'ARN, le fait qu'il n'y ait pas de zero-knowledge au sain de la FDN est simplement un problème que les juristes n'arrivent pas à se mettre d'accord entre eux. 
Preuve qu'il y a donc débat. 
Aussi je rappelle au passage que la Belgique et son projet de loi de cassage du chiffrement est ouvertement critiqué et débattu donc je prendrais un tant soi peu avec des pincettes, la façon dont la loi en l'état actuel peut être interprètée.

Donc s'il m'est possible, car je sais que la tentation est forte à cause des dissentions que vous avez à mon égard de me mettre des bâtons dans les roues en ce y compris de ne pas me répondre, je vais prendre contact avec différents avocats nationaux et internationaux pour un peu voir comment eux ont procédé ou ce qu'ils ont réussi à défendre ou ce qu'ils n'ont pas réussi à défendre.

Aussi je prendrai contact sur ce sujet avec quelques juges d'instruction avec lesquels on a de bons contacts. 
Il va de soi que je ne ferai pas de réunions avec les juges d'instruction et vous mais je ferai un compte-rendu succints en fonction des informations qui me seront données. 
Pour ce qui est des contacts avec les avocats, je plannifierai sur le mattermost des séances d'informations si j'en viens à découvrir dans le décours de mes échanges avec eux, que la troisième voie est possible et défendable juridiquement parlant. Vous venez ou vous ne venez pas ça sera à vous de vous décider. 

Tout ceci parce que je comprends l'objectif de Tierce et que je pense qu'il est aussi sain d'avoir ce genre d'alternatives en démocratie. 

Je rajouterai néanmoins une chose au point de vue de Tierce par rapport aux conversations auxquelles j'avais pu assiter au sein de riseup, il est important de dans certains cas soi-même faire la police que ce soit pour des néo-nazis, de la pédophilie ou autre atteinte massive à la vie humaine. Parce qu'on a beau vouloir et se penser anarchiste, il est aussi bon de pouvoir assurer la continuité de la possibilité de cet état d'esprit et non pas son extinction sous une forme ou sous une autre. 


