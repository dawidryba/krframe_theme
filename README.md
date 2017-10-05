# krframe_theme

Little, optymalized theme framework for Wordpress with widgets setting, grid, twig theme file, setting theme save in JSON file.

***Advantages krFrame***:

+ easy management
+ very fast (twig cache etc.)
+ easy make own views
+ use [Timber](https://github.com/timber/timber)
+ all configurable in one file ***setting.json***
+ many options in widgets ***(custom class, custom class in title, add icon to title, bootstrap grid)***

## Instal guide

### Method 1 - Git clone

Run the following command in **wp-content/themes** dir.

```git
git clone https://github.com/dawidryba/krframe_theme.git
```

***

### Method 2 - Download Release and install via Wordpress installer

Go to [release](https://github.com/dawidryba/krframe_theme/releases) and download .zip

***

## After instalation

### 1. Go to krFrame dir and run command
```composer
composer install
```

### 2. (optional) If you want use node modules to compile, compress css, js, in main dir run command:

```npm
yarn install
```

Enable develope mode. Edit **webpack.config.js** file and change variable **domain** on your local domain and next make command:

```npm
npm run watch
```

Enjoy:)
