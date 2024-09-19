# ARK Management System
The ARK Management System (AMS) is open source and developed with the [Laravel Framework](https://laravel.com/) and [Filament](https://filamentphp.com/).

## Features of AMS
* Create minters and mint ARKs.
* Manage different NAANs in one installation.
* Manage your ARKs:
  * Set the HTTP-Status for ARKs.
  * Add ERC Metadata to an ARK.
  * Mint or update ARKs via CSV-Imports.

## Installation

### Requirements
AMS needs the following to run:
* PHP 8.3
* Meets the [Laravel Server Requirements](https://laravel.com/docs/11.x/deployment#server-requirements)
* A relational [database](https://laravel.com/docs/11.x/database#introduction)

```bash
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels
php artisan make:filament-user
```

## License
[MIT license](https://opensource.org/licenses/MIT).
