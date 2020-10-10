---
title: 'Carte en lecture seule'
date: '17/01/2018 11:11 pm'
taxonomy:
    category:
        - blog
    tag:
        - microsd
        - tutoriel
        - problème
subtitle: "Que faire lorsqu'une carte microSD est en lecture seule ?"
---

Si votre brique ne fonctionne plus, ou si elle fonctionne encore mais « oublie tout » ce que vous y mettez, il se peut que ce soit la carte MicroSD qui s'est mise en **lecture seule**.

===

## Comment savoir ?

En mettant la carte SD dans son adaptateur MicroSD to SD.
En s'assurant que le verrou de l'adaptateur est bien sur la position déverrouillée.
En mettant le tout dans un lecteur de carte SD sur un PC GNU/Linux.

`$ lsblk`

Pour retrouver la carte SD qui devrait se trouver par exemple sur /dev/mmcblk0 ou /dev/sdb.

`$ sudo hdparm /dev/mmcblk0 `

ou /dev/sdb ou tout autre chemin vers la carte SD

Le résultat devrait renvoyer quelque chose comme ça :


```text
/dev/mmcblk0:
 HDIO_DRIVE_CMD(identify) failed: Invalid argument
 readonly      =  0 (off)
 readahead     = 256 (on)
 geometry      = 490976/4/16, sectors = 31422464, start = 0
```

Et si readonly = 1(on) apparaît ... ça veut dire que la carte est en LECTURE SEULE ce qui la rend inexploitable.  Les données n'étant pas perdues elles pourront être lue et recopiées si nécessaire, voir [clonée](#cloner)

## Que faire dans ce cas ?

Il faudra [choisir une nouvelle carte MicroSD](../choisir-une-carte-microsd) et soit [cloner](../cloner-une-carte-microsd) votre ancienne carte vers la nouvelle ou [repartir d'un backup]().
