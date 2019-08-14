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

Define the fields in your `NovaServiceProvider`'s `boot()` function by calling `NovaSettings::setSettingsFields()`.

```php
\Epigra\NovaSettings\NovaSettingsTool::setSettingsFields([
    Text::make('Some setting', 'some_setting'),
    Number::make('A number', 'a_number').
]);
```

### Custom formatting

If you want the value of the setting to be formatted before it's returned, pass a `Closure` as the second parameter to the `setSettingsFields` function. The function receives two arguments: `key` and `value`.

```php
\Epigra\NovaSettings\NovaSettingsTool::setSettingsFields([
    // ... fields
], function ($key, $value) {
    if ($key === 'some_boolean_value') return boolval($value);
    return $value;
});
```

# Credits

Thanks for the inspiration.

### akaunting/setting

You can visit [https://github.com/akaunting/setting]() to get more information on how to use getters/setters and facade of settings package.

### optimistdigital/nova-settings
This package is inspired by [optimistdigital/nova-settings](https://github.com/optimistdigital/nova-settings)