# ARK Management System
The ARK Management System (AMS) is open source and developed with the [Laravel Framework](https://laravel.com/) and [Filament](https://filamentphp.com/).

<img width="1219" height="952" alt="Screenshot AMS." src="https://github.com/user-attachments/assets/243c1a04-ab7c-4257-b3d0-172a6a1dd02b" />

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
* PHP >= 8.3
* Meets the [Laravel Server Requirements](https://laravel.com/docs/12.x/deployment)
* A relational [database](https://laravel.com/docs/12.x/database)

### Clone Repository
```bash
git clone https://github.com/burgerbibliothek/AMS /path/to/desired/directory
```

### Configurations
The following configurations are intended for setting up the application in a productive environment.

1. Make a copy of the .env.example named .env file in the root directory `cp .env.example .env`
2. Generat the app Key via the command `php artisan key:generate`
3. Enter the details of your database connection in the .env file. Further possible database configuration options can be found in the official Laravel [documentation](https://laravel.com/docs/11.x/installation#databases-and-migrations).
4. Initialize the database using the command `php artisan migrate`.
5. Create a user via the following command `php artisan make:filament-user`
6. Login to the system with your created user under /ams

## License
[MIT license](https://opensource.org/licenses/MIT).
