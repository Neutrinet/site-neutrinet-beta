Contenu du site
===============

La [version beta](https://beta.neutrinet.be) du site de Neutrinet est basée sur [Grav]() et hébergé sur notre serveur web.

Depuis le serveur web, le contenus des dossiers `pages`, `plugins` et `themes` sont synchronisés avec ce dépôt.

Sur le serveur web, ce sont des sous dossiers de `user` qui contient également `accounts`, `config` et `data` qui ne sont pas, **et ne devrait jamais**, être synchronisés ici.

Éditer le contenu du site
-------------------------

Le contenu du site peut-être modifié;

* via l'interface admin _(urldusite/admin)_,
* les sources ci-dessus si vous avez un accès en édition,
* un dépôt local sur votre ordinateur en jouant avec des `git pull`, `git push` et des `pull request`.

Mettre à jour Grav,…
--------------------

L'installation de **Grav**, les **plugins** et le **thème parent** peuvent être mis à jours avec les outils de base de Grav.

Thème Grav…
-----------

Nous utilisons actuellement le thème par défaut (Quark) en tant que **thème parent** et nous travaillons sur un **thème enfant** appelé… Neutrinet pour faciliter et permettre les mises à jours.

Catalogue des icones Font Awesome
---------------------------------

* [Pour la version 4.7.0](https://fontawesome.com/v4.7.0/cheatsheet/) - Utilisée par le thème Grav

Multilingue
-----------

La langue définie « par défaut » est le français (fr).

Le site est principalement en **français**, **anglais** et **néerlandais** mais nous manquons de contributeur·ice·s / traducteur·ice·s.

Pour traduire du contenu dans Grav, c'est avec des fichiers textes comme par exemple pour la page d'accueil du site :

```
pages/
├── 01.home
│   ├── 01._hero
│   │   ├── header.jpg
│   │   ├── hero.en.md
│   │   ├── hero.fr.md
│   │   └── hero.nl.md
│   ├── 02._highlights
│   │   └── features.md
│   ├── 03._callout
│   │   ├── gant.jpg
│   │   ├── jeep.jpg
│   │   └── text.md
│   ├── 04._features
│   │   └── features.md
│   ├── modular.en.md
│   ├── modular.fr.md
│   └── modular.nl.md
```

Chaque _page_ ou _module_ dans Grav peut **ou pas** contenir des traductions.  Le moteur de Grav cherche après un fichier correspondant à une langue choisie _(ex: fichier.fr.md ou fichier.en.md,… )_ et affichera ce qu'il pourra si ça existe.  Sinon il affichera la langue par défaut **ou** le seul et unique fichier qu'il trouverait _(même si c'est fichier.md sans .fr. ou .en.,… )_.

Donc dans l'exemple ci-dessus, pour traduire la section `03._callout` il suffit de rajouter `text.en.md` et du contenu en anglais, `text.nl.md` et du contenu en néerlandais et, par soucis de clareté, renommer `text.md` en `text.fr.md`… et c'est tout.

Plugins éventuels ?
-------------------

Sans vouloir tomber dans la _plugin mania_ à la WordPress, peut-être quelques plugins qui **pourraient** être utiles **si** c'est **vraiment** le cas.  Parce que au plus il y en aura, au plus _obscure_ ça sera pour les suivant·e·s qui devraient gérer le basard.

> Notez que pour la parti **blog**, une série de plugins ont été ajoutés, mais jusque là tout va bien.

**Pas encore Installés**

 * [Page Inject (transclusion?)](https://github.com/getgrav/grav-plugin-page-inject/blob/master/README.md)
 * [Events (heu?)](https://github.com/kalebheitzman/grav-plugin-events/blob/master/README.md)
 * [Grav Shortcode Assets Plugin](https://github.com/getgrav/grav-plugin-shortcode-assets/blob/develop/README.md)

**Installés**

 * [Page TOC](https://github.com/trilbymedia/grav-plugin-page-toc/blob/develop/README.md)
 * [Grav Shortcode UI Plugin](https://github.com/getgrav/grav-plugin-shortcode-ui/blob/master/README.md) _(dépend de Shortcode Core)_
 * [Grav Shortcode Core Plugin](https://github.com/getgrav/grav-plugin-shortcode-core/blob/master/README.md)

**À propos de Bolg & Feeds rss**

 * [sur le forum de Grav](https://discourse.getgrav.org/t/how-to-have-rss-per-tag/7476/2) - pour les RSS par tag


 Idées, inspirations, ressources…
---------------------------------

## Disroot ##

 * [Page about](https://disroot.org/en/about) - transparence / ouverture / privacy …
 * [page community](https://disroot.org/en/community) - comment aider / contribuer …

## FAI Maison ##

 * [Outil de transparence](https://transparence.faimaison.net/public/) - pour évaluer le coût de fonctionnement / prix libre
 * [L'association](https://www.faimaison.net/pages/association.html) - comment décrire l'association

## Sur _l'open source_

 * [Awesome Open Source Organization](https://github.com/Mayeu/awesome-open-source-organizations) - une liste de projets sympas

## Sur « les bonnes pratiques »

 * Les [Postures encouragées](https://no-google.frama.wiki/actions:cafenogoogle:cafenogoogle#les_postures_encouragees) de No G00gle.
