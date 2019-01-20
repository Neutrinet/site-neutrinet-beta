---
title: 'Faire une image de la carte microSD'
date: '10/11/2018 12:00 pm'
taxonomy:
    category:
        - blog
    tag:
        - lime1
        - lime2
        - microsd
subtitle: 'Pour en faire une copie ou une sauvegarde'
---

Si vous n'utilisez pas de disque dur SATA, la carte microSD contient **toutes vos données**, le démarrage (boot), le système d'exploitation (Debian/Yunohost), vos données personnelles et celles des utilisateurs et utilisatrices que vous hébergez _(mails, fichiers, bases de données, agendas, contacts, etc.)_.

===
### Prérequis

Vous allez utilisez quelques commandes _systèmes_ et manipuler le périphérique principale qui contient vos données _(la carte MicroSD)_. Soyez prudent·e et dans le doute n'hésitez pas à vous renseigner, prendre contact ou venir à une Install Party.

#### Matériel

* Un ordinateur équipé d'un système d'exploitation GNU/Linux.
* De l'espace de stockage en suffisance pour recevoir un **gros fichier** dont la taille dépendra de la taille d'origine de votre carte MicroSD (8Gb, 16Gb, 32G voir 64Gb).  Cet espace de stockage peut se trouver directement sur votre ordinateur ou sur disque dur externe.

#### Logiciel

Voici les commandes _(logiciels)_ utilisées :

* [dd](https://ss64.com/bash/dd.html) - Convert and copy a file, write disk headers, boot records
* [gzip](https://ss64.com/bash/gzip.html) - Compress or decompress named file(s)
* [lsblk](https://ss64.com/bash/lsblk.html) - List block devices
* [pv](https://ss64.com/bash/pv.html) - Monitor the progress of data through a pipe

Les trois premières (`dd`, `gzip`, `lsblk`) sont souvent disponible sur les distributions GNU/Linux. Vous pouvez installer `pv` avec votre [gestionnaire de paquets](https://fr.wikipedia.org/wiki/Gestionnaire_de_paquets) favoris. Par exemple `$ sudo apt install pv`.

!! La commande `dd` pourrait endommager l'ordinateur si le paramètre sortie _(of=)_ pointe vers le disque système de l'ordinateur au lieu d'un fichier image ou d'une carte microSD.

### La taille d'origine

La carce MicroSD de [[color=red]LaBrique[/color][color=black]Înter.net[/color]](https://labriqueinter.net) peut être de taille différente :

* 8Gb, 16Gb, 32Gb pour la Lime1 et la Lime2,
* Jusqu'à 64Gb pour la Lime2 uniquement.

### La taille de l'image

Sans compression (`gzip`), le fichier de sortie _(l'image de votre carte microSD)_ occupera un espace sur votre disque dur, égal à la taille de la carte MitroSD.

! Les fichiers produits peuvent tout à fait **faire plus que 4GB** et dans ce cas il est **indispensable** que le disque qui accueillera ces images soit formaté dans un [système de fichier](https://fr.wikipedia.org/wiki/Syst%C3%A8me_de_fichiers) comme NTFS, EXT4 ou HFS qui accepte de créer des fichiers « unique » qui font plus que 4 Gigas.  

### Identifier votre carte microSD

* éteindre la brique depuis l'interface web, la ligne de commande, le bouton ou au pire en débranchant la prise électrique.
* débrancher la brique après extinction _(sauf si votre technique pour l'éteindre, c'est en débranchant la prise)_
* sortir la carte microSD de son emplacement
* mettre la carte microSD dans le PC et l'identifier avec la commande `lsblk` :

```
$ lsblk -p
NAME                           MAJ:MIN RM   SIZE RO TYPE  MOUNTPOINT
/dev/sda                         8:0    0 238,5G  0 disk  
├─/dev/sda1                      8:1    0   243M  0 part  /boot
├─/dev/sda2                      8:2    0     1K  0 part  
└─/dev/sda5                      8:5    0 238,2G  0 part  
  └─/dev/mapper/sda5_crypt     254:0    0 238,2G  0 crypt
    ├─/dev/mapper/q--vg-root   254:1    0 230,3G  0 lvm   /
    └─/dev/mapper/q--vg-swap_1 254:2    0   7,9G  0 lvm   [SWAP]
/dev/sdb                         8:16   1    15G  0 disk  
└─/dev/sdb1                      8:17   1    15G  0 part  /media/tierce/24cd577f-1bdb-4349-
/dev/sr0                        11:0    1  1024M  0 rom  
```

Dans l'exemple ci-dessus la carte microSD de _« 16Gb »_ ne fait en réalité que _« 15Gb»_ et en tant que `disk`, elle s'appelle `/dev/sdb` et elle contient une seule et unique _partition_ `part` qui s'appelle `/dev/sdb1`.

Ce qui nous intéresse est de faire une image complète de la carte microSD **en tant que disque** `/dev/sdb`.

! En fonction de votre distribution GNU/Linux les cartes MicroSD pourraient s'appeller `/dev/mmcblkX` au lieu de `dev/sdX`.


### Créer une image de votre carte microSD


#### créer un fichier image

```
$ sudo dd if=/dev/sdb of=fichier_image_de_ma_brique.img bs=10M
```

#### créer un fichier image compressé « à la volée »

```
$ sudo dd if=/dev/sdb bs=10M | gzip -c  > fichier_image_de_ma_brique.img.gz
```

### Restaurer une image vers une carte microSD

! La taille de la nouvelle carte microSD doit être strictement **égale ou supérieure** à la taille du fichier image. Si ce n'est pas le cas, il faudra **réduire la taille** du fichier image, ce qui ne fait pas partie de ce tutoriel. Voici [une piste](http://www.aoakley.com/articles/2015-10-09-resizing-sd-images.php).

#### depuis une image non compressée

```
$ sudo dd if=fichier_image_de_ma_brique.img of=/dev/sdb bs=10M
```

#### depuis une image compressée

```
$ gunzip -c fichier_image_de_ma_brique.img.gz | dd of=/dev/sdb bs=10M
```

