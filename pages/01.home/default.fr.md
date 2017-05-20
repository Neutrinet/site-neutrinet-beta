---
title: Home
---

# Grav is Running! Ou est-ce?
## Vous avez installé ** Grav ** avec succès

Toutes nos félicitations! Vous avez installé le ** Base Grav Package ** qui fournit une ** page simple ** et le thème par défaut ** antimatter ** pour vous aider à démarrer.

!!! Si vous voulez une installation de base ** plus complète **, vous devriez vérifier les forfaits [** Skeleton ** disponibles dans les téléchargements] (http://getgrav.org/downloads).

### Découvrez tout sur Grav

* En savoir plus sur ** Grav ** en consultant notre site dédié [Learn Grav] (http://learn.getgrav.org).
* Téléchargez ** plugins **, ** thèmes **, ainsi que d'autres paquetages Grav ** skeleton ** à partir de la page [Grav Downloads] (http://getgrav.org/downloads).
* Consultez notre [Grav Development Blog] (http://getgrav.org/blog) pour découvrir les derniers événements dans Grav-verse.

### Modifier cette page

Pour éditer cette page, accédez simplement au dossier dans lequel vous avez installé ** Grav **, puis accédez au dossier `user / pages / 01.home` et ouvrez le fichier` default.md` dans votre [éditeur de choix] (Http://learn.getgrav.org/basics/requirements). Vous verrez le contenu de cette page dans [Markdown format] (http://learn.getgrav.org/content/markdown).

### Créer une nouvelle page

Créer une nouvelle page est une affaire simple dans ** Grav **. Suivez simplement ces étapes simples:

1. Accédez au dossier de vos pages: `user / pages /` et créez un nouveau dossier. Dans cet exemple, nous utiliserons [commande par défaut explicite] (http://learn.getgrav.org/content/content-pages) et appelons le dossier `02.mypage`.
2. Lancez votre éditeur de texte et collez dans l'exemple de code suivant:

        ---
        Titre: Ma nouvelle page
        ---
        # Ma nouvelle page!

        C'est le corps de ** ma nouvelle page ** et je peux facilement utiliser la syntaxe _Markdown_ ici.

3. Enregistrez ce fichier dans le dossier `user / pages / 02.mypage /` comme `default.md`. Cela indiquera ** Grav ** pour rendre la page en utilisant le modèle ** default **.
4. C'est ça! Rechargez votre navigateur pour voir votre nouvelle page dans le menu.

! REMARQUE: la page apparaîtra automatiquement dans le menu après l'élément de menu "Accueil". Si vous souhaitez modifier le nom qui s'affiche dans le menu, ajouter simplement: `menu: Ma page 'entre les tirets dans le contenu de la page. C'est ce que l'on appelle la face avant de YAML, et c'est là que vous configurez des options spécifiques à la page.