# Adds a corner notification of your current environment

## Installation

You can install this plugin via the command-line or the WordPress admin panel.

### via Command-line

1. Download the [latest zip](https://github.com/wp-globalis-tools/wpg-environment-notification/archive/master.zip) of this repo.
2. Add the folder in your plugins directory (wp-content/plugins)
3. Activate the plugin via [wp-cli](http://wp-cli.org/commands/plugin/activate/).

```sh
wp plugin activate wpg-environment-notification
```

### via WordPress Admin Panel

1. Download the [latest zip](https://github.com/wp-globalis-tools/wpg-environment-notification/archive/master.zip) of this repo.
2. In your WordPress admin panel, navigate to Plugins->Add New
3. Click Upload Plugin
4. Upload the zip file that you downloaded.

## Configuration

Just add the folowing lines in your theme's function.php :

```php
// Add Environment notification
add_theme_support('wps-env-warning', WP_ENV);
```