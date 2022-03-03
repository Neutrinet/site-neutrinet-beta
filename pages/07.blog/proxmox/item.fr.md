---
title: 'Proxmox'
date: '25/01/2022 12:00 pm'
taxonomy:
    category:
        - blog
    tag:
        - infra
        - tutoriel
subtitle: 'Partie 1'
published: false
---

# Proxmox

Un serveur est déjà installé chez All2All pour l'atelier carto *(il devrait y en avoir deux … mais shit happens comme on dit)*

Slides utilisés lors de la formation : https://doc.computhings.be/proxmox-slide

## Les suites

- https://doc.computhings.be/20220112-proxmox
- https://doc.computhings.be/20220117-proxmox

## Les attentes

Qu'est-ce qu'il faudrait creuser pour « lever les zones d'ombres ».

- la gestion des disques *(storage - raid, zfs, lvm, etc)*
- mise à jour du serveur Proxmox
- gérer la charge *(dépassement de mémoire allouée, cpu, etc)*
- optimisation des ressources / performances
- vm ou container - comment choisir
- réseau *(par exemple, proxmox ne « fait que gérer les vms » dans le sens où il n'y a pas de proxy / routeur)*

## Dans quel cadre nous l'utilisons ?

- HA (profesisonnel ou associatif)
- Reprise d'activité en cas de failure (envirronnement de secours)
- D'autres solutions d'hyperviseurs pratiquées (Ovirt, Xen) et donc un peu de point de comparaison

## Alternative

- XcpNG (fork de Xen) + XenOrchestra (= interface web comme celle de Proxmox)

## Concepts de virtualisation

C'est quoi selon vous ?

> compartimenter des ressources définies pour les allouer à une machine (des petits nuages dans un gros nuage - par exemple les contenuers seraient des petits nuages avec des trous dedans)

### 4 types (trois abordés ici)

**Isolateurs**

(un seul kernel qui isole les process au travers de ses *namespaces*)
- limite d'accès aux ressources 
  - par exemple un conteneur qui voudrait monter un tunnel (interface tunX), n'en a pas le droit, sans modification de l'hôte.
  - par exemple pour les bases de données, les conteneurs sont limités en terme de descripteurs de fichier, par le kernel de l'hôte
- les conteneurs ont une empreinte mémoire plus faible
- les conteneurs « démarrent » plus rapidement (puisque des ressources communes avec l'hôte sont déjà en mémoire)
- exemple de faille (±2019), le démon rc.d (responsable de l'init pour les conteneurs) avait une faille qui permettait de sortir de l'isolation

**Hyperviseur de type 2**

Comme proxmox ou virtualbox

- l'hôte a une vision sur toutes les ressources matérielles
- le logiciel de contrôle est **à côté** des machines (en faisant htop par exemple, on voit les process kvm qui correspondent aux machines)
- dans le cas de proxmox, l'émulateur est kvm (pour les pilotes virtio)
- par exemple, lors des mises à jour de l'hôte, mettre le kernel à jour nécessite un reboot (et donc de toutes les vms)

**Hyperviseur de type 1**

Comme VMware ou Xen

- le logiciel de contrôle est lui-même virtualisé et n'a pas une vue sur l'ensemble des ressurces matérielles

## Proxmox la société et les produit

Proxmox Virtual Environment. C'est ce que nous abordons pour cette formation.

Proxmox Backup Serveur permet de faire des backup de vms en différentiel *(pas besoin de prendre tout le(s) disque(s) d'une vm en entier)*.  C'est la seule façon de faire des backups *incrémentiels* de vms sur Proxmox.

> note, les snapshots doivent être sur le même stockage que les disques des vms et ne sont pas transportables.  Seul des backups permettent le transport *(changer de stockage)* des vms.

Proxmox Mail Gateway. Sorte de load balancer de mail pour distribuer des mails sur base de leur nom de domaine.

La différence entre les repos communautaires et les payants, c'est la stabilité.  Les repos payants ont des releases moins fréquentes et mieux testées.

> Une expérience avec le répos communautaire fut, par exemple, qu'avec des vms Windaubes, le temps de backup a fait x4 … jusqu'à ce que le bug remonte et soit publié.

Les **changes logs** sont très intéressants à suivre, surtout si on se repose sur les repos communautaires : https://pve.proxmox.com/wiki/Roadmap

## Le choix du matériel (stockage, réseau, cpu, ram, ...)

2U, 256GB de Ram, 2 socket E5, 4 ports réseaux, disques SSD … il y assez pour faire de la HA si besoin.

> note, Hyper convergence = mélanger ses nœuds de **puissance** et ses nœuds de **stockage**. Une super-combo c'est Proxmox + Ceph pour pouvoir ajouter des U de stockage et/ou de puissance indépendemment.

Un exemple de cluster

- 3 gros serveurs de stockage où toutes les interfaces réseaux sont liée à un switch 10Gig

Un autre

- ceph pour le stockage pour pouvoir ajouter un disque ou l'autre

Un autre modèle

- une seule machine qui fait tout

En gros, plein de combinaisons possibles dans lesquelles une cogitation est nécessaire pour le stockage si on temps vers plusieurs nœuds.

## Installation de Proxmox

L'ISO de Proxmox est chouette pour tester PVE mais on a moins de contrôle pour installer son hôte *(nœud)*.  C'est donc préférable de faire une installation Debian, pour mieux configurer son stockage et son réseau et d'installer « l'app » Proxmox VE. Notemment parce que LVM est le choix par défaut, mais il y a mieux.

> note, XFS est préféré parce qu'il a un temps de recovery plus court que EXT4.

- [Documentation sur le wiki pour installer sur Debian Buster](https://pve.proxmox.com/wiki/Install_Proxmox_VE_on_Debian_Buster)

Nous allons utiliser un serveur dédié auquel nous avons accès à l'équivalent d'un iLO *(HP)* ou d'un iDRAC *(Dell)*.

Depuis l'accès ssh disponible sur le serveur pré-installé, parce qu'on a pas envie de passer par une iso montée *(c'est une limitation parce que l'installateur de l'hébergeur de la machine dédiée est limité).

```
apt install kexec-tools fakeroot git python3 python-is-python2
git clone https://github.com/Tharyrok/kexec-remote-debian-install
```

Le script utilisé ensuite https://github.com/Tharyrok/kexec-remote-debian-install *(si j'ai bien compris, charge un preseed dans un initramfs)*.

Et en plus, ajouter les firmwares https://wiki.debian.org/DebianInstaller/NetbootFirmware

### Partitionnement

- 1 GB /boot en ext2 parceque GRUB2 n'a jamais merdé sur ext2, contrairement à ext4 ou xfs
- 50 GB / en xfs
- 4 GB pour une swab
- reste GB /srv/data en xfs

### Installation Debian

Dans la liste des paquets, on ne coche rien sauf SSH.

### Installation Proxmox

Installer le paquet `ifupdown2` est une version améliorée de la gestion de `/etc/network/interface`.  Il faut l'installer depuis un `screen` pour pouvoir récupérer l'accès parceque le réseau va redémarrer *(se reconnecter en ssh et faire `screen -r`).

Merde … on a perdu l'accès suite à l'installation de `ifupdown2`. Carramba ! Encore raté.

On passe sur le serveur de démo, en passant par l'iDrac pour avoir une console.  

Par défaut, Debian met `allow hot-plug` dans les interfaces, alors qu'il faut `auto`.  Il faut donc vérifier ça **avant d'installer `ifupdown2`. ([un peu d'info](https://unix.stackexchange.com/questions/641228/etc-network-interfaces-difference-between-auto-and-allow-hotplug)).

On peut ajouter les [repos no sbscription](https://pve.proxmox.com/wiki/Package_Repositories#sysadmin_no_subscription_repo) de Proxmox.

Installer `wget` pour récupérer la clé.

Faire un `apt dist-upgrade`.

Ajouter une ip locale `genre 10.0.0.11` sur une interface du serveur et suivre la documentation sur [Install Proxmox VE on Debian 11 Bullseye](https://pve.proxmox.com/wiki/Install_Proxmox_VE_on_Debian_11_Bullseye).

> note, on choisi arbitrairement .11 pour réserver de .1 à .10 pour les équipements réseaux, genre .1 sera un Pfsense dans une vm et sera la default gateway, et si on en a, .2 et .3 seront d'autre Pfsense esclaves.

```
# This file describes the network interfaces available on your system
# and how to activate them. For more information, see interfaces(5).

source /etc/network/interfaces.d/*

# The loopback network interface
auto lo
iface lo inet loopback

# The primary network interface
auto eno16
iface eno16 inet static
	address 51.159.39.19/24
	gateway 51.159.39.1
	# dns-* options are implemented by the resolvconf package, if installed
	dns-nameservers 1.1.1.1
	dns-search rev.poneytelecom.eu
# commentaire proxmox

auto vmbr0
iface vmbr0 inet static
	address 10.0.10.11/24 # adsesse « lan » arbitraire

	bridge-ports none # none jusqu'à ce qu'on soufaite associer une interface comme eno16 sur ce bridge
	bridge-stp on # https://wiki.linuxfoundation.org/networking/bridge_stp
	bridge-fd 0
	mtu 9000 #taille d'un paquet.  Historiquement 1500 octets. 9000 octets pour des Jumbo frames
# Vswitch Internal

```
> note, `brctl show` permet de lister les bridges existants.

> note, mettre les #commentaires à la fin du bloc de variables des interfaces, permet de les voir dans l'intreface web de Proxmox

> note, pour tester si le MTU peut aller jusqu'à une taille n, on peut utiliser `ping -s n destination` ([info](https://mike632t.wordpress.com/2019/03/03/determine-mtu-size-using-ping/))

> note, le mtu 8996, c'est parceque 4 octets de moins que 9000, c'est lorsqu'on utilise des VLAN, mais on entrera pas dans ce sujet aujourd'hui.

Et installer Proxmox, avec `opensmtpd` au lieu de `postfix` et ne pas installer `open-iscsi` parce qu'on en a pas besoin, puisqu'on a pas de stockage iscsi.

```
apt install proxmox-ve opensmtpd
```
Et on reboot.

### À propos des clés ssh de Proxmox

Pour pouvoir communiquer entre les nœuds (cluster ou HA), une paire de clé rsa est générée pour root à l'installation.

Si on fait un `ls -l /root/.ssh/` on voit aussi qu'il y a le lien symbolique `authorized_keys -> /etc/pve/priv/authorized_keys`.

C'est parce que `/etc/pve` est un point de montage FUSE derrière lequel il y a une db sqlite utilisé pour les bosoin de synchronisation entre nœud. ([info](https://pve.proxmox.com/wiki/Proxmox_Cluster_File_System_(pmxcfs)))

## Interface web de Proxmox

La colone de gauche est une liste d'éléments sélectionnables.
La colone « centrale » est une liste d'action possible pour l'élément sélectionné.
On peut créer un cluster depuis l'interface web et on obtinedra les informations nécessaires pour ajoutre d'autres nœuds.

### Datacenter

L'ensemble des machines (nœuds Proxmox).
Si on fait un cluster, de « Datacenter » prendra le nom du cluster.

Dans **Options**, ça vaut la peine de changer **Console Viewer** pour `spice` au lieu de `Default`.

Dans la partie **Storage**, `/var/lib/vz` est le storage par défaut.  C'est bien pour y mettre les vms de réseau *(genre Pfsense)*.

Dans **Backup**, on peut demander l'envois de mail en cas d'erreur uniquement.  Le mode `Snapshot`, va freezer la vm dans ses activité, prendre un `snapshot`, defreezer la vm et prendre le backup.  Ce mode n'est pas recommandé pour les vm de base de données, ldap, etc parce qu'il y a pas mal de données dans la ram.  Le mode `suspend`, c'est comme si les vms se mettaient en veille.  Le mode `stop` fait un shutdown avant et redémarre après.

Politique de backup 321, c'est 1 sources, 2 méthodes (proxmox et borg par exemple), 3 lieux (1 local, deux distants par exemple).

La **Rélication** n'est pas de la H.A. parce que qu'il y a un delta de données parce que les storages ne sont pas communs aux différents noeuds.  Il y a de la copie entre deux nœuds, et pas un accès simultané de deux nœuds au même stockage.

### Un nœud

Dans System > Network on peut, enlevre l'ip de eno16, créer un switch vmbr1, lui assigner l'ip publique enlevée de eno16 et appliquer.  Avant d'appliquer, on peut voir le diff de ce qui sera fait.

On speed un peu oralement, c'est dur à suivre, mais il n'y a pas vraiment de points chauds.

### Faire une vm

Pour charger des iso, on va sur Datacenter > un nœuds > un storage.

On peut utiliser l'interface web pour charger depuis notre ordi ou depuis une url.

On peut aussi se connecter sur un nœud, aller dans `/var/lib/vz/template/iso` et y faire un `wget`.

Les Snippets c'est des hooks pour déclencher des scripts, par exemple suite à la création d'une vm.

Le vm ID, si on veut rassembler des vms de différends nœuds, il vaut mieux utiliser des « ranges d'ID » différent pour chaque nœuds. Parce que tout les fichiers (disques, backups, snapshots, etc) porte le ID d'une vm concernée.

Lors de la création d'une vm, dans Advanced, il y a une case à cocher `strat at boot`, pour que lorsque le nœud démarre, il démarre la vm automatiquement.  On peut mettre des délais *(genre il faut laisser le temps à Pfsense de démarrer avant de démarrer d'autres vms qui en auraient besoin.)*.

Dans l'onglet `Système`, dans la partie Graphic Card, mieux vaux utiliser Spice, pour avoir un meilleur mapping clavier.

Pour le SCSI contrôleur, il vaut mieux utiliser VirtIO SCSI Single pour avoir un thread par disque.

Le Qemu Agent doit être cocher parce que dans les GNU/Linux Debian, il y a un paquet qemu-agent pour mieux gérer les snapshots *(par exemple)* mais aussi faire remonter l'IP de la vm dans le Summary de la vm.

Mettre les disques en Discard et choisir si oui ou non le(s) disque(s) sera backupé lors des tâches de backups.  Par exemple, mieux vaut backuper des DBs autrement et ne pas prendre leur disques durs.

Pour les socket, laisser 1 socket parce que en virtualisation ça n'a pas d'utilité.  C'est mieux de faire 1 socket et 4 cœurs que 2 sockets et deux cœurs.  

Lors du choix de Type de CPU, c'est mieux de choisir le mode Host **si on a les même machines** pour des nœuds différents.  Cela permet d'exposer à la vm, tout les jeux d'instructions du CPU de l'hôte.  Le Type kvm64 étant plus générique, il est moins performant.

Éviter de mettre le même nombre de cœurs que ce dont l'hôte dispose et d'en mettre un peu moins pour se laisser une marge si des vms tournent à fond.

Pour la ram, c'est pareil, il vaut mieux mettre le moins possible pour éviter de dépasser ce que l'hôte a physiquement.  C'est possible de le faire, mais c'est s'exposer à des problèmes en cas de sur consommation de la ram.

On peut modifier ces valeurs et rebooter les vms pour prendre en compte leur « nouvel hardware ».

Pour le réseau, on peut ensuite choisir sur quel vmbr elle est connectée.

On peut faire, à chaud, changer la taille des disques, ajouter des cartes réseau, ajouter des iso, mais pas changer le CPU ou la RAM.  Et si on change de Type de machine, mieux vaut la réinstaller.

Si on veut se connecter en console depuis chez soi, on peut installer sur son ordi `virt-viewer` et on peut, dans la fenêtre Console, cliquer sur le bouton Console, ce qui télécharge un petit fichier qui permet de démarrer localement le virt-viewer.

>note, en utilisant virt-viewer client, c'est un à la fois. Dans l'interface web de Proxmox, on peut être à plusieurs pour voir la console.

Lorsqu'on a installé un vm, il faut

- installer `qemu-guest-agent` et si il est bien installé (peut-être redémarrer la vm ou démarre le service) on voit l'ip de la vm dans l'interface web de Proxomox, dans le summary de la vm concernée.
- et aussi faire un `systemctl enable fstrim.timer` pour que les images disques libèrent l'espace utilisé par les fichiers qcow2 lorsque de l'espace est libéré.



### IPMI

Sont des outils qui sont sur les cartes mère (ou parfois en carte PCI) pour avoir accès au fonction de base d'un serveur (alumer, éteindre, redémarrer, des stats sur la santé des éléments, l'élctricité, une console à distance, etc). [sur Wikipedia](https://fr.wikipedia.org/wiki/Intelligent_Platform_Management_Interface)

- Chez Dell, ça s'apelle IDRAC, c'est une license « à vie »
- Chez HP, ça s'apelle iLO, la console est limitée à 30sec sans licences, c'est 100€ mais on en trouve sur eBay à moins de 20€, c'est pour chaque serveur


## Différents stockages d'un « datacenter »

> [Tableau comparatif sur le wiki de Proxmox](
https://pve.proxmox.com/wiki/Storage
)

ZFS est à Solaris, ce que LVM est à GNU/Linux.
- les images disques des vms sont des fichiers
- le disque d'une vm sera un sous-volume du ZFS
    - *(est-ce plus facile de monter le disque d'une vm pour voir « dedans » ?)*
- gère nativement la compression
- peut faire du RAID
- pour fonctionner de manière efficace, il vaut mieux utiliser les disques en passthrough (on les utilise en mode JPBOD), parceque si les disques sont déjà en RAID, c'est pas top.
- demande de la RAM ECC *(ram qui auto-corrige ses défaillances)*
- on peut synchroniser deux ZFS sur du matériel « local »
- on peut pas utiliser du ZFS pour partager un storage pool entre deux nœuds *(si j'ai bien compris)*

NFS et CIFS c'est pas conseillé.
- les disques sont des fichiers

GlusterFS et CephFS
- ce sont des systèmes de fichiers distribués
- les disques sont des blocks devices
- besoin d'un quorum de 3 minimum (les arbitreurs peuvent être sur un autre ordi qui n'a pas de stockage).  Avoir 3 voix permets d'éviter le split-brain *(qui des n machines à la dernière version des données)*

> note, déjà eu l'expérience d'un *split-brain* avec un GluterFS, ce qui demande de gérer « à la main » la situation, et c'est chaud.

Pas tout suivi sur les « block » storage comme LVM, CEPH, iscsi, etc.  Mais en gros les `files` storage permettent d'utiliser des outils comme `rsync` pour parcourir et copier ses images disques, mais ce n'est pas le cas des images disques stockées sur des `blocks devices`.

> note, Discard doit être actif dans la config de la VM *(case Discard cochée)* et dans la VM `systemctl enable fstrim.timer`

> note, Proxmox permet de **déplacer des disques à chaud** entre un stockage en `files` vers un nouveau stockage en `block`.  Cela permet de commencer par ce qui est connu et confortable, et d'ajouter un storage moins connu plus tard.


## Configuration du stockage des VM

Privilégier le format qcow2 pour les VM pour supporter les snapshot. *(raw n'est pas conseillé)*.

## Configuration du réseau

Actuellement, un serveur Proxmox est connecté à Internet sur un de ses ports (il y en a 4 + le iLO) et il a une IP publique *(plusieurs IP sont disponibles)*

On fait un diagramme sur draw.io.

Pour que Proxmox *accroche* les interfaces réseau des vms sur une interface physique, il crée un bridge appelé `vmbr0`.

Tout cela est défini dans `/etc/network/interfaces` du Proxmox.

```
# network interface settings; autogenerated
# Please do NOT modify this file directly, unless you know what
# you're doing.
#
# If you want to manage parts of the network configuration manually,
# please utilize the 'source' or 'source-directory' directives to do
# so.
# PVE will preserve these directives, but will NOT read its network
# configuration from sourced files, so do not attempt to move any of
# the PVE managed interfaces into external files!

source /etc/network/interfaces.d/*

auto lo
iface lo inet loopback

iface enp30s0 inet manual

# aucun vlan (ou tous les vlans sauf .30 ?)
auto vmbr0
iface vmbr0 inet dhcp
	bridge-ports enp30s0
	bridge-stp off
	bridge-fd 0
	bridge-vlan-aware yes
	bridge-vids 2-4094

# vlan 30
auto vmbr0.30
iface vmbr0.30 inet dhcp
```

> note, il n'est pas conseillé d'exposer l'interface web de Proxmox `https://ip.proxmox:8006`.  Une possibilité est d'exposer le serveur Proxmox par `ssh` *(et donc se reposer sur la robustesse de ce protocole)* et de faire du port forwarding depuis son ordinateur personnel `ssh -L 8006:localhost:8006 user@ip.proxmox`.

**Une autre manière** de fonctionner, est de créer un switch virtuel `vmbr0` qui n'est atttaché à aucune interface physique.

**Une autre manière** de fonctionner est d'utiliser, par exemple 3 proxmox et deux interfaces réseau *(eno3 et eno4)* sur chacun. Les eno3 disposent chacune d'une ip publique + une quatrième ip publique sur le même range ip, mais qui est flotante entre les 3 machines.

Les interfaces eno4 sont physiquement connectées sur un switch, avec un range ip local et un vmbr0, liée à ces eno4 accueille les vms. 

Pour gérer le trafic, il faut que les 3 proxmox dispose des même règles iptables pour router le trafic entrant vers la vm concernée.  C'est difficile à gérer parce qu'il faut que ces règles iptables soient maintenues sur les trois proxmox.

**Une autre manière** de fonctionner, c'est par exemple, un seul Proxmox avec une intreface exposée à Internet, un `vmbr0` associé associée à une vm Pfsense et un `vmbr1` associé au Pfsense également et aux autres machines virtuelles.  Le Pfsense à donc 2 interfaces `vmbr` et fait son travail de firewall.  Pour les Proxmox, les bridges doivent avoir les mêmes noms.

![](https://doc.computhings.be/uploads/upload_cebae819871895822e8b7a7ebe47b739.png)

> note, si on veut, on peut dire aussi, grâce au `passthrough` que l'interface `eno3` du Proxmox, qui reçoit le câble de all2all, fait passer le trafic réseau dirrectement dans l'interface réseau de la vm Pfsense.  C'est donc cette vm qui prendrait tout le trafic dans la tronche alors que le Proxmox n'est pas directement exposé.

Du coup, on va aller un peu voir à quoi ressemble Pfsense.

## Gestion du réseau avec PFSense

Proxmox dispose, certes d'un Firewall (basé sur iptables), mais une bonne pratique serait de mettre en place une vm dans laquelle serait installé un Pfsense *(basé sur FreeBSD)*

On parcours un peu l'interface web de Pfsense.

> note, il est de bon usage d'installer Pfsense sur le **stockage local** de Promox.  comme ça, même si c'est une vm, elle ne dépend pas d'un stockage plus évolué comme GlusterFS ou CEPH qui pourrait, même si c'est rare, ce mettre en lecture seule ou se freezer, par exemple quand il n'y a pas assez de voix pour le quorums.

## Création d'une VM

## Mise en cluster de Proxmox

> Un cluster permet de voir plusieurs nœuds Proxmox dans la même inteface web.

Mettre deux machines en cluster c'est simple, mais pour déplacer facilement des vms, il faut 

- que le nom *(id défini dans proxmox>storage)* soient les même entre les deux nœuds.
- que les interfaces réseau aient le même nom aussi.

> note, pour mettre à jour Proxmox, c'est facile `apt update && apt upgrade`.  Pour mettre à niveau *(upgrade de version)*, il est de bon ton, si c'est possible, de déplacer les vms sur un autre nœud *(si on a un cluster ou qu'on est en HA)* et d'utiliser les commandes fournies comme `pve5to6` ou `pve6to7` qui vont faire quelques vérifications et afficher quelques warning si quelque chose d'important est remarqué.

## Proxmox Backup Serveur

## Mise en HA de Proxmox

## Monitoring et metrics
