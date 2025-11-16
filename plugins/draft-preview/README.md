# Draft Preview Plugin

The **Draft Preview** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). After installation you can preview pages that are not published yet in admin.

## Installation

Installing the Draft Preview plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install draft-preview

This will install the Draft Preview plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/draft-preview`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `draft-preview`. You can find these files on [GitHub](https://github.com/bitstarr/grav-plugin-draft-preview) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/draft-preview

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/bitstarr/grav-plugin-draft-preview/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/draft-preview/draft-preview.yaml` to `user/config/plugins/draft-preview.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
route: preview      # set the route for the preview (/preview?slug=/unpublished/page)
```

Note that if you use the Admin Plugin, a file with your configuration named draft-preview.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

**Important:** You will need to modify the session settings to not split sessions between frontend and plugins or the plugin cannot check if you are logged in and have the permission to preview. Set `session.split` to `false` in your system.yaml

```yaml
session:
  enabled: true
  split: false
```

## Usage

This plugin enables a preview of unpublished pages via the admin. Without this plugin there is only a preview for already published pages. It will provide the preview button at the same place as the default one for published pages. In the background it establishes a custom route in wich the desired page will be loaded. The preview route will only work if you are logged in into the admin, have permissions for pages and set the afore mentioned session settings.

## Credits

Thanks [Ricardo](https://github.com/ricardo118) for helping me get this together.
