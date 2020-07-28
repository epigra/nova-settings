# Nova Settings

This [Laravel Nova](https://nova.laravel.com) package allows you to create custom settings in code (using Nova's native fields) and creates a UI for the users where the settings can be edited by using [akaunting/setting](https://github.com/akaunting/setting) package.

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
composer require epigra/nova-settings
```

To publish the database migration(s) configuration of `akaunting/setting`

```bash
php artisan vendor:publish --tag=setting
php artisan vendor:publish --tag=nova-settings
php artisan migrate
```

Register the tool with Nova in the `tools()` method of the `NovaServiceProvider`:

```php
// in app/Providers/NovaServiceProvider.php

public function tools()
{
    return [
        // ...
        new \Epigra\NovaSettings\NovaSettingsTool
    ];
}
```


## Usage

### Registering fields

Define the fields in your `NovaServiceProvider`'s `boot()` function by calling `NovaSettings::addSettingsFields()`.

```php
\Epigra\NovaSettings\NovaSettingsTool::addSettingsFields([
    Text::make('Some setting', 'some_setting'),
    Number::make('A number', 'a_number')
]);

// OR

// Using a callable
\Epigra\NovaSettings\NovaSettingsTool::addSettingsFields(function() {
  return [
    Text::make('Some setting', 'some_setting'),
    Number::make('A number', 'a_number'),
  ];
});
```

## Configuration

### reload_page_on_save 

This feature is turned off per default. You may turn it on by changing `reload_page_on_save` value from 
`false` to `true` under `config/nova-settings.php` to reload the entire page on save. Useful when updating any Nova UI related settings.

# Credits

Thanks for the inspiration.

### akaunting/setting

You can visit [https://github.com/akaunting/setting]() to get more information on how to use getters/setters and facade of settings package.

### optimistdigital/nova-settings
This package is inspired by [optimistdigital/nova-settings](https://github.com/optimistdigital/nova-settings)
