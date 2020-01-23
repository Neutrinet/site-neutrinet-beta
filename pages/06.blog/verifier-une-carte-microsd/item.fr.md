---
title: 'Vérifier le système de fichier'
date: '01/23/2020 12:00 pm'
taxonomy:
    category:
        - blog
    tag:
        - microsd
        - tutoriel
subtitle: "Si votre brique ne démarre pas ou qu'elle a un comportement étrange"
---

Tant que la carte [MicroSD](../microsd) de votre Brique Internet n'est pas [en lecture seule](../microsd-en-lecture-seule), mais qu'elle semble se comporter bizarrement ou qu'elle ne démarre plus, peut-être qu'il serait bon de vérifier son [système de fichiers](https://fr.wikipedia.org/wiki/Syst%C3%A8me_de_fichiers).

===

Dans le cas d'une Brique Internet, installée avec [Yunohost](https://yunohost.org), c'est [Ext4](https://fr.wikipedia.org/wiki/Ext4) qui est choisi en tant que [système de fichiers](https://fr.wikipedia.org/wiki/Syst%C3%A8me_de_fichiers). Bien que considéré commé étant fiable, il est parfois nécessaire d'utiliser les outils de vérification.

Il est recommandé de faire un backup avant ou mieux encore un [clone](../cloner) vers un fichier *(de plusieurs giga)* sur votre ordinateur avant de faire une vérification.

## Voici comment faire

Évidemment, il vaut mieux éteindre la Brique Internet, que ce soit depuis l'[interface d'administration web](https://yunohost.org/#/admin_fr), la ligne de commande *(via ssh)* avec la commande ```$ sudo yunohost tools shutdown -f", en utilisant le bouton *(celui qui est le plus proche du bord extérieur)* en l'enfonçant quelques secondes, ou au pire, en retirant la prise.

Ensuite il faut sortir la carte MicroSD de son slot et la mettre dans un adaptateur MicroSD vers SDCard.

Et puis, mettre la carte dans un ordinateur équipé de GNU/Linux.

## Et utiliser ces outils

![](fsck.webm?sizes=30vw)

Ces commandes sont a faire depuis le [terminal](https://fr.wikipedia.org/wiki/%C3%89mulateur_de_terminal) de votre ordinateur équidé de GNU/Linux et dans lequel vous aurez inséré votre carte MicroSD dans un emplacement prévu à cet effet ou un [lecteur multi cartes](https://duckduckgo.com/?q=lecteur+multi+cartes&t=ffnt&iax=images&ia=images). 

`$ lsblk` pour identifier la carte qui devrait s'appeler `sdb` ou `sdc` ou  `mmcblk0` et les partitions qui la compose `sdb1` ou `sdc1` ou `mmcblk0p1`.

`sudo fsck.ext4 /dev/sdb1` ou `sudo fsck.ext4 /dev/mmcblk0p1` pour vérifier l'intégrité de la table d'allocation et voir si elle contient des erreurs.

Si il y a des erreurs, vous pouvez tenter une réparation automatique `sudo fsck.ext4 -p /dev/sdb1` ou `sudo fsck.ext4 -p /dev/mmcblk0p1`.